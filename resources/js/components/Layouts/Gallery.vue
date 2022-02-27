<template>
    <div>
        <div class="gallery-slider-main">
            <VueSlickCarousel
                :arrows="true"
                :autoplay="true"
                :infinite="true"
                :focusOnSelect="true">
                <div @click="index = i" v-for="(image, i) in images" :key="image.id">
                    <vue-load-image>
                        <img slot="image" :src="image.image" />
                        <img slot="preloader" src="../../../assets/loading.gif">
                        <img slot="error" src="../../../assets/no_image.png">
                    </vue-load-image>
                </div>
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
