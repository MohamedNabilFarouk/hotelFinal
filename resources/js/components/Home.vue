<template>
    <div>
        <Search />

        <div class="main-sliders">
            <Slider :tours="slider_tours" :hotels="slider_hotels" :cities="slider_governorates" />
        </div>

        <Rooms :rooms="rooms" />

        <Hotels :hotels="hotels" />

        <BannerVideo video="BapSQFJPMM0" backgroundImage="https://d3jmn01ri1fzgl.cloudfront.net/photoadking/webp_thumbnail/6068378361475_json_image_1617442691.webp" />

        <Spaces :spaces="spaces" />

        <Tours :tours="tours" />
    </div>
</template>

<script>
import Slider from "./HomePage/Slider.vue";
import Search from "./HomePage/Search";
import Hotels from "./HomePage/Hotels";
import Tours from "./HomePage/Tours";
import BannerVideo from  "./HomePage/BannerVideo";
import Spaces from  "./HomePage/Spaces";
import Rooms from  "./HomePage/Rooms";
export default {
    name: 'Home',
    components:{ Slider, Search, Hotels, Tours, BannerVideo, Spaces, Rooms },
    data(){
        return{
            hotels: [],
            tours: [],
            spaces: [],
            slider_tours: [],
            slider_hotels: [],
            slider_governorates: [],
            rooms: []
        }
    },
    mounted() {
        axios.get('home').then((res)=>{
            this.hotels = res.data.data ? res.data.data.hotels : [];
            this.tours = res.data.data ? res.data.data.tours : [];
            this.spaces = res.data.data ? res.data.data.spaces : [];
            this.rooms = res.data.data ? res.data.data.rooms : [];
            this.slider_tours = res.data.data ? res.data.data.slider_tours : [];
            this.slider_hotels = res.data.data ? res.data.data.slider_hotels : [];
            this.slider_governorates = res.data.data ? res.data.data.slider_governorates : [];
            this.loading = false;
        }).catch();
    },
    methods: {
    }
}
</script>
