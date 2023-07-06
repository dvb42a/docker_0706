@vite('resources/css/app.css')
@vite('resources/css/components/SideGroup.css')

<!-- side-group start ----- -->
<div class="side-group">

    <h5 class="h5">內容架構</h5>

    <!-- 全部文章 -->
    <ul class="text-gray-700">
        <li class="chapter-keyword">
            <a href="{{ route('content.index') }}" id="content">
                <span class="mr-1">
                    <i class="fa-solid fa-list-ul"></i>
                </span>
                <span>
                    全部文章
                </span>
            </a>
            <span class="content-num">{{ $contents }}</span>
        </li>
    </ul>

    <!-- 章節 -->
    @foreach ($sections as $section)
        <ul class="text-gray-700">
            <li class="chapter-keyword mb-1">
                <button type="button" id="chapter_1" class="content-chapter text-btn">
                    <span class="mr-1 pointer-events-none">
                        <i class="file-icon fa-regular fa-folder-open"></i>
                    </span>

                    {{-- 章節名稱 --}}
                    {{ $section->bp_chapter_name }}

                </button>
                <span class="content-num"></span>
            </li>

            {{-- 關鍵字 --}}
            <div class="chapter-list">
                <ul class="flex flex-col gap-1 text-gray-600 ml-4" id="chapterEl_1">
                    @foreach ($section->tag as $tag)
                        <li class="flex items-center">
                            <a class="section_href" href="{{ route('section.show', $tag->bp_tag_id) }}"
                                id="{{ $tag->bp_tag_id }}">
                                <span class="mr-1 pointer-events-none">
                                    <i class="fa-solid fa-hashtag"></i>
                                </span>

                                {{ $tag->bp_hashtag }}
                            </a>
                            <span class="content-num">
                                {{ $tag->content_count }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </ul>
    @endforeach

    <!-- 回收桶 -->
    <ul class="text-gray-700">
        <li class="chapter-keyword">
            <a href="{{ route('section.softdeleteIndex') }}" id="trash">
                <span class="mr-1 pointer-events-none">
                    <i class="fa-solid fa-trash"></i>
                </span>
                回收桶
            </a>
            <span class="content-num">{{ $trash }}</span>
        </li>
    </ul>

    <script src="{{ asset('javascript/locations/article-location-display.js') }}"></script>

    <script>

        // 網址處理過程
        var nowUrl = window.location.href;
        //let setUrl = nowUrl.substring(nowUrl.lastIndexOf('/'), - 1);
        let id = nowUrl.substring(nowUrl.lastIndexOf('/') + 1);
        //console.log('nowUrl:', nowUrl, 'id:', id);
        articleDisplay(id);
    </script>

</div>
<!-- site-group ends ------ -->
