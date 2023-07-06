<div>
    {{-- table head --}}
    <div class="flex flex-row justify-between mb-4">

        <div class="flex gap-2 flex-col md:flex-row items-start md:items-center md:justify-between mb-4">

            {{-- Sort by edit time --}}
            <div class="field w-40">
                <div class="relative">
                    <span class="input-icon right-0 pr-3">
                        <i class="fa-solid fa-caret-down"></i>
                    </span>
                    <select wire:model="byTime" id="byTime" class="input select">
                        <option value="">按新增日期排序</option>
                        <option value="desc">由新至舊</option>
                        <option value="asc">由舊至新</option>
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
                        <option value="">按關聯字數量排序</option>
                        <option value="desc">由多至少</option>
                        <option value="asc">由少至多</option>
                    </select>
                </div>
            </div>

            <button class="button primary-btn" type="button" id="reset" wire:click="reset_button">
                重設
            </button>

        </div>

        {{-- Search Input --}}
        <div class="field w-40 md:w-60">
            <div class="relative rounded-md shadow-sm">
                <span class="input-icon right-0 pr-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="search" name="searchInput" id="searchInput" wire:model="searchInput"
                    class="input input-rightIcon" placeholder="輸入關鍵字">
            </div>
        </div>

    </div>

    {{-- table --}}
    <table class="table-auto w-full">
        {{-- thead --}}
        <thead class="mb-4">
            <tr>
                <th class="w-full">
                    群組名稱
                </th>
                <th class="min-w-[16rem]">
                    關鍵字數量
                </th>
                <th>
                    操作
                </th>
            </tr>
        </thead>

        {{-- tbody --}}
        <tbody id="categoryContainer">

            @foreach($categorys as $category)
            {{-- element --}}
            <tr>
                <td>
                    <a href="{{ route('category.edit', $category->bp_category_id) }}" target="_blank">
                        {{$category->bp_category}}
                    </a>
                </td>
                <td>
                    {{$category->category_g_p_count}}
                </td>

                {{-- btns --}}
                <td class="h-full flex gap-2 items-center">
                    <button class="button danger-btn del-btn" type="button" wire:click="deletedBy('{{ $category->bp_category_id }}')">
                        <span class="mr-0 5">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                        刪除
                    </button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
