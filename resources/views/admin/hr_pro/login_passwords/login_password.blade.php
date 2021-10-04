
<div class="container">
    <form action="{{route('admin.hr_pro.update_trade_license__sponsors__partners')}}" method="post"    enctype="multipart/form-data">
        @csrf
        <textarea name="login_password" rows="30">

        </textarea>
        <div class="text-center mt-4">
            <input type="submit" value="Save" class="btn btn-primary">

        </div>
    </form>
</div>


<script src="https://cdn.tiny.cloud/1/xe86jsstydxsysjdo473wyinbzuz1mziocelg4wajosqses0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
   });
</script>