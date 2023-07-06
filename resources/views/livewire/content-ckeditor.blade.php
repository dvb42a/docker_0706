<div>
    <form id="edit_content" method="POST" action="{{route('contentcnt.update',$content_index->bp_subsection_id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <textarea id="editor" name="bp_subsection_cnt" placeholder="請在這裡填寫內容" >
            {{$content_index->bp_subsectioncnt_index}}
        </textarea>
    </form>

    <script>
        const form =document.getElementById('edit_content');
        console.log(form);
    </script>
</div>
