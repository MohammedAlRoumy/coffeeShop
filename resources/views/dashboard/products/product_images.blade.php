@extends('dashboard.dashboard')

@section('css')
    <link href="{{asset('assets/css/pages/wizard/wizard-4.rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">المنتجات</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">إضافة منتج</span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Info-->

        </div>
    </div>
@endsection
@section('content')


    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom card-transparent">
                <div class="card-body p-0">
                    <!--begin::Wizard-->
                    <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">
                        <!--begin::Wizard Nav-->
                        <!--end::Wizard Nav-->
                        <!--begin::Card-->
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-10">
                                        <!--begin::Wizard Form-->

                                        {{--    <form action="{{route('products.save_images')}}" method="post" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                {{ csrf_field() }}
                                            </form>--}}
                                        <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form"
                                              action="{{route('products.images.store.db')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{$id}}">

                                            {{--                                            <input type="hidden" name="product_id" value="{{ $product->id }}">--}}

                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-3 col-sm-12 text-lg-right">صور
                                                    المنتج</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">

                                                    <div class="form-group">
                                                        <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                            <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                                        </div>
                                                        <br><br>
                                                    </div>

                                                    @if ($product->images)
                                                        <hr>
                                                        <div class="row">
                                                            @foreach($product->images as $image)
                                                                <div class="col-md-3">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <img src="{{ asset('uploads/products/'.$image->image) }}" id="brandLogo" class="img-fluid" alt="img">
                                                                            <a class="card-link float-right text-danger" href="{{ route('products.images.delete', $image->id) }}">
                                                                                <i class="fa fa-fw fa-lg fa-trash"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>

                                            <!--begin::Wizard Actions-->
                                            <div
                                                class="d-flex justify-content-between border-top pt-10 mt-15">

                                                <div>
                                                    <button type="submit"
                                                            class="btn btn-success font-weight-bolder px-9 py-4">
                                                        إضافة
                                                    </button>
                                                    <a href="" id="next-step"
                                                       class="btn btn-primary font-weight-bolder px-9 py-4">إلغاء</a>
                                                </div>
                                            </div>

                                        </form>
                                        <!--end::Wizard Actions-->

                                        <!--end::Wizard Form-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Wizard-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('js')
    <script src="{{asset('assets/dropzone/dropzone.min.js')}}"></script>
{{--<script src="{{asset('assets/js/pages/crud/file-upload/dropzonejs.js')}}"></script>--}}

    <script>

        var uploadedDocumentMap = {}
        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            //autoProcessQueue: false,
            maxFilesize: 10, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
            dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
            dictCancelUpload: "الغاء الرفع ",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: "حذف الصوره",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من 6 ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }

            ,
            url: "{{ route('products.images.store') }}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            }
            ,
            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function () {

                @if(isset($event) && $event->document)
                var files =
                {!! json_encode($event->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }


    </script>

@endsection
