<script>
    @if(session()->has('message'))
        toastr.success("新增成功")
    @endif
    @if(session()->has('message_update'))
        toastr.success("更新成功")
    @endif
    @if(session()->has('message_delete'))
        toastr.success("刪除成功")
    @endif
    @if(session()->has('message_save'))
        toastr.success('儲存成功')
    @endif
    @if(session()->has('message_posted'))
        toastr.success('發布成功')
    @endif
    @if(session()->has('preview'))
        toastr.success('儲存成功。正在打開預覽頁面');
        preview();
    @endif
    @if(session()->has('errorHideSubsection'))
        toastr.error('非發布狀態的文章無法隱藏。');
    @endif
    @if(session()->has('errorDeleteSubsection'))
        toastr.error('只有草稿及停用狀態才可刪除。');
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{$error}}')
        @endforeach
    @endif

    window.addEventListener('deleteSuccess', event =>
    {
        toastr.success("刪除成功")
    })
    window.addEventListener('deleteFailed_section', event =>
    {
        toastr.error("關鍵字已被設定為章節，無法刪除。")
    })
    window.addEventListener('deleteFailed', event =>
    {
        toastr.error("關鍵字已被使用，無法刪除。")
    })


</script>
