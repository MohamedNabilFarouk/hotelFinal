@extends('admin.layouts.app')
@section('toolbar')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="d-flex align-items-center me-3">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{__('Dashboard')}}
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
<!--begin::Section-->
<div class="mb-17">
											<!--begin::Content-->
											<div class="d-flex flex-stack mb-5">
												<!--begin::Title-->
												<h3 class="text-black">Products</h3>
												<!--end::Title-->
												<!--begin::Link-->
												<!-- <a href="#" class="fs-6 fw-bold link-primary">View All Offers</a> -->
												<!--end::Link-->
											</div>
											<!--end::Content-->
											<!--begin::Separator-->
											<div class="separator separator-dashed mb-9"></div>
											<!--end::Separator-->
											<!--begin::Row-->
											<div class="row g-10">
                                                @foreach($products as $p)
												<!--begin::Col-->
												<div class="col-md-3">
													<!--begin::Hot sales post-->
													<div class="card-xl-stretch me-md-6">
														<!--begin::Overlay-->
														<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-23.jpg">
															<!--begin::Image-->
															<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{$p->image}}')"></div>
															<!--end::Image-->
															<!--begin::Action-->
															<div class="overlay-layer card-rounded bg-dark bg-opacity-10">
																<!--begin::Svg Icon | path: icons/duotone/Interface/Eye.svg-->
																<span class="svg-icon svg-icon-2hx svg-icon-dark">
																	
																</span>
																<!--end::Svg Icon-->
															</div>
															<!--end::Action-->
														</a>
														<!--end::Overlay-->
														<!--begin::Body-->
														<div class="mt-5">
															<!--begin::Title-->
															<a href="#" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">{{$p->name}}</a>
															<!--end::Title-->
															<!--begin::Text-->
															<div class="fw-bold fs-5 text-gray-600 text-dark mt-3">{{$p->des}}</div>
															<!--end::Text-->
															<!--begin::Text-->
															<div class="fs-6 fw-bolder mt-5 d-flex flex-stack">
																<!--begin::Label-->
																<span class="badge badge-white border-dashed fs-2 fw-bolder text-dark p-2">
																<span class="fs-6 fw-bold text-gray-400">LE  </span>{{$p->price}}</span>
																<!--end::Label-->
																<!--begin::Action-->
                                                                <form action='{{route("payment")}}' method='post'>
                                                                    @csrf
                                                                    <input  type='hidden' name='product_id' value='{{$p->id}}'>
																<!-- <button typ='submit' class="btn btn-primary">Purchase</button> -->
																<a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal" data-bs-target="#kt_modal_new_address">Purchase</a>
                                                                <!-- </form> -->
																<!--end::Action-->
															</div>
															<!--end::Text-->
														</div>
														<!--end::Body-->
													</div>
													<!--end::Hot sales post-->
												</div>
												<!--end::Col-->
                                                @endforeach
                                                {{--
												<!--begin::Col-->
												<div class="col-md-4">
													<!--begin::Hot sales post-->
													<div class="card-xl-stretch mx-md-3">
														<!--begin::Overlay-->
														<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x600/img-14.jpg">
															<!--begin::Image-->
															<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{$p->image}}')"></div>
															<!--end::Image-->
															<!--begin::Action-->
															<div class="overlay-layer card-rounded bg-dark bg-opacity-10">
																<!--begin::Svg Icon | path: icons/duotone/Interface/Eye.svg-->
																<span class="svg-icon svg-icon-2hx svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.25" d="M22.3422 9.506C23.5181 10.9837 23.5181 13.0163 22.3422 14.494C20.4739 16.8417 17.0265 20 11.9999 20C6.97341 20 3.526 16.8417 1.65772 14.494C0.481768 13.0163 0.481768 10.9837 1.65772 9.506C3.526 7.15826 6.97341 4 11.9999 4C17.0265 4 20.4739 7.15826 22.3422 9.506Z" fill="#12131A" />
																		<path fill-rule="evenodd" clip-rule="evenodd" d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 11.9716 10.0006 11.9434 10.0018 11.9153C10.1577 11.9701 10.3253 12 10.5 12C11.3284 12 12 11.3284 12 10.5C12 10.3253 11.9701 10.1577 11.9153 10.0018C11.9434 10.0006 11.9716 10 12 10C13.1046 10 14 10.8954 14 12ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" fill="#12131A" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</div>
															<!--end::Action-->
														</a>
														<!--end::Overlay-->
														<!--begin::Body-->
														<div class="mt-5">
															<!--begin::Title-->
															<a href="#" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">25 Products Mega Bundle with 50% off discount amazing</a>
															<!--end::Title-->
															<!--begin::Text-->
															<div class="fw-bold fs-5 text-gray-600 text-dark mt-3">We’ve been focused on making a the from also not been eye</div>
															<!--end::Text-->
															<!--begin::Text-->
															<div class="fs-6 fw-bolder mt-5 d-flex flex-stack">
																<!--begin::Label-->
																<span class="badge badge-white border-dashed fs-2 fw-bolder text-dark p-2">
																<span class="fs-6 fw-bold text-gray-400">$</span>27</span>
																<!--end::Label-->
																<!--begin::Action-->
																<a href="#" class="btn btn-primary">Purchase</a>
																<!--end::Action-->
															</div>
															<!--end::Text-->
														</div>
														<!--end::Body-->
													</div>
													<!--end::Hot sales post-->
												</div>
												<!--end::Col-->
												<!--begin::Col-->
												<div class="col-md-4">
													<!--begin::Hot sales post-->
													<div class="card-xl-stretch ms-md-6">
														<!--begin::Overlay-->
														<a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-71.jpg">
															<!--begin::Image-->
															<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x400/img-71.jpg')"></div>
															<!--end::Image-->
															<!--begin::Action-->
															<div class="overlay-layer card-rounded bg-dark bg-opacity-10">
																<!--begin::Svg Icon | path: icons/duotone/Interface/Eye.svg-->
																<span class="svg-icon svg-icon-2hx svg-icon-dark">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.25" d="M22.3422 9.506C23.5181 10.9837 23.5181 13.0163 22.3422 14.494C20.4739 16.8417 17.0265 20 11.9999 20C6.97341 20 3.526 16.8417 1.65772 14.494C0.481768 13.0163 0.481768 10.9837 1.65772 9.506C3.526 7.15826 6.97341 4 11.9999 4C17.0265 4 20.4739 7.15826 22.3422 9.506Z" fill="#12131A" />
																		<path fill-rule="evenodd" clip-rule="evenodd" d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 11.9716 10.0006 11.9434 10.0018 11.9153C10.1577 11.9701 10.3253 12 10.5 12C11.3284 12 12 11.3284 12 10.5C12 10.3253 11.9701 10.1577 11.9153 10.0018C11.9434 10.0006 11.9716 10 12 10C13.1046 10 14 10.8954 14 12ZM16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" fill="#12131A" />
																	</svg>
																</span>
																<!--end::Svg Icon-->
															</div>
															<!--end::Action-->
														</a>
														<!--end::Overlay-->
														<!--begin::Body-->
														<div class="mt-5">
															<!--begin::Title-->
															<a href="#" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">25 Products Mega Bundle with 50% off discount amazing</a>
															<!--end::Title-->
															<!--begin::Text-->
															<div class="fw-bold fs-5 text-gray-600 text-dark mt-3">We’ve been focused on making a the from also not been eye</div>
															<!--end::Text-->
															<!--begin::Text-->
															<div class="fs-6 fw-bolder mt-5 d-flex flex-stack">
																<!--begin::Label-->
																<span class="badge badge-white border-dashed fs-2 fw-bolder text-dark p-2">
																<span class="fs-6 fw-bold text-gray-400">$</span>25</span>
																<!--end::Label-->
																<!--begin::Action-->
																<a href="#" class="btn btn-primary">Purchase</a>
																<!--end::Action-->
															</div>
															<!--end::Text-->
														</div>
														<!--end::Body-->
													</div>
													<!--end::Hot sales post-->
												</div>
												<!--end::Col-->
                                                --}}
											</div>
											<!--end::Row-->
										</div>
										<!--end::Section-->
                                        {!! $products->render() !!}


