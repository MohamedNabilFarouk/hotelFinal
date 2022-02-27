<template>
    <div>
        <section class="section-style4 mb-1">
            <div class="container page-builder-ltr">
                <div class="row row-style row_a1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c">
                        <div class="module so-deals-1tr home1_deals so-deals">
                            <div class="head-title clearfix">
                                <div class="block-title pull-left">
                                    <h3 class="text-capitalize"><span>{{$t('popular') + ' ' + $t('spaces')}}</span></h3>
                                </div>
                            </div>

                            <div class="modcontent">
                                <div class="">
                                    <VueSlickCarousel ref="popularToursSlider" v-if="spaces && spaces.length > 0" v-bind="settings">
                                        <div class="item" v-for="space in spaces" :key="space.id">
                                            <div class="item-inner">
                                                <div class="transition product-layout">
                                                    <div class="product-item-container ">
                                                        <div class="item-block so-quickview">
                                                            <div class="image">
                                                                <router-link :to="'/hotel/'+space.hotel_id">
                                                                    <vue-load-image>
                                                                        <img slot="image" :src="space.image" />
                                                                        <img slot="preloader" src="../../../assets/loading.gif">
                                                                        <img slot="error" src="../../../assets/no_image.png">
                                                                    </vue-load-image>
                                                                </router-link>
                                                            </div>
                                                            <div class="item-content clearfix">
                                                                <h3>{{space.title_api}}</h3>
                                                                <div class="reviews-content">
                                                                    <starRating
                                                                        :star-size="15"
                                                                        :rating="space.star_rate ? parseInt(space.star_rate) : 0"
                                                                        :show-rating="false"
                                                                        :read-only="true"></starRating>
                                                                </div>
                                                                <ul>
                                                                    <li :title="$t('size')"><i class="fa fa-arrows-alt"></i> {{space.size}} {{$t('m')}}<sup>2</sup></li>
                                                                    <li :title="$t('bed')"><i class="fa fa-bed"></i> {{space.bed}}</li>
                                                                    <li :title="$t('adults')"><i class="fa fa-user"></i> {{space.adult}}</li>
                                                                    <li :title="$t('child')"><i class="fa fa-child"></i> {{space.child}}</li>
                                                                    <li :title="$t('bathroom')"><i class="fa fa-bath"></i> {{space.bathroom}}</li>
                                                                </ul>

                                                                <div class="d-flex justify-content-between">
                                                                    <div class="price text-capitalize">
                                                                        <label>{{space.main_price}}</label><span>{{$t('night')}}</span>
                                                                    </div>
                                                                    <router-link :to="'/hotel/'+space.hotel_id" class="book-now text-capitalize btn-quickview quickview quickview_handler">{{$t('view now')}}</router-link>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </VueSlickCarousel>
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
    name: 'Spaces',
    props: {
        spaces: {type: Array, default:  () => ([])},
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
                        }
                    }
                ]
            }
        }
    },
    methods: {
        showNext() {
            this.$refs.popularHotelsSlider.next()
        },
        showPrev() {
            this.$refs.popularHotelsSlider.prev()
        },
    }
}
</script>
