<div>
    @vite('resources/css/pages/table.css')

    {{-- table head --}}
    <div class="flex justify-between mb-4">
        <h5 class="h5"> --- 關聯媒體列表</h5>

        {{-- search Input --}}
        <div class="field">
            <input class="input input-leftIcon" type="search" placeholder="輸入圖片名稱" id="searchInput"
                wire:model="searchMedia">
            <span class="input-icon left-0 pl-3">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
    </div>

    {{-- table start --}}
    <table class="tablw table-auto w-full" id="media-content">

        {{-- table head --}}
        <thead class="mt-12 mb-4">
            <tr>
                {{-- 圖片名稱 --}}
                <th class="media-name">圖片名稱</th>

                {{-- 圖片尺寸 --}}
                <th>
                    尺寸
                    <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('km_mediawidth')">
                        <i class="fa-solid fa-sort"></i>
                    </a>
                </th>

                {{-- 檔案大小 --}}
                <th>
                    檔案大小
                    <a class="mx-2 cursor-pointer" id="sortSpaceBtn" wire:click="sortBy('km_size')">
                        <i class="fa-solid fa-sort"></i>
                    </a>
                </th>

                {{-- 關鍵字 --}}
                {{-- <th>關鍵字</th> --}}

                {{-- 上傳時間 --}}
                <th>
                    上傳時間
                    <a class="mx-2 cursor-pointer" id="sortUploadTimeBtn" wire:click="sortBy('created_at')">
                        <i class="fa-solid fa-sort"></i>
                    </a>
                </th>

                {{-- 媒體狀態 --}}
                <th>
                    狀態
                    <a class="mx-2 cursor-pointer" id="sortStatusBtn" wire:click="sortBy('km_state')">
                        <i class="fa-solid fa-sort"></i>
                    </a>
                </th>

            </tr>
        </thead>

        {{-- 關聯媒體列表 --}}
        <tbody class="divide-y divide-gray-200">
            @forelse ($images as $image)
                <tr class="h-16">

                    {{-- img --}}
                    <td class="td-first">
                        <div class="flex items-center gap-2">

                            <img class="media-image cursor-pointer w-12" id="{{ $image->Media->km_id }}"
                                @if ($image->Media->km_state == 1)
                                    src="{{ asset('media/' . $image->Media->MediaCategory->kmc_position . '/' . $image->Media->km_name) }}">
                                @elseif ($image->Media->km_state==0)
                                    src="{{ asset('media/trash/' . $image->Media->km_name) }}">
                                @else
                                    src="{{ asset('media/hidden/' . $image->Media->km_name) }}">
                                @endif

                                {{-- 圖片名稱 --}}
                                <a class="truncate"
                                href="{{ route('media.edit', $image->Media->km_id) }}">{{ $image->Media->km_cname }}</a>

                            {{-- Media-modal --}}
                            <div class="media-modal absolute z-10 w-80" id="modal-{{ $image->Media->km_id }}" hidden>
                                <figure></figure>
                                <img
                                @if ($image->Media->km_state == 1)
                                    src="{{ asset('media/' . $image->Media->MediaCategory->kmc_position . '/' . $image->Media->km_name) }}">
                                @elseif ($image->Media->km_state==0)
                                    src="{{ asset('media/trash/' . $image->Media->km_name) }}">
                                @else
                                    src="{{ asset('media/hidden/' . $image->Media->km_name) }}">
                                @endif
                                    </div>

                            </div>
                    </td>

                    {{-- 尺寸 --}}
                    <td>
                        <span>{{ $image->Media->km_mediawidth }}</span>
                        x
                        <span>{{ $image->Media->km_mediaheight }}</span>
                        px
                    </td>


                    {{-- 檔案大小 --}}
                    <td>
                        @if ($image->Media->km_size / 1024 / 1024 > 0.9)
                            <span>{{ number_format($image->Media->km_size / 1024 / 1024, 2) }}</span>
                            MB
                        @else
                            <span>{{ number_format($image->Media->km_size / 1024, 2) }}</span>
                            KB
                        @endif
                    </td>

                    {{-- 關鍵字 --}}
                    {{-- <td>
                        <div class="flex items-center gap-1 flex-wrap">
                            @forelse($image->Tag as $tag)
                                <a href="{{ route('keyword.show', $tag->bp_tag_id) }}"><span
                                        class="tag is-keyword">{{ $tag->bp_hashtag }}</span></a>
                            @empty
                                --
                            @endforelse
                        </div>
                    </td> --}}

                    {{-- 上傳時間 --}}
                    <td>
                        {{ $image->Media->created_at }}
                    </td>

                    {{-- 狀態 --}}
                    <td>
                        @switch($image->Media->km_state)
                            @case(0)
                                <p class="label danger">待刪除</p>
                            @break
                            @case (1)
                                正常
                            @break

                            @case (2)
                                停用
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

        <nav class="flex gap-2 justify-center" role="navigation" aria-label="pagination"
            style="display: flex; justify-content: center; margin-top: 40px;">
            {{ $images->links('livewire.custom_pagination') }}
        </nav>




    </div>
