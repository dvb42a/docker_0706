<!-- account-info start ----- -->
<div class="w-full flex p-4">
    <a href="{{ route('admin.main') }}"
        class="flex items-center gap-x-4 py-2 leading-6 text-slate-300 hover:opacity-90 hover:text-white">
        <img class="h-8 w-8 rounded-full bg-gray-50"
            src="https://images.unsplash.com/photo-1534030347209-467a5b0ad3e6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
            alt="">
        <div class="w-[120px]">
            <div>
                <p class="font-bold">{{ Auth::guard('admin')->user()->name }}</p>
                <p class="text-xs">{{ Auth::guard('admin')->user()->getRoleCName() }}</p>
            </div>
        </div>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="h-full flex items-center">
        @csrf
        <button
            class="border border-slate-400 w-9 h-9 flex items-center justify-center rounded hover:bg-white hover:text-slate-600 ease-in-out duration-200"
            type="submit">
            <span>
                <i class="fa-solid fa-right-from-bracket"></i>
            </span>
        </button>
    </form>

</div>
