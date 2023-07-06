<div>
    @vite('resources/css/pages/table.css')
    <form id="delete" method="POST" action="{{ route('media.stateUpdate') }}" enctype="multipart/form-data">
        @csrf

        {{-- btns --}}
        <div class="flex justify-between mb-4">
            <div class="flex gap-2 h-9">
                <button class="button primary-btn" title="還原" id="suspendBtn" name="form_state" value="還原">
                    還原
                </button>
                <button class="button danger-btn " title="永久刪除" id="cancelSuspendBtn" name="form_state"
                    value="永久刪除">
                    永久刪除
                </button>
            </div>

            {{-- search input --}}
            <div class="field">
                <span class="input-icon left-0 pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input class="input input-leftIcon" type="search" placeholder="輸入關鍵字" id="searchInput"
                    wire:model="searchMedia">
            </div>
        </div>

        {{-- table start --}}
        <table class="table-auto w-full" id="media-content">

            {{-- thead --}}
            <thead>
                <tr class="tr">
                    {{-- check input --}}
                    <th class="th-check">
                        <input type="checkbox" id="select-all" onClick="selectAll()">
                    </th>
                    {{-- 圖片名稱 --}}
                    <th>圖片名稱</th>

                    <th class="th">
                        尺寸
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('km_mediawidth')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    {{-- 檔案大小 --}}
                    <th class="">
                        檔案大小
                        <a class="mx-2 cursor-pointer" id="sortSpaceBtn" wire:click="sortBy('km_size')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>

                    {{-- 媒體類別 --}}
                    <th>媒體庫類別</th>

                    {{-- 上傳時間 --}}
                    <th class="th">
                        上傳時間
                        <a class="mx-2 cursor-pointer" id="sortUploadTimeBtn" wire:click="sortBy('created_at')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                </tr>
            </thead>

            {{-- 圖片列表 --}}
            <tbody class="divide-y divide-gray-200">
                @forelse ($images as $image)
                    <tr class="tr">
                        {{-- Checkbox --}}
                        <td class="th-check">
                            <input class="select-item" type="checkbox" name="km_id[]" value="{{ $image->km_id }}">
                        </td>

                        <td>
                            <div class="flex gap-2 items-center">
                                <img class="media-image cursor-pointer w-12" id="{{ $image->km_id }}"
                                    src="{{ asset('media/trash/' . $image->km_name) }}">
                                <span class="truncate" >{{ $image->km_cname }}</span>
                                <div class="media-modal" id="modal-{{ $image->km_id }}" hidden>
                                    <figure></figure>
                                    <img src="{{ asset('media/trash/' . $image->km_name) }}">
                                </div>
                            </div>
                        </td>

                        <td class="media-size">
                            <span>{{ $image->km_mediawidth }}</span>
                            x
                            <span>{{ $image->km_mediaheight }}</span>
                            px
                        </td>

                        <td class="media-space">
                            @if ($image->km_size / 1024 / 1024 > 0.9)
                                <span>{{ number_format($image->km_size / 1024 / 1024, 2) }}</span>
                                MB
                            @else
                                <span>{{ number_format($image->km_size / 1024, 2) }}</span>
                                KB
                            @endif
                        </td>

                        <td class="media-keywords">
                            <span>{{ $image->MediaCategory->kmc_name }}</span>
                        </td>

                        <td class="upload-time-log">
                            {{ $image->created_at }}
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
    <nav class=flex justify-center mt-10" role="navigation" aria-label="pagination">
        {{ $images->links('livewire.custom_pagination') }}
    </nav>

</div>
