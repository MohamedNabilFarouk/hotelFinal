<template>
    <div>
        <Slider :tours="slider_tours" :hotels="slider_hotels" :cities="slider_governorates" />
        <Search />
        <Hotels :hotels="hotels" />
        <Tours :tours="tours" />
        <BannerVideo video="BapSQFJPMM0" backgroundImage="https://d3jmn01ri1fzgl.cloudfront.net/photoadking/webp_thumbnail/6068378361475_json_image_1617442691.webp" />
        <Rooms :rooms="rooms" />
        <Spaces :spaces="spaces" />
    </div>
</template>

<script>
import Slider from "./HomePage/Slider";
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
            this.slider_tours = res.data.data ? res.data.data.slider_tours : [];
            this.slider_hotels = res.data.data ? res.data.data.slider_hotels : [];
            this.slider_governorates = res.data.data ? res.data.data.slider_governorates : [];

            this.hotels.map((hotel) => {
                if(hotel.rooms.length > 0){
                    this.rooms.push(hotel.rooms[0]);
                    this.rooms.push(hotel.rooms[1]);
                    hotel.rooms[2] ? this.rooms.push(hotel.rooms[2]) : "";
                    hotel.rooms[3] ? this.rooms.push(hotel.rooms[3]) : "";
                }
            });
        }).catch();
    },
    methods: {
    }
}
</script>
