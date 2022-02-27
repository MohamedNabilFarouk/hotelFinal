<template>
    <div>
        <div v-if="loading" class="ovely-loading">
            <div class="image">
                <vue-load-image>
                    <img slot="image" src="../../assets/loading.gif" />
                    <img slot="preloader" src="../../assets/loading.gif">
                    <img slot="error" src="../../assets/no_image.png">
                </vue-load-image>
            </div>
        </div>
        <!-- Main Container  -->
        <Breadcrumbs :PageTitle="$t('hotels')" PageLink="hotels" backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

        <div v-if="!loading" class="container product-detail">
            <div class="row">
                <aside
                    :class="aside ? 'active' : ''"
                    class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                    <span @click="toggleAside()" id="close-sidebar" class="fa fa-times"></span>

                    <div class="module-search clearfix">
                        <h3 class="modtitle">{{$t('hotel searching')}}</h3>
                        <form @submit.prevent="searchHotel()"
                              class="row px-1 justify-content-between align-items-center">

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-3">
                                    <label for="city" class="form-label text-capitalize">{{$t('city')}}</label>
                                    <v-select
                                        v-model="searchHotelsForm.sCity"
                                        :class="{
                                            'is-invalid': searchHotelsForm.errors.has('city')
                                        }"
                                        autocomplete="on"
                                        id="city"
                                        :placeholder="$t('city')"
                                        :get-option-label="(option) => option.name"
                                        :options="cities"></v-select>
                                    <div class="invalid-feedback"
                                         v-if="searchHotelsForm.errors.has('city')"
                                         v-html="searchHotelsForm.errors.get('city')">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-3">
                                    <label for="date_from" class="form-label text-capitalize">{{$t('date from')}}</label>
                                    <vuejs-datepicker :disabledDates="disabledTodayDates" :format="customFormatter"  v-model="searchHotelsForm.date_from" :placeholder="$t('date from')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': searchHotelsForm.errors.has('date_from')}"></vuejs-datepicker>
                                    <div class="invalid-feedback" v-if="searchHotelsForm.errors.has('date_from')" v-html="searchHotelsForm.errors.get('date_from')"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-3">
                                    <label for="date_to" class="form-label text-capitalize">{{$t('date to')}}</label>
                                    <vuejs-datepicker :disabledDates="disabledTomorrowDates" :format="customFormatter"  v-model="searchHotelsForm.date_to" :placeholder="$t('date to')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': searchHotelsForm.errors.has('date_to')}"></vuejs-datepicker>
                                    <div class="invalid-feedback"
                                         v-if="searchHotelsForm.errors.has('date_to')"
                                         v-html="searchHotelsForm.errors.get('date_to')">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <label for="adult" class="form-label text-capitalize">{{$t('adults')}}</label>
                                            <input type="number" :class="{'is-invalid': searchHotelsForm.errors.has('adult')}" v-model="searchHotelsForm.adult" class="form-control" id="adult" :placeholder="$t('adults')">
                                            <div class="invalid-feedback"
                                                 v-if="searchHotelsForm.errors.has('adult')"
                                                 v-html="searchHotelsForm.errors.get('adult')">
                                            </div>
                                        </div>

                                        <div class="mx-2"></div>

                                        <div>
                                            <label for="children" class="form-label text-capitalize">{{$t('children')}}</label>
                                            <input type="number" :class="{'is-invalid': searchHotelsForm.errors.has('children')}" v-model="searchHotelsForm.children" class="form-control" id="children" :placeholder="$t('children')">
                                            <div class="invalid-feedback"
                                                 v-if="searchHotelsForm.errors.has('children')"
                                                 v-html="searchHotelsForm.errors.get('children')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center col-md-12 col-12">
                                <button type="submit" class="btn btn-sm btn-info">
                                    {{$t('search')}}
                                    <span v-if="searchHotelsForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!searchHotelsForm.busy" aria-hidden="true" class="fa fa-search"></i>
                                </button>

                                <button v-if="search" @click="getHotels" type="button" class="btn btn-sm btn-danger">
                                    <i class="fa fa-ban"></i>
                                    {{$t('cancel')}}
                                </button>
                            </div>
                        </form>
                    </div>

                    <form @submit.prevent="filterHotel()" class="sidefilter-form">
                        <div>
                            <button class="btn btn-sm btn-info">
                                <span v-if="filterHotelForm.busy" class="spinner-border spinner-border-sm"></span>

                                <i v-if="!filterHotelForm.busy" class="fa fa-filter"></i>
                                {{$t('filter')}}

                            </button>
                            <button v-if="filter" @click="getHotels" type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-ban"></i>
                                {{$t('cancel')}}
                            </button>
                        </div>

                        <div class="module-rate clearfix">
                            <h3>{{$t('price')}}</h3>
                            <div class="d-flex px-3 justify-content-between">
                                <div class="mb-3">
                                    <label for="min-price" class="form-label text-capitalize">{{$t('min price')}}</label>
                                    <input :max="max_price" :min="min_price" type="number" :class="{'is-invalid': filterHotelForm.errors.has('price')}" v-model="filterHotelForm.price[0]" class="form-control" id="min-price" :placeholder="$t('min price')">
                                </div>
                                <div class="mb-3">
                                    <label for="max-price" class="form-label text-capitalize">{{$t('max price')}}</label>
                                    <input :max="max_price" :min="min_price" type="number" :class="{'is-invalid': filterHotelForm.errors.has('price')}" v-model="filterHotelForm.price[1]" class="form-control" id="max-price" :placeholder="$t('max price')">
                                </div>
                            </div>
                            <div class="invalid-feedback"
                                 v-if="filterHotelForm.errors.has('price')"
                                 v-html="filterHotelForm.errors.get('price')">
                            </div>
                        </div>

                        <div class="module-rate clearfix">
                            <h3>{{$t('star rating')}}</h3>
                            <ul>
                                <li v-for="(star, i) in filterHotelForm.stars" :key="i">
                                    <label class="d-flex align-items-center">
                                        <input class="me-2" @change="starSelected(star)" v-model="star.selected" type="checkbox">
                                        <starRating :star-size="18" :rating="star.star" :show-rating="false" :read-only="true"></starRating>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div style="overflow: hidden;" :style="showAllCities ? 'height: auto' : 'height: 280px'" class="module-rate clearfix">
                            <h3>{{$t('cities')}}</h3>
                            <p type="button" class="mb-1"><strong @click="() =>{ showAllCities = true}" v-if="!showAllCities" style="color:#2db2ff"> {{ $t("view all") }} </strong></p>
                            <p type="button" class="mb-1"><strong @click="() =>{ showAllCities = false}" v-if="showAllCities" style="color:#2db2ff"> {{ $t("view less") }} </strong></p>
                            <ul>
                                <li v-for="city in filterHotelForm.cities" :key="city.id">
                                    <label class="d-flex align-items-center cites">
                                        <input class="me-2" :checked="filterHotelForm.gov_id.indexOf(city.id) >= 0 ? 'checked' : ''" @change="citySelected(city)" type="checkbox">
                                        {{city.name}}
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </form>

                    <div class="module-pop clearfix"><h3>{{ $t("popular") }} {{ $t("hotels") }}</h3>
                        <div v-for="hotel in popularHotels.slice(0,2)" :key="hotel.id" class="item clearfix">
                            <div class="image">
                                <router-link :to="'/hotel/'+hotel.id">
                                    <vue-load-image>
                                        <img slot="image" :src="hotel.image" class="img-responsive" />
                                        <img slot="preloader" src="../../assets/loading.gif">
                                        <img slot="error" src="../../assets/no_image.png">
                                    </vue-load-image>
                                </router-link>
                            </div>

                            <div class="content">
                                <h4><router-link :to="'/hotel/'+hotel.id">{{ hotel.title_api }}</router-link></h4>
                                <starRating
                                    :star-size="15"
                                    :rating="hotel.star_rate ? parseInt(hotel.star_rate) : 0"
                                    :show-rating="false"
                                    :read-only="true"></starRating>
                                <strong>{{ $t('from') }} {{ hotel.min_price }} /{{ $t('night') }} </strong><br>
                                <router-link :to="'/hotel/'+hotel.id" class="btn btn-sm btn-info">{{ $t('book now') }}</router-link>
                            </div>
                        </div>
                    </div>
                </aside>

                <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                    <div class="products-category">
                        <div class="border-bottom product-filter hidden-xs filters-panel">
                            <div class="list-view">
                                <button @click="toggleAside()" class="btn d-block d-md-none btn-default text-capitalize">
                                    <i class="fa fa-bars"></i>
                                    {{$t('menu')}}
                                </button>
                                <button
                                    @click="gridViewFun('grid')"
                                    :class="gridView ? 'active': ''"
                                    class="btn btn-default">
                                    <i class="fa fa-th-large"></i>
                                </button>
                                <button
                                    :class="gridView ? '': 'active'"
                                    @click="gridViewFun('list')"
                                    class="btn btn-default">
                                    <i class="fa fa-th-list"></i>
                                </button>
                            </div>
                        </div>

                        <div
                            v-if="hotels.data"
                            :class="gridView ? 'gird': 'list'"
                            class="section-style4 products-list row number-col-3 so-filter-gird">

                            <div v-for="hotel in hotels.data" :key="hotel.id"
                                :class="gridView ? 'col-lg-6 col-md-6 col-sm-6 col-xs-6': 'col-lg-12 col-md-12 col-sm-12 col-xs-12'"
                                class="product-layout">
                                <div class="product-item-container item p-0 mb-3">
                                    <div class="item-block so-quickview">
                                        <div class="image">
                                            <router-link :to="'hotel/'+hotel.id" target="_self">
                                                <vue-load-image>
                                                    <img slot="image" :src="hotel.image" class="img-responsive" />
                                                    <img slot="preloader" src="../../assets/loading.gif" class="w-auto h-auto">
                                                    <img slot="error" src="../../assets/no_image.png">
                                                </vue-load-image>
                                            </router-link>
                                        </div>
                                        <div class="item-content clearfix">
                                            <h3>
                                                <router-link :to="'hotel/'+hotel.id">{{hotel.title_api}}</router-link>
                                            </h3>
                                            <div class="reviews-content">
                                                <starRating
                                                    :star-size="15"
                                                    :rating="hotel.star_rate ? parseInt(hotel.star_rate) : 0"
                                                    :show-rating="false"
                                                    :read-only="true"></starRating>
                                            </div>
                                            <ul>
                                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{hotel.address_api}}</li>
                                            </ul>
                                            <div class="des">{{hotel.content_api}}</div>
                                            <div class="item-bot clearfix">
                                                <div class="price pull-left">
                                                    {{ $t('from') }} <label>{{hotel.min_price}}</label><span>{{ $t('night') }}</span>
                                                </div>
                                                <router-link :to="'hotel/'+hotel.id" class="book-now btn-quickview quickview quickview_handler pull-right" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">{{ $t('book now') }}</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <pagination
                            v-if="hotels.data && !search && !filter"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="hotels" @pagination-change-page="getHotels">
                            <span class="w-auto" slot="prev-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                            <span slot="next-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </pagination>

                        <pagination
                            v-if="hotels.data && filter && !search"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="hotels" @pagination-change-page="filterHotel">
                            <span class="w-auto" slot="prev-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                            <span slot="next-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </pagination>

                        <pagination
                            v-if="hotels.data && search && !filter"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="hotels" @pagination-change-page="getSearchHotels">
                            <span class="w-auto" slot="prev-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                            <span slot="next-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </pagination>
                    </div>
                </div>
            </div>
        </div>
        <!-- //Main Container -->
    </div>
