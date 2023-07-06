<script src="{{ asset('ckeditor5/build/ckeditor.js') }}" ></script>


<style>
    .ck-editor__editable_inline {
        /* 設定最低高度 */
        height: 90vh;
    }
</style>

@livewireStyles
@livewire('contentckeditor' ,['content_id' => $content_id])
@livewireScripts


<script>
    var openNewWindow=0;
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
