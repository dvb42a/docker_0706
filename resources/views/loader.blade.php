
{{-- 使用 loder 必須在主要容器加入 main-content --}}

<div id="loader" class="absolute h-[100vh] w-full flex items-center justify-center z-[100] bg-slate-50">
    <div class="border-slate-300 border-4 border-l-lightPrimary rounded-[50%] w-8 h-8 animate-spin"></div>
</div>

<script src="{{ asset('javascript/loader.js') }}"></script>
<script>
    onReady(function() {
        setVisible('.main-content', true);
        setVisible('#loader', false);
        removeLoader();
    });
</script>
