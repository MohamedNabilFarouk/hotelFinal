@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('site.branch')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('site.create')</small>
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
    <form method="post" action="{{ route('resturants.store') }}" enctype="multipart/form-data">
        @csrf

              

        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class="required form-label">@lang('site.name') @lang('site.in
                English') </label>
            <input type='text' name="name_en" class="form-control" value="{{ old('name_en') }}" />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class="required form-label">@lang('site.name') @lang('site.in
                Arabic') </label>
            <input type='text' name="name_ar" class="form-control" value="{{ old('name_ar') }}" />
        </div>



        <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.maincategory')</label>

                        <select class="form-control"  name='maincategories[]' multiple >
                            @foreach($MainCategories as $r)
                                
                                    <option value='{{$r->id}}'> {{$r->name_en ?? $r->name_ar}}</option>
                               
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.vendor')</label>

                        <select class="form-control"  name='user_id'  >
                            @foreach($vendors as $r)
                                
                            <option value='{{$r->id}}'> {{$r->name}}</option>
                               
                            @endforeach
                        </select>
                    </div>




        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class="required form-label">@lang('site.phone') 1</label>
            <input type='text' name="phone1" class="form-control" value="{{ old('phone1') }}" required />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class=" form-label">@lang('site.phone') 2</label>
            <input type='text' name="phone2" class="form-control" value="{{ old('phone2') }}" />
        </div>


        
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class="required form-label">@lang('site.address')  </label>
            <input type='text' name="address" class="form-control" value="{{ old('address') }}" />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class=" form-label">Facebook  </label>
            <input type='text' name="facebook" class="form-control" value="{{ old('facebook') }}" />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class=" form-label">Twitter  </label>
            <input type='text' name="twitter" class="form-control" value="{{ old('twitter') }}" />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class=" form-label">Youtube  </label>
            <input type='text' name="youtube" class="form-control" value="{{ old('youtube') }}" />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class=" form-label">Latitude  </label>
            <input type='text' name="lat" class="form-control" value="{{ old('lat') }}" />
        </div>
        <div class="form-group mb-10">
            <label for="exampleFormControlInput1" class=" form-label">langtude  </label>
            <input type='text' name="lng" class="form-control" value="{{ old('lng') }}" />
        </div>


        <div class="form-group mb-10">
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" name='status' id="status" checked />
                <label class="form-check-label" for="flexSwitchDefault">
                    @lang('site.status')
                </label>
            </div>
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