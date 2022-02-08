<template>
    <div id="app">
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
export default {
    name: "App",
    components:{
        Navbar,
        Footer
    },
    data(){
        return{}
    },
    mounted() {

    }
}
</script>
