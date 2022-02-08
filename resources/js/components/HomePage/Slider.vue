<template>
    <div class="container sliders-main">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="mb-4 tours-slider">
                    <VueSlickCarousel
                        v-if="tours.length > 0"
                        :slidesToShow="1"
                        :slidesToScroll="1"
                        :swipeToSlide="true"
                        :speed="500"
                        :infinite="true"
                        :arrows="false"
                        :autoplay="true"
                        :autoplaySpeed="5000"
                        :pauseOnFocus="true"
                        :pauseOnHover="true"
                        :dots="false">
                        <!--  item  -->
                        <div v-for="tour in tours">
                            <div class="slide-img">
                                <img src="https://hoteelsegypt.com/uploads/0000/871/2022/02/07/124013623.jpg"  :alt="tour.title_api"/>
                            </div>
                            <div class=slider-content>
                                <h4 class="title">{{tour.title_api}}</h4>
                                <div class="location">
                                    <i class="fa fa-map-marker"></i>
                                    {{tour.address_api}}
                                </div>
                                <starRating
                                    :star-size="12"
                                    :rating="3.5"
                                    :show-rating="false"
                                    :read-only="true">
                                </starRating>
                            </div>
                        </div>

                    </VueSlickCarousel>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="hotels-slider">
                    <VueSlickCarousel
                        v-if="hotels.length > 0"
                        :slidesToShow="1"
                        :slidesToScroll="1"
                        :swipeToSlide="true"
                        :speed="1000"
                        :infinite="true"
                        :arrows="false"
                        :autoplay="true"
                        :autoplaySpeed="5000"
                        :pauseOnFocus="true"
                        :pauseOnHover="true"
                        :dots="false">
                        <!--  item  -->
                        <div v-for="hotel in hotels">
                            <div class="slide-img">
                                <img src="https://hoteelsegypt.com/uploads/0000/871/2022/02/07/124013623.jpg"  :alt="hotel.title_api"/>
                            </div>
                            <div class=slider-content>
                                <h4 class="title">{{hotel.title_api}}</h4>
                                <div class="location">
                                    <i class="fa fa-map-marker"></i>
                                    {{hotel.address_api}}
                                </div>
                                <starRating
                                    :star-size="12"
                                    :rating="3.5"
                                    :show-rating="false"
                                    :read-only="true">
                                </starRating>
                            </div>
                        </div>
                    </VueSlickCarousel>
                </div>
            </div>

            <div class="col-lg-3 d-flex justify-space-between flex-column col-6">
                <div style="margin-bottom: 16px" class="cities-slider">
                    <VueSlickCarousel
                        v-if="cities.length > 0"
                        :slidesToShow="1"
                        :slidesToScroll="1"
                        :swipeToSlide="true"
                        :speed="1500"
                        :infinite="true"
                        :arrows="false"
                        :autoplay="true"
                        :autoplaySpeed="5000"
                        :pauseOnFocus="true"
                        :pauseOnHover="true"
                        :dots="false">
                        <!--  item  -->
                        <div v-for="city in cities.slice(0, 5)">
                            <div class="slide-img">
                                <img src="https://hoteelsegypt.com/uploads/0000/871/2022/02/07/124013623.jpg"  :alt="city.name"/>
                            </div>
                            <div class=slider-content>
                                <h4 class="title">{{city.name}}</h4>
                            </div>
                        </div>

                    </VueSlickCarousel>
                </div>
                <div class="cities-slider">
                    <VueSlickCarousel
                        v-if="cities.length > 0"
                        :slidesToShow="1"
                        :slidesToScroll="1"
                        :swipeToSlide="true"
                        :speed="1500"
                        :infinite="true"
                        :arrows="false"
                        :autoplay="true"
                        :autoplaySpeed="5000"
                        :pauseOnFocus="true"
                        :pauseOnHover="true"
                        :dots="false">
                        <!--  item  -->
                        <div v-for="city in cities.slice(5, 10)">
                            <div class="slide-img">
                                <img src="https://hoteelsegypt.com/uploads/0000/871/2022/02/07/124013623.jpg"  :alt="city.name"/>
                            </div>
                            <div class=slider-content>
                                <h4 class="title">{{city.name}}</h4>
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
