@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Space')}}
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
            <form method="post" action="{{ route('space.update', $space->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
               

                

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Type')}}</label>

                        <select class="form-control"  name='type_id'  >
                            @foreach($types as $r)
                                
                            <option value='{{$r->id}}'  @if($r->id == $space->type_id) selected @endif> {{$r->title}}</option>
                               
                            @endforeach
                        </select>
                    </div>


               

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Title')}}</label>
                    <input type='text' name="title" class="form-control" value="{{ $space->title}}" />
                </div>
             

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Content')}}</label>
                    <input type='text' name="content" class="form-control" value="{{ $space->content }}" />
                </div>
               
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Number')}}</label>
                    <input type='text' name="number" class="form-control" value="{{ $space->address }}" />
                </div>
                
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Beds')}}</label>
                    <input type='text' name="bed" class="form-control" value="{{ $space->bed }}" />
                </div>

                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Bathrooms')}} </label>
                    <input type='number' name="bathroom" class="form-control" value="{{ $space->bathroom }}" />
                </div>

                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Max Guest')}}</label>
                    <input type='number' name="max_guest" class="form-control" value="{{ $space->max_guest }}" />
                </div>
               
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Size')}} </label>
                    <input type='number' name="size" class="form-control" value="{{ $space->size }}" />
                </div>
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Price')}}</label>
                    <input type='number' name="price" class="form-control" value="{{ $space->price }}" />
                </div>
                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Sale Price')}}</label>
                    <input type='number' name="sale_price" class="form-control" value="{{ $space->sale_price }}" />
                </div>


                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Address')}}</label>
                    <input type='text' name="address" class="form-control" value="{{ $space->address }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Country')}}</label>

                        <select class="form-control"  name='country_id'  >
                            @foreach($countries as $r)
                                
                            <option value='{{$r->id}}' @if($r->id == $space->country_id) selected @endif> {{$r->name}}</option>
                               
                            @endforeach
                        </select>
                    </div>


                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('star Rate')}}</label>
                    <input type='number' name="star_rate" class="form-control" value="{{ $space->star_rate }}" />
                </div>

                <div class="form-group mb-5">
                    <label for="exampleFormControlInput1" class="required form-label">Images</label>
                    <input class="image_name" type="file" name="images[]" value="" multiple>
                </div>

                <div class="form-group mb-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" name='status' id="status"  @if($space->on_sale == 1) checked @endif/>
                        <label class="form-check-label" for="flexSwitchDefault">
                           {{__('On Sale')}}
                        </label>
                    </div>
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
@stop
