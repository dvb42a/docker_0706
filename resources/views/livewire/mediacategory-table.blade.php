<div>
    @vite('resources/css/pages/table.css')
    <form id="delete" method="POST" action="{{ route('mediaCategory.mutiDelete') }}" enctype="multipart/form-data">
        @csrf

        {{-- btns --}}
        <div class="flex justify-between mb-4">
            <div class="flex gap-2 h-9">

                <button class="button primary-btn"
                    onclick="window.location.href='{{ route('mediaCategory.create') }}'" type="button">
                    新增類別
                </button>

                <button class="button danger-btn">
                    <span class="mr-1">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                    <span>刪除</span>
                </button>

            </div>

            {{-- Search Input --}}
            <div class="field w-40 md:w-60">
                <div class="relative rounded-md shadow-sm">
                    <span class="input-icon right-0 pr-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input class="input is-small" type="search" placeholder="輸入媒體庫名稱" id="searchInput"
                        wire:model="searchMediacategory">
                </div>
            </div>

        </div>

        {{-- table start --}}
        <table class="table-auto w-full">

            {{-- table Head --}}
            <thead>
                <tr class="tr">
                    {{-- Check Input --}}
                    <th class="th-check">
                        <input type="checkbox" id="select-all" onClick="selectAll()">
                    </th>
                    {{-- 類別名稱 --}}
                    <th class="th">
                        類別名稱
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('kmc_name')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    {{-- 類型 --}}
                    <th class="th">
                        類型
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('kmc_file_type')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th class="th">
                        檔案限制
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('kmc_file_limited')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th class="th">
                        尺寸限制
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('kmc_width')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th class="th">縮圖</th>
                    <th class="th">時間長度限制</th>
                    <th class="th">
                        媒體數量
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('media_count')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                </tr>
            </thead>

            {{-- 類別列表 --}}
            <tbody class="divide-y divide-gray-200">

                @forelse($imgcategorys as $imgcategory)
                    <tr class="tr">

                        {{-- Checkbox --}}
                        <td class="th-check">
                            <input type="checkbox" class="select-item" name="mediacategory[]"
                                value="{{ $imgcategory->kmc_id }}">
                        </td>

                        {{-- 類別名稱 --}}
                        <td class="font-medium">
                            <a href="{{ route('mediaFile.show', $imgcategory->kmc_id) }}">
                                {{ $imgcategory->kmc_name }}
                            </a>
                        </td>

                        {{-- 類型 --}}
                        <td>
                            <span>
                                @if ($imgcategory->kmc_file_type == 1)
                                    圖片
                                @else
                                    影片
                                @endif
                            </span>
                        </td>

                        {{-- 檔案限制 --}}
                        <td>
                            <span> {{ $imgcategory->kmc_file_limited }} </span> MB
                        </td>

                        {{-- 尺寸限制 --}}
                        <td>
                            @if ($imgcategory->kmc_width != null)
                                <span class="media-size-width"> {{ $imgcategory->kmc_width }} </span>
                                x
                                <span class="media-size-height">{{ $imgcategory->kmc_height }}</span>
                                px
                            @else
                                無限制
                            @endif
                        </td>

                        {{-- 縮圖 --}}
                        <td>
                            <span>
                                @if ($imgcategory->kmc_resize != 0)
                                    <i class="fa-solid fa-check"></i>
                                @else
                                    <i class="fa-solid fa-xmark"></i>
                                @endif
                            </span>
                        </td>

                        {{-- 時間長度限制 --}}
                        <td>
                            無限制
                        </td>

                        {{-- 媒體數量 --}}
                        <td>
                            {{ $imgcategory->media_count }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6"> 未有任何相關結果。</td>
                    </tr>
                @endforelse
            </tbody>

            <tbody class="trash-can">
                <tr class="tr bg-gray-200" id="trashCan">
                    <td class="th-check"></td>
                    <td>
                        <a href="{{ route('mediaFile.mediaFileTrash') }}">
                            媒體回收桶
                        </a>
                    </td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $trash }}</td>
                </tr>
            </tbody>

        </table>

        <nav class="flex justify-center mt-10" role="navigation" aria-label="pagination">
            {{ $imgcategorys->links('livewire.custom_pagination') }}
        </nav>
    </form>
</div>
<script src="{{ asset('javascript/all-select.js') }}"></script>
