<template>
    <div>
        <div class="gallery-slider-main">
            <VueSlickCarousel
                :arrows="true"
                :autoplay="true"
                :infinite="true"
                :focusOnSelect="true">
                <div @click="index = i" v-for="(image, i) in images"><img :src="image.image" alt=""></div>
            </VueSlickCarousel>
        </div>
        <vue-gallery-slideshow :images="gImages" :index="index" @close="index = null"></vue-gallery-slideshow>
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel';
import VueGallerySlideshow from 'vue-gallery-slideshow';

export default {
    name: 'Gallery',
    props: {
        images: {type: Array, default:  () => ([])}
    },
    components:{
        VueSlickCarousel,
        VueGallerySlideshow
    },
    data(){
        return{
            gImages: [],
            index: null
        }
    },
    mounted() {
        this.images.map((img)=>{
            this.gImages.push(img.image);
        });
    },
    methods: {
    }
}
</script>
