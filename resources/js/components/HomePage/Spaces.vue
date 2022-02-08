<template>
    <div>
        <section class="section-style2">
        <div class="container page-builder-ltr">
            <div class="row row-style row_a1">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c">
                    <div class="module so-deals-1tr home1_deals so-deals">
                        <div class="head-title clearfix">
                            <div class="block-title pull-left">
                                <h3><span>popular Spaces</span></h3>
                            </div>
                            <router-link to="hotels"
                               class="pull-right">
                                view all
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </router-link>
                        </div>

                        <div class="modcontent">
                            <div class="popular-hotels-slider">
                                <VueSlickCarousel ref="popularHotelsSlider" v-if="spaces.length > 0" v-bind="settings">
                                    <!--  items  -->
                                    <div class="item" v-for="space in spaces">
                                        <div class="transition product-layout">
                                            <div class="product-item-container ">
                                                <div class="item-block so-quickview">
                                                    <div class="image">
                                                        <img :src="space.image"
                                                             :alt="space.title_api"
                                                             class="img-responsive">
                                                    </div>
                                                    <div class="item-content">
                                                        <h3>{{space.title_api}}</h3>
                                                        <div class="reviews-content mb-3">
                                                            <starRating
                                                                :star-size="15"
                                                                :rating="space.star_rate ? parseInt(space.star_rate) : 0"
                                                                :show-rating="false"
                                                                :read-only="true"></starRating>
                                                        </div>
                                                        <ul>
                                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{space.address_api}}</li>
                                                            <li><i class="fa fa-clock-o" aria-hidden="true"></i> 2 Day</li>
                                                            <li><i class="fa fa-user-circle" aria-hidden="true"></i> 4 Pers</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </VueSlickCarousel>

                                <div class="owl2-controls">
                                    <div class="owl2-nav">
                                        <div @click="showPrev" class="owl2-prev" style="display: none;">
                                            <i class="fa fa-angle-left"></i>
                                        </div>
                                        <div @click="showNext" class="owl2-next" style="display: none;">
                                            <i class="fa fa-angle-right"></i>
                                        </div>
                                    </div>
                                    <div style="display: none;" class="owl2-dots"></div>
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
                arrows: false,
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
