<template>
    <div class="container pt-2 sliders-main">
        <div class="row">

            <div class="col-lg-6 col-12">
                <div class="mb-4 tours-slider">
                    <VueSlickCarousel v-if="tours.length > 0" :slidesToShow="1" :slidesToScroll="1" :speed="500" :infinite="true" :arrows="false" :autoplay="true" :autoplaySpeed="5000" :dots="false">
                        <!--  item  -->
                        <div v-for="tour in tours" :key="tour.id">
                            <router-link :to="'tour/'+tour.id">
                                <div class="slide-img">
                                    <vue-load-image>
                                        <img slot="image" :src="tour.image" />
                                        <img slot="preloader" src="../../../assets/loading.gif">
                                        <img slot="error" src="../../../assets/no_image.png">
                                    </vue-load-image>
                                </div>
                                <div class=slider-content>
                                    <h4 class="title text-capitalize">{{tour.title_api}}</h4>
                                    <div class="location text-capitalize">
                                        <i class="fa fa-map-marker"></i>
                                        {{tour.address_api}}
                                    </div>
                                    <starRating
                                        :star-size="14"
                                        :rating="3.5"
                                        :show-rating="false"
                                        :read-only="true">
                                    </starRating>
                                    <span class="price text-capitalize">
                                        {{tour.price_api.price}}/{{$t('person')}}
                                        <span class="mx-1">|</span>
                                        {{tour.price_api.ch_price}}/{{$t('child')}}
                                    </span>
                                </div>
                            </router-link>
                        </div>
                    </VueSlickCarousel>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="hotels-slider">
                    <VueSlickCarousel v-if="hotels.length > 0" :slidesToShow="1" :slidesToScroll="1" :speed="1000" :infinite="true" :arrows="false" :autoplay="true" :autoplaySpeed="5000" :dots="false">
                        <!--  item  -->
                        <div v-for="hotel in hotels" :key="hotel.id">
                            <router-link :to="'/hotel/'+hotel.id" >
                                <div class="slide-img">
                                    <vue-load-image>
                                        <img slot="image" :src="hotel.image" />
                                        <img slot="preloader" src="../../../assets/loading.gif">
                                        <img slot="error" src="../../../assets/no_image.png">
                                    </vue-load-image>
                                </div>
                                <div class=slider-content>
                                    <h4 class="title">{{hotel.title_api}}</h4>
                                    <div class="location">
                                        <i class="fa fa-map-marker"></i>
                                        {{hotel.address_api}}
                                    </div>
                                    <starRating
                                        :star-size="14"
                                        :rating="3.5"
                                        :show-rating="false"
                                        :read-only="true">
                                    </starRating>
                                    <span class="price">
                                        {{ $t('from') }}: {{hotel.min_price}}/{{$t('night')}}
                                    </span>
                                </div>
                            </router-link>
                        </div>
                    </VueSlickCarousel>
                </div>
            </div>

            <div class="col-lg-3 d-flex justify-space-between flex-column col-6">
                <div style="margin-bottom: 20px" class="cities-slider">
                    <VueSlickCarousel v-if="cities.length > 0" :slidesToShow="1" :slidesToScroll="1" :speed="1200" :infinite="true" :arrows="false" :autoplay="true" :autoplaySpeed="5000" :dots="false">
                        <!--  item  -->
                        <div v-for="city in cities.slice(0, 5)" :key="city.id">
                            <div class="slide-img">
                                <vue-load-image>
                                    <img slot="image" :src="city.image" />
                                    <img slot="preloader" src="../../../assets/loading.gif">
                                    <img slot="error" src="../../../assets/no_image.png">
                                </vue-load-image>
                            </div>
                            <div class=slider-content>
                                <h4 class="title">{{$t(city.name_en.toLowerCase().trim())}}</h4>
                            </div>
                        </div>
                    </VueSlickCarousel>
                </div>
                <div class="cities-slider">
                    <VueSlickCarousel v-if="cities.length > 0" :slidesToShow="1" :slidesToScroll="1" :speed="1500" :infinite="true" :arrows="false" :autoplay="true" :autoplaySpeed="5000" :dots="false">
                        <div v-for="city in cities.slice(5, 10)" :key="city.id">
                            <div class="slide-img">
                                <vue-load-image>
                                    <img slot="image" :src="city.image" />
                                    <img slot="preloader" src="../../../assets/loading.gif">
                                    <img slot="error" src="../../../assets/no_image.png">
                                </vue-load-image>
                            </div>
                            <div class=slider-content>
                                <h4 class="title">{{$t(city.name_en.toLowerCase().trim())}}</h4>
                            </div>
                        </div>
                    </VueSlickCarousel>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueSlickCarousel from 'vue-slick-carousel';
import 'vue-slick-carousel/dist/vue-slick-carousel.css';
import starRating from "vue-star-rating";

export default {
    name: 'Slider',
    components: {
        VueSlickCarousel,
        starRating
    },
    props: {
        tours: {type: Array, default: () => ([])},
        hotels: {type: Array, default:  () => ([])},
        cities: {type: Array, default:  () => ([])},
    },
    data() {
        return {

        }
    }
}
</script>
