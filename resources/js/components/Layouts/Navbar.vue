<template>
    <div>
        <!-- Header Top -->
        <Topnav/>
        <nav class="navbar border-bottom navbar-light">
            <div class="container">
                <router-link class="navbar-brand" to="/">
                    <img :src="sittings.logo" class="w-auto">
                </router-link>

                <!-- toggle mobile menu  -->
                <button @click="toggleCanvas()" class="navbar-toggler d-md-none d-block">
                    <i class="fa fa-bars"></i>
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
                            <img :src="sittings.logo" class="w-auto">
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

                        <hr />
                        <div class="my-2">
                            <div class="bonus-mail">
                                <a target="_blank" :href="'mailto:'+sittings.email">{{ sittings.email }}</a>
                            </div>
                            <ul class="bonus-social-sidebar nav">
                                <li v-for="s in social" :key="s.id">
                                    <a v-if="s.key && s.key === 'facebook'" target="_blank" :href="s.value" :title="$t('facebook')"><span class="fa fa-facebook"></span></a>
                                    <a v-if="s.key && s.key === 'twitter'" target="_blank" :href="s.value" :title="$t('twitter')"><span class="fa fa-twitter"></span></a>
                                    <a v-if="s.key && s.key === 'whatsApp'" target="_blank" :href="'https://api.whatsapp.com/send?phone='+s.value" :title="$t('whatsApp')"><span class="fa fa-whatsapp"></span></a>
                                    <a v-if="s.key && s.key === 'linkedIn'" target="_blank" :href="s.value" :title="$t('linkedin')"><span class="fa fa-linkedin"></span></a>
                                    <a v-if="s.key && s.key === 'pinterest'" target="_blank" :href="s.value" :title="$t('pinterest')"><span class="fa fa-pinterest"></span></a>
                                    <a v-if="s.key && s.key === 'instagram'" target="_blank" :href="s.value" :title="$t('instagram')"><span class="fa fa-instagram"></span></a>
                                    <a v-if="s.key && s.key === 'youtube'" target="_blank" :href="s.value" :title="$t('youtube')"><span class="fa fa-youtube"></span></a>
                                </li>
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
            social: [],
            sittings: {},
            offcanvas: false
        }
    },
    mounted(){
        axios.get('sittings').then((res)=> {
            if(res.data.success === "true"){
                this.sittings = res.data.data ? res.data.data.sittings : {};
                this.social = res.data.data ? res.data.data.social : [];
            }
        }).catch();
    },
    methods:{
        toggleCanvas(){
            this.offcanvas = this.offcanvas !== true;
        }
    }
}
</script>
