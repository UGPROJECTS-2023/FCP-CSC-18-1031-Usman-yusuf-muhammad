@extends('admin.pages.dashboard')
@section('contents')

   
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
      tinymce.init({
  selector: 'textarea',  // change this value according to your HTML
  plugins: 'image code print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link    table charmap hr pagebreak nonbreaking  toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern media ',
  toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat |undo redo | image code| link fontsizeselect  | preview quickimage quicklink quicktable cancel save searchreplace spellcheckdialog spellchecker ',

  a_plugin_option: true,
  a_configuration_option: 400
});

  </script>


<form action="">
    <textarea name="" id="" cols="30" rows="10"></textarea>
</form>


@endsection