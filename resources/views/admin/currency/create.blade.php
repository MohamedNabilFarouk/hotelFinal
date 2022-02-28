@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Currency')}}
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">{{__('Currency')}}</small>
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
            <form method="post" action="{{ route('currency.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Name')}}</label>
                    <input type='text' name="name" class="form-control" value="{{ old('name') }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Abbr')}}</label>
                    <input type='text' name="abbr" class="form-control" value="{{ old('abbr') }}"  placeholder='ex: USD'/>
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Exchange Rate')}}</label>
                    <input type='number' name="ex_rate" class="form-control" value="{{ old('ex_rate') }}" step="0.01" />
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
