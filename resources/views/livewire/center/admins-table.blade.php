<div>
    <form id="delete" method="POST" action="{{ route('mediaCategory.mutiDelete') }}" enctype="multipart/form-data">

        @csrf
        {{-- btns --}}
        <div class="flex flex-row justify-between mb-4">

            <div class="flex gap-2 items-center">

                {{-- 選擇帳號等級 --}}
                <div class="field w-40">
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                        <select class="input select" wire:change="byRank($event.target.value)" id="role_selecter">
                            <option value="">選擇帳號等級</option>
                            <option value="admin_a">後台全域管理員</option>
                            <option value="admin_b">單獨平台主管</option>
                            <option value="admin_c">一般後台管理員</option>
                        </select>
                    </div>
                </div>

                {{-- 篩選平台 --}}
                <div class="field w-40">
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                        <select class="input select" wire:change="byPlatform($event.target.value)"
                            id="platform_selecter">
                            <option value="">篩選-平台</option>
                            <option value="beauty">美容百科</option>
                            <option value="mirror">美容鏡</option>
                        </select>
                    </div>
                </div>

                {{-- 篩選職位 --}}
                <div class="field w-40">
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                        <select class="input select" wire:change="byRole($event.target.value)" id="lvc_selecter">
                            <option value="">篩選-職位</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->c_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- 篩選狀態 --}}
                <div class="field w-40">
                    <div class="relative">
                        <span class="input-icon right-0 pr-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                        <select class="input select" wire:model="byStatus" id="status">
                            <option value="">篩選-狀態</option>
                            <option value="0">正常</option>
                            <option value="1">凍結</option>
                            <option value="2">停用</option>
                            <option value="3">永久停用</option>
                        </select>
                    </div>
                </div>

                <button class="button primary-btn" type="button" id="reset" wire:click="reset_button">
                    重設
                </button>

            </div>

            {{-- search input --}}
            <div class="field">
                <span class="input-icon left-0 pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input class="input input-leftIcon" type="search" placeholder="輸入帳號/名稱/Eamil" id="searchInput"
                    wire:model="searchInput">
                </p>
            </div>

        </div>

        {{-- table start --}}
        <table class="table-auto w-full">

            {{-- table head --}}
            <thead>
                <tr>
                    {{-- check input --}}
                    <th class="th-check">
                        <input type="checkbox" id="select-all" onClick="selectAll()">
                    </th>
                    <th>
                        職位
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('c_name')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        名稱
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('name')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        電郵地址
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('email')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                    <th>
                        帳號
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('account')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>

                    <th>
                        狀態
                        <a class="mx-2 cursor-pointer" id="sortSizeBtn" wire:click="sortBy('status')">
                            <i class="fa-solid fa-sort"></i>
                        </a>
                    </th>
                </tr>
            </thead>

            {{-- Admin List --}}
            <tbody class="divide-y divide-gray-200">

                @forelse($admins as $admin)

                {{-- admin --}}
                    <tr class="tr">

                        {{-- check input --}}
                        <td class="th-check">
                            <input type="checkbox" class="select-item" name="mediacategory[]" value="">
                        </td>

                        {{-- 職位 --}}
                        <td>
                            {{ $admin->c_name }}
                        </td>

                        {{-- 帳號 --}}
                        <td>
                            <a href="{{route('admins.show',$admin->id)}}"> {{ $admin->account }}</a>
                        </td>

                        {{-- email --}}
                        <td>
                            {{ $admin->email }}
                        </td>

                        {{-- 帳號名稱 --}}
                        <td>
                            {{ $admin->name }}
                        </td>

                        {{-- 狀態 --}}
                        @if ($admin->status == 0 || $admin->status == null)
                            <td>
                                正常
                            </td>
                        @else
                            <td>
                                停用
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"> 未有任何相關結果。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <nav class="flex justify-center my-20" role="navigation" aria-label="pagination">

        </nav>
    </form>
    <script src="{{ asset('javascript/all-select.js') }}"></script>
</div>
