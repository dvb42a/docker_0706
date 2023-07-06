<script src="{{ asset('ckeditor5/build/ckeditor.js') }}" ></script>
<textarea id="editor" name="bp_subsection_cnt" placeholder="請在這裡填寫內容" ></textarea>

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
