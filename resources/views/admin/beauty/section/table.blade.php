<table>
    <form method="POST" action="{{route('content.mutisetting')}}" enctype="multipart/form-data">
        @csrf
        <a href="{{route('content.create')}}" class="Button">新增文章</a>
        @include('admin.beauty.section.button')
        @foreach($subsections as $subsection)
            <tr>
                <td><input type="checkbox" name="subsections[]" value="{{$subsection->content->bp_subsection_id}}"></td>
                <td>@switch($subsection->content->bp_subsection_state)
                    @case(0)
                    草稿
                    @break
                    @case (1)
                    排程當中  將於{{$content->content->bp_subsection_enabled_date}}發佈
                    @break
                    @case (2)
                    已發佈
                    @break
                    @case (3)
                    隱藏
                    @break
                    @endswitch
                </td>
                <td><a href="{{route('content.edit',$subsection->bp_subsection_id)}}" >{{$subsection->Content->bp_subsection_title}}</a></td>
                <td>{{$subsection->content->created_at}}</td>
                <td>{{$subsection->content->updated_at}}</td>
            </tr>
        @endforeach
    </form>
</table>
