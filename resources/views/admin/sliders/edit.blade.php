@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('site.slider')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('site.Update')</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
@endsection

@section('content')

    @include('admin.includes.messages')

    <div class="container-fluid page__container p-2">

        <div class="card rounded card-form__body card-body shadow-lg">
            <form method="post" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.Title') @lang('site.in
                        English') </label>
                    <input type='text' name="title_en" class="form-control" value="{{ $slider->title_en }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.Title') @lang('site.in
                        Arabic') </label>
                    <input type='text' name="title_ar" class="form-control" value="{{ $slider->title_ar }}" />
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.Description')
                        @lang('site.in English') </label>
                    <textarea name="des_en" class="form-control">{{ $slider->des_en }}</textarea>
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.Description')
                        @lang('site.in Arabic') </label>
                    <textarea name="des_ar" class="form-control">{{ $slider->des_ar }}</textarea>

                </div>

                <div class="form-group col-sm-12 card card-primary card-outline">
                    <div class="text-center col-sm-12">
                        <h3 class="m-3">@lang('site.file')</h3>
                    </div>

                    <div class="input-field">
                        <div class="image p-2">
                            @error('image')
                                <br />
                                <span class="text-danger mx-1">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                </div> {{-- end of product gallery --}}



                <div class="text-right mb-5">
                    <input type="submit" name="" class="btn btn-success" value="@lang('site.Update')">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop

@section('script')
    <!-- ARCHIVES JS -->
    <script src="{{ asset('admin/js/image-uploader.min.js') }}"></script>

    <script>
        $('.image').imageUploader();
    </script>
@stop