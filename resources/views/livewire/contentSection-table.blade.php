<div>
    @vite('resources/css/pages/table.css')

    <form id="delete" method="POST" action="{{ route('content.mutisetting') }}" enctype="multipart/form-data">
        @csrf

        {{-- table head --}}
        <div class="flex flex-row justify-between mb-4 gap-4 h-9">
            <div class="flex min-w-xl gap-6">

                {{-- 篩選狀態 --}}
                <div class="field w-20 md:w-36 whitespace-nowrap">
                    <div class="relative">

                        <span class="input-icon right-0 pr-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                        <select wire:model="byState" class="input select">
                            <option value="">篩選-狀態</option>
                            <option value="'0'">草稿</option>
                            <option value="1">等待發布</option>
                            <option value="2">已發布</option>
                            <option value="3">停用</option>
                        </select>

                    </div>
                </div>

                {{-- 置頂 btn --}}
                <div class="flex items-center gap-2">
                    <span class="label">置頂：</span>
                    <button  class="button primary-btn"  title="置頂" id="topBtn" name="submit"
                        value="top">
                        置頂
                    </button>
                    <button class="button secondary-btn" title="取消置頂設定" id="cancelTopBtn" name="submit"
                        value="cancelTop">
                        取消
                    </button>
                </div>

                {{-- 停用 btn --}}
                <div class="flex items-center gap-2">
                    <span class="label">停用：</span>
                    <button  class="button primary-btn" title="停用" id="suspendBtn" name="submit"
                        value="hide">
                        停用
                    </button>
                    <button class="button secondary-btn" title="取消停用" id="cancelSuspendBtn"
                        name="submit" value="show">
                        取消
                    </button>
                </div>

                {{-- 刪除 btn --}}
                <button class="button danger-btn" title="刪除" value="delete" name="submit">
                    <span class="icon">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                    <span>刪除</span>
                </button>

            </div>

            {{-- search input --}}
            <div class="field">
                <input class="input input-rightIcon" type="search" placeholder="輸入文章標題" id="searchInput"
                    wire:model="searchInput">
                <span class="input-icon right-0 pr-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>
        </div>

        <!-- table start -->
        <table class="table-auto w-full" id="articleTable">

            {{-- thead --}}
            <thead class="h-9">
                <tr>
                    {{-- check input --}}
                    <th class="th-check">
                        <input type="checkbox" id="select-all" onClick="selectAll()">
                    </th>

                    {{-- 文章狀態 --}}
                    <th class="th-first article-status">
                        文章狀態
                    </th>

                    {{-- 文章主題 --}}
                    <th class="article-tittle">文章主題</th>

                    {{-- 發布時間 --}}
                    <th>
                        發布時間
                        <a class="mx-2 cursor-pointer" id="sortPublishTimeBtn"
                            wire:click="sortBy('bp_subsection_enabled_date')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>

                    {{-- 最後編輯時間 --}}
                    <th>
                        最後編輯時間
                        <a class="mx-2 cursor-pointer" id="sortEditTimeBtn" title="按照時間排序"
                            wire:click="sortBy('updated_at')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>

                </tr>
            </thead>

            {{-- 文章列表 --}}
            <tbody id="article-container" class="divide-y divide-gray-200">

                <input type="hidden" name="category" value="{{ $content_id }}">

                @forelse($contents as $content)
                    {{-- 文章 --}}
                    <tr class="tr">

                        {{-- Check input --}}
                        <td class="th-check">
                            <input type="checkbox" class="select-item" value="{{ $content->content->bp_subsection_id }}"
                                name="subsections[]">
                        </td>

                        {{-- 文章狀態 --}}
                        @switch($content->content->bp_subsection_state)
                            @case(0)
                                <td>
                                    <span class="tag is-draft">
                                        草稿
                                    </span>
                                </td>
                            @break

                            @case (1)
                                <td>
                                    <span class="tag is-schedule">
                                        排程發布
                                    </span>
                                </td>
                            @break

                            @case (2)
                                <td>
                                    <span class="tag is-published">
                                        已發佈
                                    </span>
                                </td>
                            @break

                            @case (3)
                                <td>
                                    <span class="tag is-suspended">
                                        隱藏
                                    </span>
                                </td>
                            @break
                        @endswitch

                        {{-- 文章標題 --}}
                        <td>
                            <a href="{{ route('content.edit', $content->content->bp_subsection_id) }}" target="_parent"
                                class="td">
                                <span class="td">
                                    @if ($content->bp_display_top != null)
                                        <i class="fa-solid fa-circle-up" title="已置頂"> </i>
                                    @endif
                                </span>
                                <span class="td">
                                    {{ $content->content->bp_subsection_title }}
                                </span>
                            </a>
                        </td>

                        {{-- 發布時間 --}}
                        <td class="td text-sm text-gray-500">
                            {{ $content->content->bp_subsection_enabled_date }}
                        </td>

                        {{-- 最後編輯時間 --}}
                        <td class="td text-sm text-gray-500">
                            {{ $content->content->updated_at }}
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="pl-6"> 未有任何相關結果。</td>
                        </tr>
                    @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <nav class="flex items-center justify-center mt-4" role="navigation" aria-label="pagination">
            {{ $contents->links('livewire.custom_pagination') }}
        </nav>

    </form>
    @include('Sucess')
    <script src="{{ asset('javascript/all-select.js') }}"></script>

</div>
