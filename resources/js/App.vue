<template>
    <div id="app">
        <BottomNav />
        <div id="wrapper" class="wrapper-fluid banners-effect-10">
            <Navbar />
            <router-view></router-view>
            <Footer />
        </div>
    </div>
</template>

<script>
import Navbar from "./components/Layouts/Navbar";
import Footer from "./components/Layouts/Footer";
import BottomNav from "./components/Layouts/BottomNav";
export default {
    name: "App",
    components:{
        Navbar,
        Footer,
        BottomNav
    },
    data(){
        return{}
    },
    mounted() {

    }
}
</script>
