<template>
    <div>
        <section class="section-style4 mb-1">
            <div class="container page-builder-ltr">
                <div class="row row-style row_a1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c">
                        <div class="module so-deals-1tr home1_deals so-deals">
                            <div class="head-title clearfix">
                                <div class="block-title pull-left">
                                    <h3 class="text-capitalize"><span>{{$t('popular rooms')}}</span></h3>
                                </div>
<!--                                <router-link to="tours"-->
<!--                                             class="pull-right">-->
<!--                                    view all-->
<!--                                    <i class="fa fa-angle-right" aria-hidden="true"></i>-->
<!--                                </router-link>-->
                            </div>

                            <div class="modcontent">
                                <div class="d-flex justify-space-between flex-column">
                                    <VueSlickCarousel ref="popularToursSlider" v-if="rooms && rooms.length > 0" v-bind="settings">
                                        <!--  items  -->
                                        <div class="item" v-for="room in rooms.slice(0, 5)">
                                            <div class="item-inner">
                                                <div class="transition product-layout">
                                                    <div class="product-item-container ">
                                                        <div class="item-block so-quickview">
                                                            <div class="image">
                                                                <router-link :to="'/hotel/'+room.hotel_id">
                                                                    <img :src="room.image" :alt="room.title_api" class="img-responsive">
                                                                </router-link>
                                                            </div>
                                                            <div class="item-content clearfix">
                                                                <h3>{{room.title_api}}</h3>
                                                                <div class="reviews-content">
                                                                    <starRating
                                                                        :star-size="15"
                                                                        :rating="room.star_rate ? parseInt(room.star_rate) : 0"
                                                                        :show-rating="false"
                                                                        :read-only="true"></starRating>
                                                                </div>
                                                                <ul>
                                                                    <li :title="$t('size')"><i class="fa fa-arrows-alt"></i> {{room.size}} {{$t('m')}}<sup>2</sup></li>
                                                                    <li :title="$t('bed')"><i class="fa fa-bed"></i> {{room.bed}}</li>
                                                                    <li :title="$t('adults')"><i class="fa fa-user"></i> {{room.adult}}</li>
                                                                    <li :title="$t('child')"><i class="fa fa-child"></i> {{room.child}}</li>
                                                                    <li :title="$t('bathroom')"><i class="fa fa-bath"></i> {{room.bathroom}}</li>
                                                                </ul>

<!--                                                               <div>-->
<!--                                                                    {{room.content_api}}-->
<!--                                                               </div>-->
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="price text-capitalize">
                                                                        <label>{{room.main_price}}</label><span>{{$t('night')}}</span>
                                                                    </div>
                                                                    <router-link :to="'/hotel/'+room.hotel_id" class="book-now text-capitalize btn-quickview quickview quickview_handler">{{$t('book now')}}</router-link>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </VueSlickCarousel>

                                    <VueSlickCarousel ref="popularToursSlider" v-if="rooms && rooms.length > 0" v-bind="settings">
                                        <!--  items  -->
                                        <div class="item" v-for="room in rooms.slice(0, 5)">
                                            <div class="item-inner">
                                                <div class="transition product-layout">
                                                    <div class="product-item-container ">
                                                        <div class="item-block so-quickview">
                                                            <div class="image">
                                                                <router-link :to="'/hotel/'+room.hotel_id">
                                                                    <img :src="room.image" :alt="room.title_api" class="img-responsive">
                                                                </router-link>
                                                            </div>
                                                            <div class="item-content clearfix">
                                                                <h3>{{room.title_api}}</h3>
                                                                <div class="reviews-content">
                                                                    <starRating
                                                                        :star-size="15"
                                                                        :rating="room.star_rate ? parseInt(room.star_rate) : 0"
                                                                        :show-rating="false"
                                                                        :read-only="true"></starRating>
                                                                </div>
                                                                <ul>
                                                                    <li :title="$t('size')"><i class="fa fa-arrows-alt"></i> {{room.size}} {{$t('m')}}<sup>2</sup></li>
                                                                    <li :title="$t('bed')"><i class="fa fa-bed"></i> {{room.bed}}</li>
                                                                    <li :title="$t('adults')"><i class="fa fa-user"></i> {{room.adult}}</li>
                                                                    <li :title="$t('child')"><i class="fa fa-child"></i> {{room.child}}</li>
                                                                    <li :title="$t('bathroom')"><i class="fa fa-bath"></i> {{room.bathroom}}</li>
                                                                </ul>

                                                                <!--                                                               <div>-->
                                                                <!--                                                                    {{room.content_api}}-->
                                                                <!--                                                               </div>-->
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="price text-capitalize">
                                                                        <label>{{room.main_price}}</label><span>{{$t('night')}}</span>
                                                                    </div>
                                                                    <router-link :to="'/hotel/'+room.hotel_id" class="book-now text-capitalize btn-quickview quickview quickview_handler">{{$t('book now')}}</router-link>
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
    name: 'Rooms',
    props: {
        rooms: {type: Array, default:  () => ([])},
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
