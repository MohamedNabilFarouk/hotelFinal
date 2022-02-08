<template>
    <!-- Header Container  -->
    <header id="header" class="typeheader-1">
        <!-- Header Top -->
        <Topnav/>

        <div class="header-top hidden-compact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-xs-3 header-logo pull-left">
                        <div class="navbar-logo">
                            <router-link to="/">
                                <img src="https://hoteelsegypt.com/uploads/0000/1/2021/09/30/hoteels-150.png"
                                   class="w-auto"  alt="Hoteels Egypt" title="Hoteels Egypt">
                            </router-link>
                        </div>
                    </div>
                    <!-- Menuhome -->
                    <div class="header-menu pull-right">
                        <div class="megamenu-style-dev megamenu-dev">
                            <div class="responsive">
                                <nav class="navbar-default">
                                    <div class="container-megamenu horizontal">
                                        <div class="navbar-header">
                                            <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <div class="megamenu-wrapper">
                                            <span id="remove-megamenu" class="fa fa-times"></span>
                                            <div class="megamenu-pattern">
                                                <div class="container">
                                                    <ul class="megamenu" data-transition="slide" data-animationtime="500">
                                                        <li class="hover">
                                                            <router-link to="/" class="clearfix">
                                                                {{$t('home')}}
                                                            </router-link>
                                                        </li>
                                                        <li class="hover">
                                                            <router-link to="/hotel" class="clearfix">
                                                                {{$t('hotels')}}
                                                            </router-link>
                                                        </li>
                                                        <li class="hover">
                                                            <router-link to="/tour" class="clearfix">
                                                                {{$t('tours')}}
                                                            </router-link>
                                                        </li>
                                                        <li class="hover">
                                                            <router-link to="/FlightBooking" class="clearfix">
                                                                {{$t('flight booking')}}
                                                            </router-link>
                                                        </li>
                                                        <li class="hover">
                                                            <router-link to="/become-a-vendor" class="clearfix">
                                                                {{$t('become a vendor')}}
                                                            </router-link>
                                                        </li>
                                                        <li class="hover">
                                                            <router-link to="/contact" class="clearfix">
                                                                {{$t('contact')}}
                                                            </router-link>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //Header Top -->
    </header>
    <!-- //Header Container  -->
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
        }
    }
}
</script>
