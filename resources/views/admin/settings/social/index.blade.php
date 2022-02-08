@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('site.Social Settings')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>
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

    <div class="card rounded mb-5 mb-xl-8 shadow-lg">

        <form class="col-12" action="{{ route('settings.social.update') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
            {{ method_field('put') }}

            <!--begin::Header-->
            <div class="card-header rounded border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">@lang('site.Social Settings')</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive rounded">

                    <table class="table table-hover align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-center border-3 fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-325px text-center">@lang('site.Website Name')</th>
                                <th class="ps-4 min-w-325px">@lang('site.Link')</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="border">
                            @foreach ($social_settings as $index => $social)

                                <tr class="text-center border-3 m-auto">
                                     <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column m-auto">
                                                <a href="#"
                                                    class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.'
                                                    . $social -> key)</a>
                                            </div>
                                        </div>
                                    </td>


                                     <td class="px-3">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column">
                                                <a href="{{ $social->value }}" target="_blank"
                                                    class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $social->value }}</a>
                                                <input type="text" name="{{ $social->key }}" class="form-control"
                                                    placeholder="https://" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                        <!--end::Table body-->
                    </table>

                </div>

                <button type="submit" href="{{ route('settings.social.update') }}"
                    class="m-5 btn btn-lg btn-primary float-end">
                    @lang('site.Update') @lang('site.Social Settings') <i class="fa fa-edit"></i>
                </button>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </form>
    </div>
    <!--end::Tables Widget 11-->
@endsection



<!--begin::Tables Widget 11-->
