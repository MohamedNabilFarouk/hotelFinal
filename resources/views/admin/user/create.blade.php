@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('site.User')
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
            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf


                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.name')</label>
                    <input type='text' name="name" class="form-control" value="{{ old('name') }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.Email')</label>
                    <input type='text' name="email" class="form-control" value="{{ old('email') }}" />
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.phone')</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                </div>


                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.password')</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.confirm')
                        @lang('site.password')</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">

                </div>



                <div class="form-group mb-10">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <label for="exampleFormControlInput1" class="required form-label">@lang('site.role')</label>

                        <select class="form-control" name='role' id='role'>
                            @foreach ($roles as $r)
                                <option value='{{ $r->id }}'>{{ $r->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

<div id='vendor_data'>
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="required form-label">tax card</label>
                    <input class="image_name" type="file" name="tax_card"  >
                </div>


                <div class="form-group">
                    <label for="exampleFormControlInput1" class="required form-label">commercial record</label>
                    <input class="image_name" type="file" name="commercial_record"  >
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Bank Name')}}</label>
                    <input type='text' name="bank_name" class="form-control" value="{{ old('bank_name') }}" />
                </div>

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">{{__('Bank Account')}}</label>
                    <input type='text' name="bank_account" class="form-control" value="{{ old('bank_account') }}" />
                </div>
</div>
                <div class="text-right mb-5">
                    <input type="submit" class="btn btn-success" value="{{__('Add')}}">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>


    <script>

    $('#vendor_data').hide();
   $('#role').change(function(){
   var role = $('#role').val();
    
        if(role == '3'){
            $('#vendor_data').show(); // for vendor
          
        }else{
            $('#vendor_data').hide(); // for vendor
           
        }
   });


    </script>

@stop
