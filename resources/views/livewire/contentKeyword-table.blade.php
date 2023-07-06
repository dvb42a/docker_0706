<div>
    @vite('resources/css/pages/table.css')

    {{-- table head --}}
    <div class="flex justify-between mb-4">
        <h5 class="h5"> --- 關聯文章列表</h5>

        {{-- search Input --}}
        <div class="field">
            <input class="input input-leftIcon" type="search" placeholder="輸入文章標題" id="searchInput"
                wire:model="searchInput">
            <span class="input-icon left-0 pl-3">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>

    </div>

    <!-- table start -->
    <table class="table-auto w-full" id="articleTable">

        {{-- Table Head --}}
        <thead class="mb-4">
            <tr>
                {{-- 文章狀態 --}}
                <th>
                    文章狀態
                </th>

                {{-- 文章主題 --}}
                <th>文章主題</th>

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

        {{-- 關聯文章列表 --}}
        <tbody id="article-container" class="divide-y divide-gray-200">
            <!-- 文章 -->
            <input type="hidden" name="category" value="{{ $content_id }}">
            @forelse($contents as $content)
                <tr>
                    {{-- 文章狀態 --}}
                    <td>
                        @switch($content->content->bp_subsection_state)
                            @case(0)
                                <span class="tag is-draft"> 草稿</span>
                            @break

                            @case (1)
                                <span class="tag is-schedule">排程發布</span>
                            @break

                            @case (2)
                                <span class="tag is-published">已發佈</span>
                            @break

                            @case (3)
                                <span class="tag is-suspended">隱藏</span>
                            @break

                            @case(4)
                                <span class="tag is-suspended"> 待刪除</span>
                            @break
                        @endswitch
                    </td>

                    {{-- 文章主題 --}}
                    <td>
                        <a href="{{ route('content.edit', $content->content->bp_subsection_id) }}" target="_parent"
                            class="articleTitle">
                            <span class="push-icon">
                                @if ($content->content->content_Hashtag->bp_display_top != null)
                                    <i class="fa-solid fa-circle-up" title="已置頂"> </i>
                                @endif
                            </span>
                            <span class="article-subject">
                                {{ $content->content->bp_subsection_title }}
                            </span>
                        </a>
                    </td>

                    {{-- 發布時間 --}}
                    <td>{{ $content->content->bp_subsection_enabled_date }}</td>

                    {{-- 最後編輯時間 --}}
                    <td>{{ $content->content->updated_at }}</td>
                </tr>

                @empty
                    <tr>
                        <td colspan="6"> 未有任何相關結果。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- pagination --}}
        <nav class="flex gap-2 justify-center" role="navigation" aria-label="pagination"
            style="display: flex; justify-content: center; margin-top: 40px;">
            {{ $contents->links('livewire.custom_pagination') }}
        </nav>

    </table>

</div>
