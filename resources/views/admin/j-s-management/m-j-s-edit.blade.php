@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | JENIS SURAT EDIT')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen Jenis Surat Edit</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Jenis Surat</a></li>
                    <li class="breadcrumb-item active">Manajemen Jenis Surat Edit</li>
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
                                {!! $error !!}
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
                                <form class="form-valide" action="{{route('jsm-update', $jSurat->id)}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nama Jenis Surat <span class="text-danger">*</span></label>
                                                <input class="form-control input-sm" type="Text" name="jenis_surat" value="{{$jSurat->nama_jenis_surat}}" placeholder="nama jenis surat..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kode Jenis Surat <span class="text-danger">*</span></label>
                                                <input class="form-control input-sm" type="text" name="kode" value="{{$jSurat->kode_surat}}" placeholder="nama kode surat...">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Template Surat <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select form-control-sm" id="template_surat" name="template" required>
                                                        <option value="" disabled readonly="" selected>Pilih Template Surat</option>
                                                        @if($jSurat->template_surat == 'Template 1')
                                                            <option value="Template 1" selected>Template 1 -- Header Internal</option>
                                                            <option value="Template 2">Template 2 -- Header Eksternal</option>
                                                        @elseif($jSurat->template_surat == 'Template 2')
                                                            <option value="Template 1">Template 1 -- Header Internal</option>
                                                            <option value="Template 2" selected>Template 2 -- Header Eksternal</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="lembaga">Lembaga/Yayasan <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select form-control-sm" id="lembaga" name="lembaga"  required>
                                                        <option readonly="true" disabled>Pilih Jenis</option>
                                                        @foreach (\App\Lembaga::all() as $value)
                                                            <option value="{{$value->id}}"
                                                                    @if($value->id == $jSurat->lembaga_id)
                                                                    selected
                                                                    @endif
                                                            >{{$value->nama_lembaga}}</option>
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
                                                <textarea class="form-control isi" name="isi" id="isi" >{!! $jSurat->template_konten  !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary" id="confirm">Submit</button>
                                            <a href="{{route('jsm-home')}}" class="btn btn-dark">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>

    <script>
        var fForm = $('#form-confirm');
        var fConfirm = $('button#confirm');

        fConfirm.on('click', function(){
            fForm.submit();
        });

        var editor_config;
        $(function () {
            editor_config = {
                branding: false,
                path_absolute: '{{url('/')}}',
                selector: '.isi',
                height: 600,
                themes: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code',
                    'insertdatetime media table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                relative_urls: false,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth ||
                        document.getElementsByTagName('body')[0].clientWidth,
                        y = window.innerHeight || document.documentElement.clientHeight ||
                            document.getElementsByTagName('body')[0].clientHeight,
                        cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + '&type=Images';
                    } else {
                        cmsURL = cmsURL + '&type=Files';
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'File Manager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: 'yes',
                        close_previous: 'no'
                    });
                }
            };
            tinymce.init(editor_config);
        })
    </script>
@endsection