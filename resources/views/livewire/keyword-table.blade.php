<div>

    <div class="flex gap-2 flex-col md:flex-row items-start md:items-center md:justify-between mb-4">

        <div class="flex gap-2">
            {{-- Sort by edit time --}}
            <div class="field w-40">
                <div class="relative">
                    <span class="input-icon right-0 pr-3">
                        <i class="fa-solid fa-caret-down"></i>
                    </span>
                    <select wire:model="byTime" id="byTime" class="input select">
                        <option value="">按新增日期排序</option>
                        <option value="desc">由新至舊</option>
                        <option value="asc" >由舊至新</option>
                    </select>
                </div>
            </div>

            {{-- Sort by Nums --}}
            <div class="field w-40">
                <div class="relative">
                    <span class="input-icon right-0 pr-3">
                        <i class="fa-solid fa-caret-down"></i>
                    </span>
                    <select wire:model="byCount" id="byCount" class="input select">
                        <option value="">按關聯數量排序</option>
                        <option value="desc">由多至少</option>
                        <option value="asc">由少至多</option>
                    </select>
                </div>
            </div>

            <button class="button primary-btn" type="button" id="reset" wire:click="reset_button">
                重設
            </button>

        </div>

        <!-- search-input -->
        <div class="field items-center">
            <div class="relative rounded-md shadow-sm">
                <span class="input-icon left-0 pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input class="input input-leftIcon" type="search" placeholder="Search" wire:model="searchInput">
            </div>
        </div>

    </div>

    <!-- keyword-list start ------ -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10" action="">
        @forelse($keywords as $keyword)
            <!-- keyword-element -->
            <form method="POST" action="{{ route('keyword.update', $keyword->bp_tag_id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- keyword-item -->
                <div class="flex flex-col">
                    <div class="flex gap-2">

                        {{-- Input --}}
                        <div class="field">
                            <span class="input-icon left-0 pl-3">
                                <i class="fa-solid fa-hashtag"></i>
                            </span>

                            <input class="input input-leftIcon" type="text" value="{{ $keyword->bp_hashtag }}"
                                maxlength="25" readonly name="bp_hashtag">
                        </div>

                        {{-- Btns --}}
                        <div class="flex gap-2">
                            <!-- view article & media -->

                            <a class="flex items-center justify-center w-12"
                                href="{{ route('keyword.show', $keyword->bp_tag_id) }}" title="顯示關聯列表">
                                <span
                                    class="tag is-draft h-full w-full flex justify-center items-center hover:bg-blue-600/10">
                                    {{ $keyword->content_hashtag_count + $keyword->media_tag_count }}
                                </span>
                            </a>
                            <!-- edit btn -->
                            <button class="button secondary-btn edit-btn" title="修改關鍵字" type="button">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <!-- delete btn -->
                            <button class="button danger-outlined-btn del-Btn" title="刪除" type="button"
                                wire:click="deletedBy('{{ $keyword->bp_tag_id }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <!-- cancel btn -->
                            <button class="button secondary-btn small-btn cancel-Btn hide" title="取消"
                                type="button">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <!-- save -->
                            <button class="button small-btn primary-btn save-Btn hide" title="保存">
                                <span class="mr-0.5">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </span>
                                <span>保存</span>
                            </button>
                        </div>

                    </div>

                    {{-- Hint --}}
                    <p class="help danger hide">
                        <span>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </span>
                        錯誤提示
                    </p>

                </div>
            </form>

        @empty
            未有任何相關結果。
        @endforelse
    </div>

    {{-- pagination --}}
    <nav class="flex justify-center flex-col items-center mt-10" role="navigation" aria-label="pagination">
        {{ $keywords->links('livewire.custom_pagination') }}
    </nav>

</div>
