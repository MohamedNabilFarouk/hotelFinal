<template>
    <div>
        <!-- Header Top -->
        <Topnav/>
        <nav class="navbar border-bottom navbar-light">
            <div class="container">
                <router-link class="navbar-brand" to="/">
                    <img src="https://hoteelsegypt.com/uploads/0000/1/2021/09/30/hoteels-150.png" class="w-auto"  alt="Hoteels Egypt" title="Hoteels Egypt">
                </router-link>

                <!-- toggle mobile menu  -->
                <button @click="toggleCanvas()" class="navbar-toggler d-md-none d-block">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <ul class="nav mr-auto d-md-flex d-none">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">{{$t('home')}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/hotels" class="nav-link">{{$t('hotels')}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/tours" class="nav-link">{{$t('tours')}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/tours/special" class="nav-link">{{$t('special tours')}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/become-a-vendor" class="nav-link">{{$t('become a vendor')}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/contact" class="nav-link">{{$t('contact')}}</router-link>
                    </li>
                </ul>

                <div :class="offcanvas ? 'show' : ''" class="offcanvas offcanvas-start" tabindex="-1" style="visibility: visible;">
                    <div class="offcanvas-header">
                        <router-link class="navbar-brand" to="/">
                            <img src="https://hoteelsegypt.com/uploads/0000/1/2021/09/30/hoteels-150.png" class="w-auto"  alt="Hoteels Egypt" title="Hoteels Egypt">
                        </router-link>
                        <button @click="toggleCanvas()" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <router-link to="/" class="nav-link">{{$t('home')}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/hotels" class="nav-link">{{$t('hotels')}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/tours" class="nav-link">{{$t('tours')}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/tours/special" class="nav-link">{{$t('special tours')}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/become-a-vendor" class="nav-link">{{$t('become a vendor')}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/contact" class="nav-link">{{$t('contact')}}</router-link>
                            </li>
                        </ul>

                        <div class="my-2">
                            <div class="bonus-mail mb-2">
                                <a target="_blank" href="mailto:info@hoteelsegypt.com">info@hoteelsegypt.com</a>
                            </div>
                            <ul class="bonus-social nav">
                                <li><a class="p-1" href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a class="py-1 px-2" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a class="py-1 px-2" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a class="py-1 px-2" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
import Topnav from "./Topnav";

export default {
    name: 'Navbar',
    components:{
        Topnav
    },
    data() {
        return {
            offcanvas: false
        }
    },
    methods:{
        toggleCanvas(){
            this.offcanvas = this.offcanvas !== true;
        }
    }
}
</script>
