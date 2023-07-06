<div>
    @vite('resources/css/pages/table.css')
    <form id="delete" method="POST" action="{{ route('content.mutisetting') }}" enctype="multipart/form-data">
        @csrf

        {{-- table head --}}
        <div class="flex flex-row justify-between mb-4">
            <div>
                @if ($whichpage == 'all')
                    @include('admin.beauty.section.button_all')
                @else
                    @include('admin.beauty.section.button_del')
                @endif
            </div>

            {{-- Search Input --}}
            <div class="field w-40 md:w-60">
                <div class="relative rounded-md shadow-sm">
                    <span class="input-icon right-0 pr-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" name="searchInput" id="searchInput" wire:model="searchInput"
                        class="input input-rightIcon" placeholder="輸入文章標題">
                </div>
            </div>

        </div>

        <!-- table start -->
        <table class="table-auto w-full">

            {{-- Table Head --}}
            <thead>
                <tr>
                    {{-- Ckeck input --}}
                    <th scope="col" class="th-check">
                        <input type="checkbox" class="checkbox" id="select-all" onClick="selectAll()">
                    </th>

                    {{-- 文章狀態 --}}
                    @if ($whichpage == 'all')
                        <th scope="col" class="th-first article-status">
                            文章狀態
                        </th>
                    @endif

                    {{-- 文章主題 --}}
                    <th scope="col">文章主題</th>

                    {{-- 發布時間 --}}
                    <th scope="col">
                        發布時間
                        <a class="mx-2 cursor-pointer" id="sortPublishTimeBtn"
                            wire:click="sortBy('bp_subsection_enabled_date')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>

                    {{-- 最後編輯時間 --}}
                    <th scope="col">
                        最後編輯時間
                        <a class="mx-2 cursor-pointer" id="sortEditTimeBtn" title="按照時間排序"
                            wire:click="sortBy('updated_at')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>

                </tr>
            </thead>

            {{-- 文章列表 --}}
            <tbody class="divide-y divide-gray-200" id="article-container">
                @forelse($contents as $content)
                    {{-- 文章 --}}
                    <tr class="tr">

                        {{-- Check Input --}}
                        <td class="th-check">
                            <input type="checkbox" class="select-item" value="{{ $content->bp_subsection_id }}"
                                name="subsections[]">
                        </td>

                        {{-- 文章狀態 --}}
                        @if ($whichpage == 'all')
                            @switch($content->bp_subsection_state)
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
                        @endif

                        {{-- 文章標題 --}}
                        <td>
                            @if ($whichpage == 'all')
                                <a href="{{ route('content.edit', $content->bp_subsection_id) }}" target="_parent"
                                    class="td">

                                    <span class="td">
                                        {{ $content->bp_subsection_title }}
                                    </span>
                                </a>
                            @else
                                <span class="td">
                                    {{ $content->bp_subsection_title }}
                                </span>
                            @endif
                        </td>

                        {{-- 發布時間 --}}
                        <td class="td text-sm text-gray-500">
                            {{ $content->bp_subsection_enabled_date }}
                        </td>

                        {{-- 最後編輯時間 --}}
                        <td class="td text-sm text-gray-500">
                            {{ $content->updated_at }}
                        </td>


                    </tr>
                    @empty
                        <tr>
                            <td colspan="6"> 未有任何相關結果。</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <nav class="flex items-center justify-center mt-4" role="navigation" aria-label="pagination">
                {{ $contents->links('livewire.custom_pagination') }}
            </nav>

        </table>

    </form>
    @include('Sucess')
    <script src="{{ asset('javascript/all-select.js') }}"></script>
</div>
