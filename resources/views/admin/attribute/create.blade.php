@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Attribute')}}
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">{{__('Attribute')}}</small>
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
            <form method="post" action="{{ route('attribute.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Title')}}</label>
                    <input type='text' name="title" class="form-control" value="{{ old('title') }}" />
                </div>
             
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Service')}}</label>

                        <select class="form-control"  name='service[]' multiple >       
                            <option value='hotel_room'>{{__('Hotel Room')}} </option>
                            <option value='space'>{{__('Space')}} </option>
                            <option value='tour'> {{__('Tour')}}</option>       
                        </select>
                    </div>

                    <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">Icon</label>
                    <input class="image_name" type="file" name="icon" value="" >
                </div>








                <div class="text-right mb-5">
                    <input type="submit" name="add" class="btn btn-success" value="{{__('Add')}}">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop
