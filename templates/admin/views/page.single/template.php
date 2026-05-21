<!--<link rel="stylesheet" href="https://unpkg.com/trix/dist/trix.css">-->
<!--<script src="https://unpkg.com/trix/dist/trix.umd.js"></script>-->
<!---->
<!--<input id="x" type="hidden" name="content">-->
<!--<trix-editor input="x"></trix-editor>-->
<!---->
<!---->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<div id="editor"></div>
<div id="editor_preview"></div>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>

<script>
    var quill = new Quill('#editor_preview', {
        theme: 'snow'
    });
</script>



<!--<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest/dist/editor.js"></script>-->
<!---->
<!--<div id="editorjs"></div>-->
<!--<script>-->
<!--    const editor = new EditorJS({ holder: 'editorjs' });-->
<!--</script>-->


<!--<link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">-->
<!--<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>-->
<!---->
<!--<textarea id="editor"></textarea>-->
<!--<script>-->
<!--    const editor = SUNEDITOR.create('editor');-->
<!--</script>-->