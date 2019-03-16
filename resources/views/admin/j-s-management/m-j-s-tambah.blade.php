@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | JENIS SURAT')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen Jenis Surat</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Jenis Surat</a></li>
                    <li class="breadcrumb-item active">Manajemen Jenis Surat</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ $error }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-elements">
                                <form id="form-addSuratKeluar" action="{{route('jsm-tambah-selesai')}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Jenis Surat <span class="text-danger">*</span></label>
                                                <input class="form-control input-sm" type="text" name="jenis_surat" placeholder="nama jenis surat..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Template Surat <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select form-control-sm" id="template_surat" name="template" required>
                                                        <option value="" disabled readonly="" selected>Pilih Template Surat</option>
                                                        <option value="Template 1">Template 1</option>
                                                        <option value="Template 2">Template 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lembaga">Lembaga/Yayasan <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select form-control-sm" id="lembaga" name="lembaga"  required>
                                                        <option readonly="true" selected disabled>Pilih Jenis</option>
                                                        @foreach (\App\Lembaga::all() as $key => $lembagas)
                                                            <option value="{{$lembagas->id}}">{{$lembagas->nama_lembaga}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Isi <span class="text-danger">*</span></label>
                                                <textarea class="form-control isi" name="isi" id="isi" cols="30" rows="10">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr><div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-primary">Clear</button>
                                                <a href="{{route('jsm-home')}}" class="btn btn-dark">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
    </div>
        <!-- End Container fluid  -->
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script>
        var fForm = $('#form-add');
        var fConfirm = $('button#add');

        fConfirm.on('click', function(){
            fForm.submit();
        });

        // tinymce.init({
        //     selector: '.isi',
        //     height: "500",
        //     plugins: [
        //         "autolink link image charmap print preview hr anchor pagebreak",
        //         "wordcount visualblocks code fullscreen",
        //         "insertdatetime media nonbreaking save table contextmenu directionality",
        //         "template paste textcolor colorpicker textpattern"
        //     ],
        //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft alignceter alignright " +
        //         "alignjustify | bullist numlist outdent indent | link image media | fontsizeselect",
        //     fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt'
        // });

        tinymce.init({
            selector: '.isi',
            height: 500,
            plugins: 'table wordcount code',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'],

            style_formats: [
                { title: 'Bold text', inline: 'strong' },
                { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
                { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
                { title: 'Badge', inline: 'span', styles: { display: 'inline-block', border: '1px solid #2276d2', 'border-radius': '5px', padding: '2px 5px', margin: '0 2px', color: '#2276d2' } },
                { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
            ],
            formats: {
                alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left' },
                aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center' },
                alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right' },
                alignfull: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full' },
                bold: { inline: 'span', 'classes': 'bold' },
                italic: { inline: 'span', 'classes': 'italic' },
                underline: { inline: 'span', 'classes': 'underline', exact: true },
                strikethrough: { inline: 'del' },
                customformat: { inline: 'span', styles: { color: '#00ff00', fontSize: '20px' }, attributes: { title: 'My custom format' }, classes: 'example1' },
            }
        });
    </script>
@endsection