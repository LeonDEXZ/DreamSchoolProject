<form action="index.php?controller=admin&v=test_bb_convert" method="post">
    <input id="page_name" type="text" name="page_name"> 
    <textarea id="editor1" name="editor1">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1' );
    </script>
    <input type="submit" value="SAVE" onclick="onClickSandHtml()">
    <input type="button" value="SASSVE" onclick="onClickSandHtml()">
</form>
<div class="A11"></div>