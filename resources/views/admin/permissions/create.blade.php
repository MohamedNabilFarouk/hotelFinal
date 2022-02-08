@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('permissions')}}
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">{{__('permissions')}}</small>
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
            <form method="post" action="{{ route('permissions.store') }}" class="row" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                    <div class="form-group mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">{{__('name')}}</label>
                        <input type='text' name="name" class="form-control" value="{{ old('name') }}" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">{{__('display name')}}</label>

                        <input type='text' name="display_name" class="form-control" value="{{ old('display_name') }}" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">{{__('description')}}</label>

                        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <h2 class="text-center">role permisions</h2>
                    <div class="bar">
                        @php
                            $models = [
                            'hotels', 'rooms', 'tours', 'booking', 'users', 'vendors',
                             'customers', 'currency', 'attribute', 'permissions'
                             ];
                            $maps = ['read', 'create', 'update', 'delete'];
                        @endphp

                        @foreach($models as $index=>$model)
                            <button
                                type="button"
                                class="btn tablink btn-sm {{$index == 0 ? 'btn-primary' : ''}}"
                                onclick="openTab(event,'{{$model}}')">{{$model}}</button>
                        @endforeach
                    </div>
                    <hr>

                    <div class="form-group mb-10">
                        @foreach($models as $index=>$model)
                            <div id="{{$model}}" class="tab" style="display:{{$index != 0 ? 'none' : ''}}">
                                @foreach($maps as $map)
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="permisions[]" type="checkbox" value="{{$map.'-'.$model}}">
                                            <span class="form-check-sign">
                                                    <span class="check">{{$map}}</span>
                                            </span>
                                        </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <script>
                        function openTab(evt,openTab) {
                            let i;
                            const x = document.getElementsByClassName("tab");
                            const tablinks = document.getElementsByClassName("tablink");
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = "none";
                                tablinks[i].className = tablinks[i].className.replace("btn-primary", "");
                            }
                            document.getElementById(openTab).style.display = "block";
                            evt.currentTarget.className += " btn-primary";
                        }
                    </script>
                </div>

                <div class="col-md-12">
                    <div class="text-right mb-5">
                        <input type="submit" name="add" class="btn btn-success" value="{{__('Add')}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop
