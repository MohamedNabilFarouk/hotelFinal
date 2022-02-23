@extends('admin.layouts.app')


@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Bookings')}}
            <!--begin::Separator-->
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <!--end::Separator-->
            <!--begin::Description-->
            <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
            <!--end::Description--></h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->

    </div>
    <!--end::Container-->
</div>
@endsection

@section('content')

<div class="card rounded mb-5 mb-xl-8 shadow-lg">
     <!--begin::Header-->
    <div class="card-header rounded border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">{{__('Booking details')}}</span>
        </h3>

    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive rounded">
            <!--begin::Table-->
            <table class="table table-hover align-middle gs-0 gy-4">
                <!--begin::Table head-->
                <thead>
                    <tr class="text-center border-3 fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-325px rounded-start">{{__('room')}}</th>
                        <th class="min-w-125px">{{__('number')}}</th>
                        <th class="min-w-125px">{{__('from')}}</th>
                        <th class="min-w-125px">{{__('to')}}</th>
                        <th class="min-w-125px">{{__("Created At")}}</th>
                        {{-- <th class="min-w-200px rounded-end">{{__("Action")}}</th> --}}
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>

                @foreach($details as $c)

                    <tr class="text-center border-3 m-auto">
                         <td class="px-3">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-5">
                                    <img src="{{$c->room->image ? $c->room->image : ''}}" class="" alt="" />
                                </div>
                                <div class="d-flex flex-column">
                                    {{-- <a href="{{ route('resturants.edit', $c->id) }}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{$c->name_en}}</a> --}}
                                    <span class="text-muted fw-bold text-muted d-block fs-7">

                                        {{ $c->room->title}}

                                    </span>
                                </div>
                            </div>
                        </td>

                        <td class="px-3">
                            {{$c->number}}
                        </td>
                        <td class="px-3">
                            {{$c->from}}
                        </td>
                        <td class="px-3">
                            {{$c->to}}
                        </td>

                        <td class="px-3">{{$c->updated_at}}</td>


                    </tr>
                    @endforeach

                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->

@endsection



	<!--begin::Tables Widget 11-->
