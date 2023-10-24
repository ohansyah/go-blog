<script src='{{ env("TINYMCE_CDN_URL") }}' referrerpolicy="origin"></script>
<script>
  tinymce.init({
    skin: "oxide-dark",
    content_css: "dark",
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
  });
</script>
