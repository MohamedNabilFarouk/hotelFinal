<template>
    <div>
        <footer class="footer-container typefooter-1">
        <div class="">
            <div class="so-page-builder">
                <div class="container-fluid page-builder-ltr">
                    <div class="container">
                        <div class="row row_hwmc  ">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col_6ps1 footer--link">
                                <div class="footer-logo">
                                    <router-link to="/">
                                        <img :src="sittings.logo" :alt="sittings.title" class="w-auto" height="39" :title="sittings.title">
                                    </router-link>
                                </div>
                                <p>
                                    {{sittings.about}}
                                </p>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col_6ps1 footer--link">
                                <h3 class="title-footer text-capitalize">
                                    {{$t('address')}}
                                </h3>
                                <ul class="about-list">
                                    <li><i class="fa fa-map-marker"></i><span class="ab-pd">{{sittings.country + ', ' + sittings.city + ', ' + sittings.address}}</span></li>
                                    <li class="call-mail"><i class="fa fa-paper-plane"></i><a target="_blank" class="ab-pd" :href="'mailto:'+sittings.email">{{sittings.email}}</a></li>
                                    <li class="call-phone"><i class="fa fa-mobile"></i><a class="ab-pd" :href="'tel:'+sittings.phone">{{sittings.phone}}</a></li>
                                    <li class="call-phone"><i class="fa fa-volume-control-phone"></i><a class="ab-pd" :href="'tel:'+sittings.hot_line">{{sittings.hot_line}}</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col_6ps1 footer--link">
                                <h3 class="title-footer text-capitalize">
                                    {{$t('pages')}}
                                </h3>
                                <ul class="links text-capitalize">
                                    <li>
                                        <router-link to="/">{{$t('home')}}</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/hotels">{{$t('hotels')}}</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/tours">{{$t('tours')}}</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/tours/special">{{$t('special tours')}}</router-link>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col_6ps1 footer--link">
                                <h3 class="title-footer">
                                    {{$t('contact')}}
                                </h3>
                                <ul class="links text-capitalize">
                                    <li>
                                        <router-link to="/become-a-vendor">{{$t('become a vendor')}}</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/contact">{{$t('contact')}}</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/vendor-terms-and-conditions">{{$t('vendor') + ' ' +$t('terms_condition')}}</router-link>
                                    </li>
                                    <li>
                                        <router-link to="/terms-and-conditions">{{$t('terms_condition')}}</router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 text-capitalize copyright">
                        © 2022 | <router-link to="/">Hoteels Egypt</router-link>
                    </div>
                    <div class="col-6 social">
                        <h3 class="text-capitalize">{{$t('follow us')}}:</h3>
                        <ul>
                            <li v-for="s in social">
                                <a v-if="s.key && s.key === 'facebook'" target="_blank" :href="s.value" :title="$t('facebook')"><span class="fa fa-facebook"></span></a>
<!--                                <a v-if="s.key && s.key === 'twitter'" target="_blank" :href="s.value" :title="$t('twitter')"><span class="fa fa-twitter"></span></a>-->
<!--                                <a v-if="s.key && s.key === 'whatsApp'" target="_blank" :href="'https://api.whatsapp.com/send?phone='+s.value" :title="$t('whatsApp')"><span class="fa fa-whatsapp"></span></a>-->
<!--                                <a v-if="s.key && s.key === 'linkedIn'" target="_blank" :href="s.value" :title="$t('linkedin')"><span class="fa fa-linkedin"></span></a>-->
<!--                                <a v-if="s.key && s.key === 'pinterest'" target="_blank" :href="s.value" :title="$t('pinterest')"><span class="fa fa-pinterest"></span></a>-->
                                <a v-if="s.key && s.key === 'instagram'" target="_blank" :href="s.value" :title="$t('instagram')"><span class="fa fa-instagram"></span></a>
                                <a v-if="s.key && s.key === 'youtube'" target="_blank" :href="s.value" :title="$t('youtube')"><span class="fa fa-youtube"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
        <div @click="toTop" class="back-to-top"><i class="fa fa-angle-up"></i></div>
    </div>
</template>
<script>

export default {
    name: 'Footer',

    data() {
        return {
            sittings: {},
            social: []
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
        scrollBehavior() {
            return {x: 0, y: 0}
        },
        toTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    }
}
</script>
