@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('site.Site Settings')
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

    @include('admin.includes.messages')

    <div class="card mb-5 mb-xl-8">

        <form class="col-12" action="{{ route('settings.site.update') }}" method="post"
              enctype="multipart/form-data">

        {{ csrf_field() }}
        {{ method_field('put') }}

            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">@lang('site.Site Settings')</span>
                </h3>

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">

                        <table class="table table-hover align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-325px text-center">@lang('site.Site Settings')</th>
                                <th class="ps-4 min-w-325px">@lang('site.value')</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="border">

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.phone')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> phone }}</a>
                                            <input type="text" name="phone" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.phone')"/>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.hot_line')</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> hot_line }}</a>
                                            <input type="text" name="hot_line" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.hot_line')"/>
                                        </div>
                                    </div>
                                </td>

                            </tr>




                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.Email')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> email }}</a>
                                            <input type="text" name="email" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.Email')"/>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.logo')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <input type="file" name="logo" class="form-control input-sm image" accept="jpg, png, jpeg, svg">

                                            <img src="{{ $site_settings -> logo }}" width="100px"
                                                 class="img-thumbnail image-preview mt-1" alt="">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.favicon')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <input type="file" name="favicon" class="form-control input-sm favicon" accept="jpg, png, jpeg, svg">

                                            <img src="{{ $site_settings -> favicon_path }}" width="100px"
                                                 class="img-thumbnail favicon-preview mt-1" alt="">
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                            <!--end::Table body-->
                        </table>

                        <table class="table table-hover align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-325px text-center">@lang('site.Maps')</th>
                            <th class="ps-4 min-w-325px">@lang('site.longitude')</th>
                            <th class="ps-4 min-w-325px">@lang('site.latitude')</th>
                        </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="border">

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column m-auto">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.maps')</a>
                                    </div>
                                </div>
                            </td>


                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> longitude }}</a>
                                        <input type="text" name="longitude" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.longitude')"/>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> latitude }}</a>
                                        <input type="text" name="latitude" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.latitude')"/>
                                    </div>
                                </div>
                            </td>

                        </tr>


                        </tbody>
                        <!--end::Table body-->
                    </table>


                    <!--begin::Table-->
                        <table class="table table-hover align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="ps-4 min-w-325px text-center">@lang('site.Site Settings')</th>
                                <th class="ps-4 min-w-325px">@lang('site.English')</th>
                                <th class="ps-4 min-w-325px">@lang('site.Arabic')</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="border">

                            <tr>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6 text-center">@lang('site.Title')</a>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> title_en }}</a>
                                            <input type="text" name="title_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.Title') @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> title_ar }}</a>
                                            <input type="text" name="title_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.Title') @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">@lang('site.about')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            {{-- <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> about_en }}</a>
                                            <input type="text" name="about_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.about') @lang('site.in English')"/>
                                             --}}
                                             <textarea  name="about_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.about') @lang('site.in English')" >{{ $site_settings -> about_en }}</textarea>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            {{-- <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> about_ar }}</a> --}}
                                            {{-- <input type="text" name="about_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.about') @lang('site.in Arabic')"/> --}}
                                            <textarea  name="about_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.about') @lang('site.in Arabic')" >{{ $site_settings -> about_ar }}</textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6"> @lang('site.address') </a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> address_en }}</a>
                                            <input type="text" name="address_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.address') @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> address_ar }}</a>
                                            <input type="text" name="address_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.address') @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">@lang('site.City')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> city_en }}</a>
                                            <input type="text" name="city_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.City') @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> city_ar }}</a>
                                            <input type="text" name="city_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.City') @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">@lang('site.Country')</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> country_en }}</a>
                                            <input type="text" name="country_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.Country') @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> country_ar }}</a>
                                            <input type="text" name="country_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') @lang('site.Country') @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Meta Title</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> meta_title_en }}</a>
                                            <input type="text" name="meta_title_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') Meta Title @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> meta_title_ar }}</a>
                                            <input type="text" name="meta_title_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') Meta Title @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Meta Description</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> meta_description_en }}</a>
                                            <input type="text" name="meta_description_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') Meta Title @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> meta_description_ar }}</a>
                                            <input type="text" name="meta_description_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') Meta Description @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column m-auto">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">Meta Keywords</a>
                                        </div>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> meta_keyword_en }}</a>
                                            <input type="text" name="meta_keyword_en" class="form-control form-control-solid" placeholder="@lang('site.Enter New') Keywords @lang('site.in English')"/>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $site_settings -> meta_keyword_ar }}</a>
                                            <input type="text" name="meta_keyword_ar" class="form-control form-control-solid" placeholder="@lang('site.Enter New') Meta Keywords @lang('site.in Arabic')"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            </tbody>
                            <!--end::Table body-->
                        </table>


                        <!--end::Table-->
                </div>
                <!--end::Table container-->

                <button type="submit" href="{{route('settings.site.update')}}" class="m-5 btn btn-lg btn-primary float-end">
                    @lang('site.Update') @lang('site.Site Settings') <i class="fa fa-edit"></i>
                </button>

            </div>
            <!--begin::Body-->
        </form>
    </div>
    <!--end::Tables Widget 11-->
@endsection



<!--begin::Tables Widget 11-->
