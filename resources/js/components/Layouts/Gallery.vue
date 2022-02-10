<template>
    <div>
        <div class="gallery-slider-main">
            <VueSlickCarousel
                :arrows="true"
                :autoplay="true"
                :infinite="true"
                :focusOnSelect="true">
                <div v-for="image in images"><img :src="image.image" alt=""></div>
            </VueSlickCarousel>
        </div>
<!--        <div class="gallery-slider-main">-->
<!--            <VueSlickCarousel-->
<!--                ref="c1"-->
<!--                :autoplay="true"-->
<!--                :infinite="true"-->
<!--                :asNavFor="$refs.c2"-->
<!--                :focusOnSelect="true">-->
<!--                <div v-for="image in images"><img :src="image.image" alt=""></div>-->
<!--            </VueSlickCarousel>-->
<!--        </div>-->
<!--        <div class="gallery-slider-nav d-none d-md-block">-->
<!--            <VueSlickCarousel-->
<!--                ref="c2"-->
<!--                :arrows="true"-->
<!--                :infinite="true"-->
<!--                :asNavFor="$refs.c1"-->
<!--                :slidesToShow="4"-->
<!--                :focusOnSelect="true">-->
<!--                <div v-for="image in images"><img :src="image.image" alt=""></div>-->
<!--            </VueSlickCarousel>-->
<!--        </div>-->
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel';
export default {
    name: 'Gallery',
    props: {
        images: {type: Array, default:  () => ([])}
    },
    components:{
        VueSlickCarousel
    },
    data(){
        return{}
    },
    mounted() {
    },
    methods: {
    }
}
</script>
