<div>
    @vite('resources/css/pages/table.css')

    <form id="delete" method="POST" action="{{ route('media.stateUpdate') }}" enctype="multipart/form-data">
        @csrf

        {{-- Edit btns --}}
        <div class="flex justify-between items-center mb-2">

            {{-- Buttons --}}
            <div class="flex gap-4 h-9 items-center">
                {{-- 新增圖片 --}}
                <button class="button primary-btn bg-primary"
                onclick="location.href='{{ route('media.show', $setting->kmc_id) }}'" type="button">
                    新增圖片
                </button>

                {{-- 停用 --}}
                <div class="flex gap-2 items-center">
                    <span class="label">停用：</span>

                    <button class="button danger-outlined-btn" title="停用" id="suspendBtn"
                        name="form_state" value="停用" onclick="return confirm('一旦停用後，文章內的圖片將無法顯示。');">
                        停用
                    </button>

                    <button class="button danger-outlined-btn" title="取消停用" id="cancelSuspendBtn"
                        name="form_state" value="正常">
                        取消
                    </button>
                </div>

                {{-- 刪除 --}}
                <button class="button danger-btn" title="刪除" value="刪除" name="form_state"
                    id="deleteBtn" onclick="return confirm('一旦刪除後，文章內的圖片將無法顯示。');">
                    <span class="mr-0.5">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                    <span>刪除</span>
                </button>
            </div>

            {{-- Search Input --}}
            <div class="field">
                <input class="input input-leftIcon" type="search" placeholder="輸入圖片名稱" id="searchInput"
                    wire:model="searchMedia">
                <span class="input-icon left-0 pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>

        </div>

        {{-- table start --}}
        <table class="table table-auto w-full" id="media-content">

            {{-- table head --}}
            <thead>
                <tr>
                    {{-- Check Input --}}
                    <th class="th-check">
                        <input class="checkbox" type="checkbox" id="select-all" onClick="selectAll()">
                    </th>
                    <th>圖片名稱</th>
                    <th>
                        尺寸
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('km_mediawidth')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        檔案大小
                        <a class="mx-2 cursor-pointer" id="sortSpaceBtn" wire:click="sortBy('km_size')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th class="w-1/3">關鍵字</th>
                    <th>
                        上傳時間
                        <a class="mx-2 cursor-pointer" id="sortUploadTimeBtn" wire:click="sortBy('created_at')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        狀態
                        <a class="mx-2 cursor-pointer" id="sortStatusBtn" wire:click="sortBy('km_state')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                </tr>
            </thead>

            {{-- table --}}
            <tbody class="divide-y divide-gray-200">
                @forelse ($images as $image)
                    <tr class="h-16">

                        {{-- check input --}}
                        <td class="th-check">
                            <input class="checkbox select-item" type="checkbox" name="km_id[]"
                                value="{{ $image->km_id }}">
                        </td>

                        {{-- img --}}
                        <td>
                            <div class="flex gap-2 items-center">

                                <img class="media-image cursor-pointer w-12" id={{ $image->km_id }}
                                    @if ($image->km_state == 1) src="{{ asset('media/' . $image->MediaCategory->kmc_position . '/' . $image->km_name) }}">
                            @else
                                src="{{ asset('media/hidden/' . $image->km_name) }}"> @endif
                                    {{-- 圖片名稱 --}} <a class="truncate"
                                    href="{{ route('media.edit', $image->km_id) }}">{{ $image->km_cname }}</a>

                                {{-- media-modal --}}
                                <div class="media-modal" id="modal-{{ $image->km_id }}" hidden>
                                    <figure></figure>
                                    <img @if ($image->km_state == 1) src="{{ asset('media/' . $image->MediaCategory->kmc_position . '/' . $image->km_name) }}">
                            @else
                                src="{{ asset('media/hidden/' . $image->km_name) }}"> @endif
                                        </div>

                                </div>
                        </td>

                        {{-- 尺寸 --}}
                        <td>
                            <span>{{ $image->km_mediawidth }}</span>
                            x
                            <span>{{ $image->km_mediaheight }}</span>
                            px
                        </td>

                        {{-- 檔案大小 --}}
                        <td>
                            @if ($image->km_size / 1024 / 1024 > 0.9)
                                <span>{{ number_format($image->km_size / 1024 / 1024, 2) }}</span>
                                MB
                            @else
                                <span>{{ number_format($image->km_size / 1024, 2) }}</span>
                                KB
                            @endif
                        </td>

                        {{-- 關鍵字 --}}
                        <td>
                            <div class="flex items-center gap-1 flex-wrap">
                                @forelse($image->MediaWithTag as $tag)
                                    <a href="{{ route('keyword.show', $tag->bp_tag_id) }}"><span
                                            class="tag is-keyword">{{ $tag->bp_hashtag }}</span></a>
                                @empty
                                    --
                                @endforelse
                            </div>
                        </td>

                        {{-- 上傳時間 --}}
                        <td>
                            {{ $image->created_at }}
                        </td>

                        {{-- 狀態 --}}
                        <td>
                            @switch($image->km_state)
                                @case (1)
                                    <span class="tag is-published">正常</span>
                                @break

                                @case (2)
                                    <span class="tag is-suspended">停用</span>
                                @break
                            @endswitch
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="6"> 未有任何相關結果。</td>
                        </tr>
                    @endforelse
            </tbody>

        </table>

    </form>

        <nav class="flex justify-center mt-10" role="navigation" aria-label="pagination">
            {{ $images->links('livewire.custom_pagination') }}
        </nav>

        <script src="{{ asset('javascript/all-select.js') }}"></script>



    </div>