<!--begin::Modal - New Address-->
<div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
									<!--begin::Modal dialog-->
									<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
											<!--begin::Form-->
											<!-- <form class="form" action="#" id="kt_modal_new_address_form"> -->
											

											<!--begin::Modal header-->
												<div class="modal-header" id="kt_modal_new_address_header">
													<!--begin::Modal title-->
													<h2>Order information</h2>
													<!--end::Modal title-->
													<!--begin::Close-->
													<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
														<!--begin::Svg Icon | path: icons/stockholm/Navigation/Close.svg-->
														<span class="svg-icon svg-icon-1">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
																	<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
																	<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
																</g>
															</svg>
														</span>
														<!--end::Svg Icon-->
													</div>
													<!--end::Close-->
												</div>
												<!--end::Modal header-->
												<!--begin::Modal body-->
												<div class="modal-body py-10 px-lg-17">
													<!--begin::Scroll-->
													<div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
														<!--begin::Notice-->
														<!--begin::Notice-->
														
														<!--end::Notice-->
														<!--end::Notice-->
														<!--begin::Input group-->
														<div class="row mb-10">
															<!--begin::Col-->
															<div class="col-md-12 fv-row">
																<!--begin::Label-->
																<label class="required fs-5 fw-bold mb-2">Name</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" class="form-control form-control-solid" placeholder="" name="name" required />
																<!--end::Input-->
															</div>
															<!--end::Col-->
															
														</div>
														<!--end::Input group-->
															<div class="row mb-10">
																<!--begin::Input group-->
																<div class="d-flex flex-column mb-5 fv-row">
																	<!--begin::Label-->
																	<label class="required fs-5 fw-bold mb-2">Address</label>
																	<!--end::Label-->
																	<!--begin::Input-->
																	<input class="form-control form-control-solid" placeholder="" name="address" required />
																	<!--end::Input-->
																</div>
																<!--end::Input group-->
															</div>
													
														<!--begin::Input group-->
														<div class="d-flex flex-column mb-5 fv-row">
															<!--begin::Label-->
															<label class="fs-5 fw-bold mb-2">Phone</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input class="form-control form-control-solid" placeholder="" name="phone" required />
															<!--end::Input-->
														</div>
														<!--end::Input group-->
													
													
													</div>
													<!--end::Scroll-->
												</div>
												<!--end::Modal body-->
												<!--begin::Modal footer-->
												<div class="modal-footer flex-center">
													<!--begin::Button-->
													<button type="reset" id="kt_modal_new_address_cancel" class="btn btn-white me-3">Discard</button>
													<!--end::Button-->
													<!--begin::Button-->
													<button type="submit" name='submit' class="btn btn-primary">
														<span class="indicator-label">Submit</span>
														<span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
													</button>
													<!--end::Button-->
												</div>
												<!--end::Modal footer-->
											</form>
											<!--end::Form-->
										</div>
									</div>
								</div>
								<!--end::Modal - New Address-->


@endsection