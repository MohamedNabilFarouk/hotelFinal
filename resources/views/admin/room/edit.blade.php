@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Room')}}
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">{{__('Edit')}}</small>
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
            <form method="post" action="{{ route('room.update', $room->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')




                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Hotel')}}</label>

                        <select class="form-control"  name='hotel_id'  >
                            @foreach($hotels as $r)

                            <option value='{{$r->id}}' @if($r->id == $room->hotel_id) selected @endif> {{$r->title}}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Type')}}</label>

                        <select class="form-control"  name='type' id='type'  >
                            <option value='hotel_room' @if($room->type == 'hotel_room') selected @endif)>{{__('Hotel Room')}} </option>
                            <option value='space' @if($room->type == 'space') selected @endif> {{__('Space')}}</option>

                        </select>
                    </div>
                    <div class="form-group mb-10" id='size_type_div'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Size Type')}}</label>

                    <select class="form-control"  name='type_id'  id='size_type' >
                            @foreach($types as $r)

                            <option value='{{$r->id}}'> {{$r->title}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('View Type')}}</label>

                        <select class="form-control"  name='view_type' >
                            <option value='sea'>{{__('Sea View')}} </option>
                            <option value='pool'>{{__('Pool View')}} </option>
                            <option value='garden'> {{__('Garden')}}</option>
                        </select>
                    </div>

                    <div class='row'>
                        @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )

                        <div class="form-group mb-10 col-md-6" id="{{$key}}">
                            <label for="exampleFormControlInput1" class="required form-label">{{__('Title')}} ({{$key}})</label>
                            <input type='text' name="title_{{$key}}" class="form-control" value="{{ $room-> getTranslation('title', $key) }}" />
                        </div>
                        @endforeach
                    </div>
                    <div class='row'>
                        @foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value )
                        <div class="form-group mb-10  col-md-6">
                            <label for="exampleFormControlInput1" class="required form-label">{{__('Content')}} ({{$key}})</label>
                            <textarea  name="content_{{$key}}" class="form-control" >{{ $room->getTranslation('content', $key) }}</textarea>
                        </div>
                        @endforeach
                    </div>

                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Number')}}</label>
                    <input type='text' name="number" class="form-control" value="{{ $room->number }}" />
                </div>

                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Beds')}}</label>
                    <input type='text' name="bed" class="form-control" value="{{ $room->bed }}" />
                </div>

                <div class="form-group mb-5" id='max-guest'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Max Guest')}}</label>
                    <input type='number' name="max_guest" class="form-control" value="{{ old('max_guest') }}" />
                </div>

                <div class="form-group mb-5" id='max-adult'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Adult')}} {{__('Max')}}</label>
                    <input type='number' name="adult" class="form-control" value="{{$room->adult }}" />
                </div>
                <div class="form-group mb-5"  id='max-child'>
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Child')}} {{__('Max')}}</label>
                    <input type='number' name="child" class="form-control" value="{{$room->child }}" />
                </div>
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Size')}} </label>
                    <input type='number' name="size" class="form-control" value="{{ $room->size }}" />
                </div>
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Price')}}</label>
                    <input type='number' name="price" class="form-control" value="{{$room->price }}" />
                </div>
                <label class="fs-3 fw-bold mb-2">{{__('Other Prices For Countries')}}</label>
                <hr>
                <input type='hidden' value='{{count($room->prices)}}' id='count'>
                @foreach($room->prices as $INDEX=>$p)
                    <div class="row g-9 mb-8" data-select2-id="select2-data-72-jo53">
														<!--begin::Col-->
														<div class="col-md-6 fv-row" data-select2-id="select2-data-71-0h3a">
															<label class="required fs-6 fw-bold mb-2">{{__('Country')}}</label>
															<!-- <input type="text" name="arr[{{$INDEX}}][country]" value='{{$p->ip}}' class="form-control text-view" required> -->
                                                                    <select class="form-control"  name="arr[{{$INDEX}}][country]"  >
                                                                        @foreach($countries as $r)

                                                                        <option value='{{$r->code}}' @if($r->code == $p->ip) selected @endif> {{$r->name}}</option>

                                                                        @endforeach
                                                                    </select>
                                                        </div>
														<!--end::Col-->
														<!--begin::Col-->
														<div class="col-md-6 fv-row">
															<label class="required fs-6 fw-bold mb-2">{{__('price')}}</label>
															<!--begin::Input-->
															<div class="position-relative d-flex align-items-center">

																<!--begin::Datepicker-->
																<input type="number" name="arr[{{$INDEX}}][price]" value='{{$p->price}}' class="form-control text-view" required>
																<!--end::Datepicker-->
															</div>
															<!--end::Input-->
														</div>
														<!--end::Col-->
													</div>
               @endforeach
               <div class="col-md-12">
               <div id='country_price'>
        <a class='btn btn-danger'  id='add'>+</a>
   </div>
</div>
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">Images</label>
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



                <div class="text-right mb-5">
                    <input type="submit" name="add" class="btn btn-success" value="add">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    var i = $('#count').val();
   $('#add').click(function(){
    //    alert('here');

    // event.preventDefault();

    //    alert('here');
    //    var input = '<div class="col-md-3"><div class="form-title"><strong>{{__("Countries")}}</strong></div><div class="form-group"><div class="upload-btn-wrapper"> <select class="form-control" name="arr['+i+'][country]" > @foreach($countries as $r) <option value="{{$r->code}}" > {{$r->name}}</option> @endforeach </select></div></div></div><div class="col-md-3"><div class="form-title"><strong>{{__("Price")}}</strong></div><div class="form-group"><div class="upload-btn-wrapper"><div class="input-group"><input type="number" name="arr['+i+'][price]" class="form-control text-view" required></div></div></div></div>';
       var input = '<div class="row g-9 mb-8" data-select2-id="select2-data-72-jo53"><!--begin::Col--><div class="col-md-6 fv-row" data-select2-id="select2-data-71-0h3a"><label class="required fs-6 fw-bold mb-2">{{__('Country')}}</label> <select class="form-control" name="arr['+i+'][country]" > @foreach($countries as $r) <option value="{{$r->code}}" > {{$r->name}}</option> @endforeach </select> </div><!--end::Col--><!--begin::Col--><div class="col-md-6 fv-row"><label class="required fs-6 fw-bold mb-2">{{__("price")}}</label><!--begin::Input--><div class="position-relative d-flex align-items-center"><!--begin::Datepicker--><input type="number" name="arr['+i+'][price]"  class="form-control text-view" required><!--end::Datepicker--></div><!--end::Input--></div><!--end::Col--></div>';

       $('#country_price').append(input);
       i++;
   }) ;


   $('#size_type_div,#max-guest').hide();
   $('#type').change(function(){
    type = $('#type').val();

        if(type == 'space'){
            $('#size_type_div,#max-guest').show(); // for sapce
            $('#max-child,#max-adult').hide();  //for hotel room
        }else{
            $('#size_type_div,#max-guest').hide(); // for sapce
            $('#max-child,#max-adult').show(); //for hotel room
        }
   });
</script>
@stop
