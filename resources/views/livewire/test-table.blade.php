
<table >
    <tbody wire:sortable="updateTaskOrder">
        <form method="POST" action="{{route('chapter.hashtagCreate')}}" enctype="multipart/form-data" >
            @csrf
                @foreach($sections as $section)
                    <tr wire:sortable.item="{{$section->bp_section_id}}" wire:key="section-{{$section->bp_section_id}}" wire:sortable.handle>
                        <td  >
                            <box-icon name='menu'></box-icon>
                        {{--  <a wire:click.prevent="section_up({{$section->bp_section_id}})" href="#">&uarr;</a>
                            <a wire:click.prevent="section_down({{$section->bp_section_id}})" href="#">&darr;</a> --}}
                        </td>
                        <td>{{$section->bp_section_id}}{{$section->Tag->bp_hashtag}} {{$section->bp_section_sequence}}</td>
                        <td><button wire:click="deleteKy({{ $section->bp_section_id }})" >DEL</button></td>
                        <td><button>save</button></td>
                    </tr>
                @endforeach
                <td>
                    <input name="bp_tag_name[]">
                    <button name="submit_chapter" value="{{$chapter}}">儲存</button>
                </td>
        </form>
    </tbody>
</table>
<table >
    <tbody wire:sortable="updateTaskOrder">
        <form method="POST" action="{{route('chapter.hashtagCreate')}}" enctype="multipart/form-data" >
            @csrf
                @foreach($sections_2 as $section_2)
                    <tr wire:sortable.item="{{$section_2->bp_section_id}}" wire:key="section-{{$section_2->bp_section_id}}" wire:sortable.handle>
                        <td  >
                            <box-icon name='menu'></box-icon>
                        {{--  <a wire:click.prevent="section_up({{$section->bp_section_id}})" href="#">&uarr;</a>
                            <a wire:click.prevent="section_down({{$section->bp_section_id}})" href="#">&darr;</a> --}}
                        </td>
                        <td>{{$section_2->bp_section_id}}{{$section_2->Tag->bp_hashtag}} {{$section_2->bp_section_sequence}}</td>
                        <td><button wire:click="deleteKy({{ $section_2->bp_section_id }})" >DEL</button></td>
                        <td><button>save</button></td>
                    </tr>
                @endforeach
                <td>
                    <input name="bp_tag_name[]">
                    <button name="submit_chapter" value="{{$chapter2}}">儲存</button>
                </td>
        </form>
    </tbody>
</table>

