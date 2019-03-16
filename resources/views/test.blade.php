<html>
    <head>
        <title>coba</title>
        {{--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>--}}
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Pembuka</label>
                        <textarea class="form-control" id="mytextarea"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea class="form-control" id="textarea"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Penutup</label>
                        <textarea class="form-control" id="textarea"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script>
    tinymce.init({
    selector: 'textarea',
    plugins: [
    "autolink link image charmap print preview hr anchor pagebreak",
    "wordcount visualblocks code fullscreen",
    "insertdatetime media nonbreaking save table contextmenu directionality",
    "template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignmentleft alignmentceter alignmentright " +
    "alignmentjustify | bullist numlist outdent indent | link image media"
    });
    </script>
</html>