<div class="max-w-[366px] w-1/3">
    <!-- media header -->
    <div class="flex flex-col w-full gap-2">
        <h5 class="h5">媒體庫 <a class="text-xs" href="{{ route('media.show', '60') }}" target="_blank">沒有所需照片嗎?</a></h5>

        <!-- search input -->
        <div class="flex gap-2 mb-2">
            <div class="field w-full">
                <span class="input-icon left-0 pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="search" placeholder="輸入關鍵字" id="mediaSearch" wire:model="searchMedia"
                    class="input input-leftIcon">
            </div>
            <button class="button secondary-btn" type="button" wire:click="refreshPage">
                重新整理
            </button>
        </div>

    </div>

    <!-- media-container -->
    <div class="relative grid grid-cols-3 gap-4 my-3">
        <!-- data-target 跟 modal 的 id 對應上即可觸發 modal-->

        <!-- Img card -->
        @forelse($medias as $media)

            <div class="shadow rounded overflow-hidden hover:-translate-y-1 hover:shadow-md ease-linear duration-100" wire:key="item-{{ $media->km_id }}">

                <a target="_blank" rel="noopener" href="{{ route('media.edit', $media->km_id) }}" class="flex flex-col items-center justify-center gap-1" title="{{ $media->km_cnt }}">
                    {{-- img --}}
                    <img class="h-20 object-cover"
                        src="{{ asset('media/' . $media->MediaCategory->kmc_position . '/' . $media->km_name) }}">
                    {{-- media-name --}}
                    <p class="text-sm truncate py-1">
                        {{ $media->km_cname }}
                    </p>
                </a>
            </div>

        @empty
            查無此結果。
        @endforelse

    </div>
    <nav class="flex justify-center gap-2 my-20" role="navigation" aria-label="pagination">
        {{ $medias->links('livewire.custom_pagination') }}
    </nav>

</div>
