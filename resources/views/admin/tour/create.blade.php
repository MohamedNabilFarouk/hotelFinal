@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Tour')}}
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
            <form method="post" action="{{ route('tour.store') }}" enctype="multipart/form-data">
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
    <div class="form-group mb-5">
        <label for="exampleFormControlInput1" class="required form-label">{{__('Type')}}</label>
        <select class="form-control"  name='type' id='type'  >
            <option value='ordinary'>ordinary</option>
            <option value='special'>special</option>
        </select>
    </div>
@foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
<div class="form-group mb-10 col-md-6">
    <label for="exampleFormControlInput1" class="required form-label">{{__('Title')}} ({{$key}})</label>
    <input type='text' name="title_{{$key}}" class="form-control" value="{{ old('title') }}" />
</div>
@endforeach
</div>

<div class='row'>
    @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
    <div class="form-group mb-10 col-md-6">
    <label for="exampleFormControlInput1" class="required form-label">{{__('Content')}} ({{$key}})</label>
    <textarea  name="content_{{$key}}" class="form-control" >{{ old('content') }}</textarea>
</div>
@endforeach
</div>

<div class='row'>
    @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
    <div class="form-group mb-10 col-md-6">
    <label for="exampleFormControlInput1" class="required form-label">{{__('Address')}} ({{$key}})</label>
    <input type='text' name="address_{{$key}}" class="form-control" value="{{ old('address') }}" />
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

                        <div id='country_price'>
                        <div class="form-group mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">{{__('Price')}}</label>
                            <input type='number' name="price" class="form-control" value="{{ old('price') }}" />
                        </div>

                        <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Child Price')}}</label>
                    <input type='number' name="child_price" class="form-control" value="{{ old('child_price') }}" />
                </div>

                <div class="form-group mb-5" id='world'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('World')}} {{__('Price')}}</label>
                    <input type='number' name="world_price" class="form-control" value="{{ old('world_price') }}" />
                </div>
                        <div class="col-md-12" id='extra'>
                                <a class='btn btn-danger'  id='add'>+</a>
                        </div>
                </div>

                <div class="form-group mb-5" id='max-guest'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Max Guest')}}</label>
                    <input type='number' name="max_people" class="form-control" value="{{ old('max_people') }}" />
                </div>
                <div class="form-group mb-5" id='max-guest'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Min Guest')}}</label>
                    <input type='number' name="min_people" class="form-control" value="{{ old('min_people') }}" />
                </div>
                <div class="form-group mb-5" id='max-guest'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Min. Days Before Booking')}}</label>
                    <input type='text' name="min_day_befor_booking" class="form-control" value="{{ old('min_day_befor_booking') }}" />
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
                    <input class="image_name" type="file" name="image[]" value="" multiple>
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

                <div class="text-right mb-5">
                    <input type="submit" name="add" class="btn btn-success" value="add">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>


    <script>
    var i = 1;

   $('#add').click(function(){
    //    alert('here');

    // event.preventDefault();

    //    alert('here');
    //    var input = '<div class="col-md-3"><div class="form-title"><strong>{{__("Countries")}}</strong></div><div class="form-group"><div class="upload-btn-wrapper"> <select class="form-control" name="arr['+i+'][country]" > @foreach($countries as $r) <option value="{{$r->code}}" > {{$r->name}}</option> @endforeach </select></div></div></div><div class="col-md-3"><div class="form-title"><strong>{{__("Price")}}</strong></div><div class="form-group"><div class="upload-btn-wrapper"><div class="input-group"><input type="number" name="arr['+i+'][price]" class="form-control text-view" required></div></div></div></div>';
       var input = '<div class="row g-9 mb-8" data-select2-id="select2-data-72-jo53"> <!--begin::Col--> <div class="col-md-6 fv-row" data-select2-id="select2-data-71-0h3a"> <label class="required fs-6 fw-bold mb-2">{{__('Country')}}</label> <select class="form-control" name="arr['+i+'][country][]" multiple > @foreach($countries as $r) <option value="{{$r->code}}" > {{$r->name}}</option> @endforeach </select> </div> <!--end::Col--><!--begin::Col--> <div class="col-md-3 fv-row"> <label class="required fs-6 fw-bold mb-2">{{__("price")}}</label><!--begin::Input--> <div class="position-relative d-flex align-items-center"> <!--begin::Datepicker--><input type="number" name="arr['+i+'][price]" class="form-control text-view" required><!--end::Datepicker--> </div> <!--end::Input--> </div> <!--end::Col--><!--begin::Col--> <div class="col-md-3 fv-row"> <label class="required fs-6 fw-bold mb-2">{{__("Child Price")}}</label><!--begin::Input--> <div class="position-relative d-flex align-items-center"> <!--begin::Datepicker--><input type="number" name="arr['+i+'][ch_price]" class="form-control text-view" required><!--end::Datepicker--> </div> <!--end::Input--> </div> <!--end::Col--></div>';

       $('#country_price').append(input);
       i++;
   }) ;
   $('#add').hide();
   $('#type').change(function(){
    type = $('#type').val();

        if(type == 'special'){
            $('#add').show();
            $('#world').hide();
        }else{
            $('#add').hide();
            $('#world').show();
        }
   });
</script>
@stop