</template>

<script>
import Breadcrumbs from "./Layouts/Breadcrumbs";
import starRating from "vue-star-rating";
import Form from "vform";
import { mapGetters } from 'vuex';
export default {
    name: 'Hotels',
    components:{
        Breadcrumbs,
        starRating
    },
    computed: {
        ...mapGetters([
            'searchHotels'
        ]),
    },
    data(){
        return{
            showAllCities: false,
            popularHotels: [],
            disabledTodayDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledTomorrowDates: {
                to: new Date(Date.now())
            },
            aside: false,
            loading: true,
            hotels: this.$route.params.hotels ? this.$route.params.hotels : [],
            search: this.$route.params.search ? this.$route.params.search : false,
            filter: false,
            gridView: true,
            cities: [],
            searchHotelsForm: new Form({
                city: '',
                sCity: '',
                date_from: '',
                date_to: '',
                adult: 2,
                children: 0
            }),
            min_price: 0,
            max_price: 0,
            filterHotelForm: new Form({
                price: [100, 5000],
                star_rate: [],
                stars: [{star: 5, selected: false}, {star: 4, selected: false}, {star: 3, selected: false}, {star: 2, selected: false}, {star: 1, selected: false}],
                gov_id: [],
                cities: [],
            })
        }
    },
    mounted() {
        this.search ? this.fillFormData() : this.getHotels();
        this.getCities();
        this.searchHotelsForm.fill(this.searchHotels ? this.searchHotels : '');
        if (this.searchHotelsForm.city){
            this.filterHotelForm.gov_id.push(parseInt(this.searchHotelsForm.city));
        }
        axios.post('hotelRoomsMinMaxPrice').then((res)=>{
            if (res.data.success === 'true'){
                this.min_price = res.data.data && res.data.data.min_price ? res.data.data.min_price : 0;
                this.max_price = res.data.data && res.data.data.max_price ? res.data.data.max_price : 1;
                this.filterHotelForm.price[0] = this.min_price;
                this.filterHotelForm.price[1] = this.max_price;
                this.loading = false;
            }
        }).catch();
        axios.get('home').then((res)=>{
            this.popularHotels = res.data.data ? res.data.data.slider_hotels : [];
        }).catch();
    },
    methods: {
        customFormatter(date) {
            return moment(date).format('DD-MM-YYYY');
        },
        toggleAside(){
            this.aside = this.aside === false;
        },
        getCities(){
            axios.get('cities')
                .then((res)=>{
                    this.cities = res.data.data && res.data.data.cities ? res.data.data.cities : [];
                    this.filterHotelForm.cities = this.cities;
                })
                .catch();
        },
        getHotels(page = 1){
            axios.get('hotels?page=' + page).then((res)=>{
                this.hotels = res.data.data ? res.data.data.hotels : [];
                this.search = false;
                this.filter = false;
            }).catch(() =>{});
        },
        fillFormData(){
            this.searchHotelsForm.fill(this.searchHotels);
        },
        getSearchHotels(page = 1){
            this.searchHotelsForm.get('searchHotel?page=' + page).then((res)=>{
                this.hotels = res.data.data ? res.data.data.hotels : [];
                this.search = true;
                this.filter = false;
            }).catch(() =>{});
        },
        gridViewFun(view){view === 'grid' ? this.gridView = true : this.gridView = false},
        searchHotel(){
            this.searchHotelsForm.city =  this.searchHotelsForm.sCity ? this.searchHotelsForm.sCity.id : '';
            this.searchHotelsForm.get("searchHotel").then((res)=>{
                if (res.data.success === 'true'){
                    this.$store.dispatch('searchHotels', this.searchHotelsForm);
                    this.hotels = res.data.data && res.data.data.hotels ? res.data.data.hotels : [];
                    this.search = true;
                    this.filter = false;
                }else{
                    this.searchHotelsForm.errors.set(res.data.data);
                }
            }).catch(()=>{});
        },
        starSelected(star){
            if(star.selected){
                this.filterHotelForm.star_rate.push(parseInt(star.star));
            }else{
                const index =this.filterHotelForm.star_rate.indexOf(star.star);
                this.filterHotelForm.star_rate.splice(index,1);
            }
            // console.log(this.filterHotelForm.star_rate);
        },
        citySelected(city){
            const index = this.filterHotelForm.gov_id.indexOf(city.id);
            if(index < 0){
                this.filterHotelForm.gov_id.push(parseInt(city.id));
            }else {
                this.filterHotelForm.gov_id.splice(index,1);
            }
        },
        filterHotel(page = 1){
            this.filterHotelForm.get("filterHotels?page=" + page).then((res)=>{
                if (res.data.success === 'true'){
                    // this.$store.dispatch('searchHotels', this.searchHotelsForm);
                    this.hotels = res.data.data && res.data.data.hotels ? res.data.data.hotels : [];
                    this.search = false;
                    this.filter = true;
                }else{
                    this.filterHotelForm.errors.set(res.data.data);
                }
            }).catch(()=>{});
        },
    }
}
</script>
