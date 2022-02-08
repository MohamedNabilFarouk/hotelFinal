<template>
    <div>
        <section class="section-style4 mb-1">
        <div class="container page-builder-ltr">
            <div class="row row-style row_a1">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c">
                    <div class="module so-deals-1tr home1_deals so-deals">
                        <div class="head-title clearfix">
                            <div class="block-title pull-left">
                                <h3><span>popular tours</span></h3>
                            </div>
                            <router-link to="tours"
                               class="pull-right">
                                view all
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </router-link>
                        </div>

                        <div class="modcontent">
                            <div class="popular-tours-slider">
                                <VueSlickCarousel ref="popularToursSlider" v-if="tours.length > 0" v-bind="settings">
                                    <!--  items  -->
                                    <div class="item" v-for="tour in tours">
                                        <div class="item-inner">
                                            <div class="transition product-layout">
                                                <div class="product-item-container ">
                                                    <div class="item-block so-quickview">
                                                        <div class="image">
                                                            <a href="tour-detail.html" target="_self">
                                                                <img src="https://hoteelsegypt.com/uploads/0000/871/2022/02/07/124013623.jpg" alt="Bougainvilleas on Lombard Street,  San Francisco, Tokyo" class="img-responsive">
                                                            </a>
                                                            <span class="label-hot"><i class="fa fa-fire" aria-hidden="true"></i>Hot tour</span>
                                                        </div>
                                                        <div class="item-content clearfix">
                                                            <h3><a href="tour-detail.html">2 Day 1 Night Trip to Santorini, Greece</a></h3>
                                                            <div class="reviews-content">
                                                                <div class="star">
                                                                    <span style="width: 60px"></span>
                                                                </div>
                                                                <a href="#" class="review-link" rel="nofollow">(20 reviews)</a>
                                                            </div>
                                                            <ul>
                                                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> New Zealand</li>
                                                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> 2 Day</li>
                                                                <li><i class="fa fa-user-circle" aria-hidden="true"></i> 4 persons</li>
                                                            </ul>
                                                            <div class="item-bot clearfix">
                                                                <div class="price pull-left">
                                                                    from <label>$230</label><span>person</span>
                                                                </div>
                                                                <a href="booking-step.html" class="book-now btn-quickview quickview quickview_handler pull-right" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">Book now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </VueSlickCarousel>
                                <div class="owl2-controls">
                                    <div class="owl2-nav">
                                        <div class="owl2-prev" style="display: none;">
                                            <i class="fa fa-angle-left"></i>
                                        </div>
                                        <div class="owl2-next" style="display: none;">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="owl2-dots">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</template>
<script>
import VueSlickCarousel from 'vue-slick-carousel';
import starRating from "vue-star-rating";

export default {
    name: 'Tours',
    props: {
        tours: {type: Array, default:  () => ([])},
    },
    components: {
        VueSlickCarousel,
        starRating
    },
    data() {
        return {
            settings:{
                arrows: true,
                dots: false,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                cssEase: "linear",
                pauseOnFocus: true,
                pauseOnHover: true,
                responsive: [
                    {
                        "breakpoint": 1024,
                        "settings": {
                            "slidesToShow": 3
                        }
                    },
                    {
                        "breakpoint": 768,
                        "settings": {
                            "slidesToShow": 2
                        }
                    },
                    {
                        "breakpoint": 480,
                        "settings": {
                            "slidesToShow": 1,
                            arrows: false,
                        }
                    }
                ]
            }
        }
    },
    methods: {
        showNext() {
            this.$refs.popularToursSlider.next()
        },
        showPrev() {
            this.$refs.popularToursSlider.prev()
        },
    }
}
</script>
