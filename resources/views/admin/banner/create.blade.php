@extends('admin.layouts.master')


@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('site.banner')
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('site.create')</small>
            <!--end::Description--></h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->

    </div>
    <!--end::Container-->
</div>
@endsection

@section('content')

@include('admin.layouts.inc-messages')

        <div class="container-fluid page__container">

            <div class="card card-form__body card-body">
                <form method="post" action="{{ route('banner.store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('site.Title') @lang('site.in English') </label>
                        <input type='text' name="title_en" class="form-control form-control-solid" value="{{old('title_en')}}" />
                    </div>
                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('site.Title') @lang('site.in Arabic') </label>
                        <input  type='text' name="title_ar" class="form-control form-control-solid" value="{{old('title_ar')}}" />
                    </div>

                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('site.Description') @lang('site.in English') </label>
                        <textarea  name="des_en" class="form-control form-control-solid" >{{old('des_en')}}</textarea>
                    </div>

                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('site.Description') @lang('site.in Arabic') </label>
                        <textarea  name="des_ar" class="form-control form-control-solid" >{{old('des_ar')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('site.Image') </label>
                        <input class="image_name" type="file" name="image" value="">
                    </div>

                    <div class="text-right mb-5">
                        <input type="submit" name="add" class="btn btn-success" value="@lang('site.add')">
                    </div>
                </form>
            </div>
        </div>
        <!-- // END drawer-layout__content -->
    </div>
@stop
