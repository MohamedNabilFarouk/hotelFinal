@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Hotel')}}
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">{{__('Create')}}</small>
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
            <form method="post" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
                @csrf

                @if (auth()->user()->hasRole(['admin', 'moderator']))

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Vendor')}}</label>

                        <select class="form-control"  name='vendor_id'  >
                            @foreach($vendors as $r)

                            <option value='{{$r->id}}'> {{$r->name}}</option>

                            @endforeach
                        </select>
                    </div>


                @endif

                <div class='row'>
                    @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
                    <div class="form-group mb-10 col-md-6">
                        <label for="exampleFormControlInput1" class="required form-label">{{__('Title')}} ({{$key}})</label>
                        <input type='text' name="title_{{$key}}" class="form-control" value="{{ old('title_'.$key) }}" />
                    </div>
                    @endforeach
                    </div>

                    <div class='row'>
                        @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
                        <div class="form-group mb-10 col-md-6">
                        <label for="exampleFormControlInput1" class="required form-label">{{__('Content')}} ({{$key}})</label>
                        <textarea  name="content_{{$key}}" class="form-control" >{{ old('content_'.$key) }}</textarea>
                    </div>
                    @endforeach
                    </div>

                    <div class='row'>
                        @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
                        <div class="form-group mb-10 col-md-6">
                        <label for="exampleFormControlInput1" class="required form-label">{{__('Address')}} ({{$key}})</label>
                        <input type='text' name="address_{{$key}}" class="form-control" value="{{ old('address_'.$key) }}" />
                    </div>

                    @endforeach
                    </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('City')}}</label>

                        <select class="form-control"  name='gov_id'  >
                            @foreach($gov as $r)

                            <option value='{{$r->id}}'> {{$r->name_en}}</option>

                            @endforeach
                        </select>
                    </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Video')}}</label>
                    <input type='text' name="video" class="form-control" value="{{ old('video') }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('map')}}</label>
                    <input type='text' name="map" class="form-control" value="{{ old('map') }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Deposit Percentage')}}</label>
                    <input type='number' name="deposit_percentage" class="form-control" value="{{ old('deposit_percentage') }}"  placeholder='ex: 50'/>
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Stars Rate')}}</label>
                    <input type='number' name="star_rate" class="form-control" value="{{ old('star_rate') }}" />
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1" class="required form-label">Image</label>
                    <input class="image_name" type="file" name="image" value="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="required form-label">Gallery</label>
                    <input class="image_name" type="file" name="gallery[]" value="" multiple>
                </div>

                <div class="form-group mb-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" name='status' id="status" checked />
                        <label class="form-check-label" for="flexSwitchDefault">
                           {{__('Status')}}
                        </label>
                    </div>
                </div>

                <div class="form-group mb-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" name='home' id="home"  />
                        <label class="form-check-label" for="flexSwitchDefault">
                           {{__('Home Page')}}
                        </label>
                    </div>
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Order')}}</label>
                    <input type='number' name="order_no" class="form-control" value="{{ old('order_no') }}" min="1" max="100" placeholder="From 1 To 100"/>
                </div>
                <div class="text-right mb-5">
                    <input type="submit" name="add" class="btn btn-success" value="add">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop
