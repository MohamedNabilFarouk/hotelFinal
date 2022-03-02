<template>
    <div>
        <!-- Main Container  -->
        <Breadcrumbs :PageTitle="$t('tours')" PageLink="/tours" 
        backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

        <div class="container product-detail">
            <div class="row">
                <aside :class="aside ? 'active' : ''"
                    class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                    <span @click="toggleAside()" id="close-sidebar" class="fa fa-times"></span>

                    <div class="module-search clearfix">
                        <h3 class="modtitle">{{$t('tour searching')}}</h3>
                        <form @submit.prevent="searchTour()"
                              class="row px-1 justify-content-between align-items-center">

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-3">
                                    <label for="city" class="form-label text-capitalize">{{$t('city')}}</label>
                                    <v-select
                                        v-model="searchToursForm.sCity"
                                        :class="{
                                            'is-invalid': searchToursForm.errors.has('city')
                                        }"
                                        autocomplete="on"
                                        id="city"
                                        :placeholder="$t('city')"
                                        :get-option-label="(option) => $t(option.name_en.toLowerCase().trim())"
                                        :options="cities"></v-select>
                                    <div class="invalid-feedback"
                                         v-if="searchToursForm.errors.has('city')"
                                         v-html="searchToursForm.errors.get('city')">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="mb-3">
                                    <label for="date" class="form-label text-capitalize">{{$t('date')}}</label>
                                    <vuejs-datepicker :disabledDates="disabledTodayDates" :format="customFormatter"  v-model="searchToursForm.date" :placeholder="$t('date')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': searchToursForm.errors.has('date')}"></vuejs-datepicker>
                                    <div class="invalid-feedback" v-if="searchToursForm.errors.has('date')" v-html="searchToursForm.errors.get('date')"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center col-md-12 col-12">
                                <button type="submit" class="btn btn-sm btn-info">
                                    {{$t('search')}}
                                    <span v-if="searchToursForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!searchToursForm.busy" aria-hidden="true" class="fa fa-search"></i>
                                </button>

                                <button v-if="search" @click="getTours" type="button" class="btn btn-sm btn-danger">
                                    <i class="fa fa-ban"></i>
                                    {{$t('cancel')}}
                                </button>
                            </div>
                        </form>
                    </div>

                    <form @submit.prevent="filterTour()" class="sidefilter-form">
                        <div class="module-search mb-1 clearfix">
                            <h3 class="modtitle">{{$t('tour')}} {{$t('filter')}}</h3>

                            <div class="module-rate mb-1 clearfix">
                                <h3>{{$t('price')}}</h3>
                                <div class="d-flex px-3 justify-content-between">
                                    <div class="mb-3">
                                        <label for="min-price" class="form-label text-capitalize">{{$t('min price')}}</label>
                                        <input :max="max_price" :min="min_price" type="number" :class="{'is-invalid': filterToursForm.errors.has('price')}" v-model="filterToursForm.price[0]" class="form-control" id="min-price" :placeholder="$t('min price')">
                                    </div>
                                    <div class="mb-3">
                                        <label for="max-price" class="form-label text-capitalize">{{$t('max price')}}</label>
                                        <input :max="max_price" :min="min_price" type="number" :class="{'is-invalid': filterToursForm.errors.has('price')}" v-model="filterToursForm.price[1]" class="form-control" id="max-price" :placeholder="$t('max price')">
                                    </div>
                                </div>
                                <div class="invalid-feedback"
                                    v-if="filterToursForm.errors.has('price')"
                                    v-html="filterToursForm.errors.get('price')">
                                </div>
                            </div>

                            <div class="module-rate mb-1 clearfix">
                                <h3>{{$t('star rating')}}</h3>
                                <ul>
                                    <li v-for="(star, i) in filterToursForm.stars" :key="i">
                                        <label class="d-flex align-items-center">
                                            <input class="me-2" @change="starSelected(star)" v-model="star.selected" type="checkbox">
                                            <starRating :star-size="18" :rating="star.star" :show-rating="false" :read-only="true"></starRating>
                                        </label>
                                    </li>
                                </ul>
                            </div>

                            <div style="overflow: hidden;" :style="showAllCities ? 'height: auto' : 'height: 280px'" class="module-rate mb-1 clearfix">
                                <h3>{{$t('cities')}}</h3>
                                <ul>
                                    <li v-for="city in filterToursForm.cities" :key="city.id">
                                        <label class="d-flex align-items-center cites">
                                            <input class="me-2" :checked="filterToursForm.gov_id.indexOf(city.id) >= 0 ? 'checked' : ''" @change="citySelected(city)" type="checkbox">
                                            {{$t(city.name_en.toLowerCase().trim())}}
                                        </label>
                                    </li>
                                </ul>
                            </div>

                            <p style="text-align: center;font-size: .9rem;" type="button" class="mb-1 text-capitalize"><strong @click="() =>{ showAllCities = true}" v-if="!showAllCities" style="color:#d89939"><i class="fa fa-arrow-down"></i> {{ $t("view more") }} </strong></p>
                            <p style="text-align: center;font-size: .9rem;" type="button" class="mb-1 text-capitalize"><strong @click="() =>{ showAllCities = false}" v-if="showAllCities" style="color:#d89939"><i class="fa fa-arrow-up"></i> {{ $t("view less") }} </strong></p>
                            
                            <button
                                :class="filterToursForm.price.length < 2 && filterToursForm.gov_id.length < 1 && filterToursForm.stars.length < 1 ? 'disabled': ''"
                                class="btn btn-sm btn-info">
                                <span v-if="filterToursForm.busy" class="spinner-border spinner-border-sm"></span>

                                <i v-if="!filterToursForm.busy" class="fa fa-filter"></i>
                                {{$t('filter')}}

                            </button>
                            <button v-if="filter" @click="getTours" type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-ban"></i>
                                {{$t('cancel')}}
                            </button>
                        </div>
                    </form>

                    <div class="module-pop mb-1 clearfix"><h3>{{ $t("popular") }} {{ $t("tours") }}</h3>
                        <div v-for="tour in popularTours.slice(0,2)" :key="tour.id" class="item clearfix">
                            <div class="image">
                                <router-link :to="'/tour/'+tour.id">
                                    <vue-load-image>
                                        <img slot="image" :src="tour.image" class="img-responsive" />
                                        <img slot="preloader" src="../../assets/loading.gif">
                                        <img slot="error" src="../../assets/no_image.png">
                                    </vue-load-image>
                                </router-link>
                            </div>

                            <div class="content">
                                <h4><router-link :to="'/tour/'+tour.id">{{ tour.title_api }}</router-link></h4>
                                <starRating
                                    :star-size="15"
                                    :rating="tour.star_rate ? parseInt(tour.star_rate) : 0"
                                    :show-rating="false"
                                    :read-only="true"></starRating>
                                <strong>{{ cahangePrice(tour.price_api.price) }}{{ currency ? $t(currency.abbr) : $t("LE")}}/{{ $t('person') }} </strong><br>
                                <strong>{{ cahangePrice(tour.price_api.ch_price) }}{{ currency ? $t(currency.abbr) : $t("LE")}}/{{ $t('child') }} </strong><br>
                                <router-link :to="'/tour/'+tour.id" class="btn btn-sm btn-info">{{ $t('book now') }}</router-link>
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
                                    {{$t('adv_search')}}
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
                            v-if="tours.data"
                            :class="gridView ? 'gird': 'list'"
                            class="section-style4 products-list row number-col-3 so-filter-gird">

                            <div v-for="tour in tours.data" :key="tour.id"
                                 :class="gridView ? 'col-lg-6 col-md-6 col-sm-6 col-xs-6': 'col-lg-12 col-md-12 col-sm-12 col-xs-12'"
                                class="product-layout">
                                <div class="product-item-container item p-0 mb-3">
                                    <div class="item-block so-quickview">
                                        <div class="image">
                                            <router-link :to="'tour/'+tour.id" target="_self">
                                                <vue-load-image>
                                                    <img slot="image" :src="tour.image" class="img-responsive" />
                                                    <img slot="preloader" src="../../assets/loading.gif" class="w-auto h-auto">
                                                    <img slot="error" src="../../assets/no_image.png">
                                                </vue-load-image>
                                            </router-link>
                                        </div>
                                        <div class="item-content clearfix">
                                        
                                            <h3>
                                                <router-link :to="'tour/'+tour.id">{{tour.title_api}}</router-link>
                                            </h3>
                                            <div class="reviews-content">
                                                <starRating
                                                    :star-size="15"
                                                    :rating="tour.star_rate ? parseInt(tour.star_rate) : 0"
                                                    :show-rating="false"
                                                    :read-only="true"></starRating>
                                            </div>
                                            <ul>
                                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{tour.address_api}}</li>
                                                <li v-if="tour.type === 'special'"><i class="fa fa-gratipay" aria-hidden="true"></i> {{$t(tour.type)}} {{$t('tour')}}</li>
                                            </ul>
                                            <div class="des">{{tour.content_api}}</div>
                                            <div class="item-bot clearfix">
                                                <div class="price pull-left">
                                                    <label>{{cahangePrice(tour.price_api.price)}}{{ currency ? $t(currency.abbr) : $t("LE")}}</label><span>{{$t('person')}}</span><br>
                                                    <label>{{cahangePrice(tour.price_api.ch_price)}}{{ currency ? $t(currency.abbr) : $t("LE")}}</label><span>{{$t('child')}}</span>
                                                </div>
                                                <router-link :to="'tour/'+tour.id" class="book-now btn-quickview quickview quickview_handler pull-right" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">{{ $t('book now') }}</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <pagination
                            v-if="tours.data && !search && !filter"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="tours" @pagination-change-page="getTours">
                            <span class="w-auto" slot="prev-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                            <span slot="next-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </pagination>

                        <pagination
                            v-if="tours.data && !search && filter"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="tours" @pagination-change-page="filterTour">
                            <span class="w-auto" slot="prev-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                            <span slot="next-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </pagination>

                        <pagination
                            v-if="tours.data && search && !filter"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="tours" @pagination-change-page="getSearchTours">
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
import HotelsFilter from "./Hotels/Filter";
import starRating from "vue-star-rating";
import { mapGetters } from 'vuex';
import Form from "vform";

export default {
    name: 'Tours',
    computed: {
        ...mapGetters([
            'searchTours', 'currency'
        ]),
    },
    components:{
        Breadcrumbs,
        HotelsFilter,
        starRating
    },
    data(){
        return{
            showAllCities: false,
            popularTours: [],
            disabledTodayDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledTomorrowDates: {
                to: new Date(Date.now())
            },
            aside: false,
            gridView: true,
            tours: this.$route.params.tours ? this.$route.params.tours : [],
            search: this.$route.params.search ? this.$route.params.search : false,
            filter: false,
            cities: [],
            searchToursForm: new Form({
                city: '',
                sCity: '',
                date: ''
            }),
            min_price: 0,
            max_price: 5000,
            filterToursForm: new Form({
                price: [0, 5000],
                star_rate: [],
                stars: [{star: 5, selected: false}, {star: 4, selected: false}, {star: 3, selected: false}, {star: 2, selected: false}, {star: 1, selected: false}, {star: 0, selected: false}],
                gov_id: [],
                cities: [],
            })
        }
    },
    mounted() {
        this.getCities();
        this.search ? this.fillFormData() : this.getTours();
        this.searchToursForm.fill(this.searchTours ? this.searchTours : '');
        if (this.searchToursForm.city){
            this.filterToursForm.gov_id.push(parseInt(this.searchToursForm.city));
        }
        // axios.post('toursRoomsMinMaxPrice').then((res)=>{
        //     if (res.data.success === 'true'){
        //         this.min_price = res.data.data && res.data.data.min_price ? res.data.data.min_price : 0;
        //         this.max_price = res.data.data && res.data.data.max_price ? res.data.data.max_price : 1;
        //         this.filterToursForm.price[0] = this.min_price;
        //         this.filterToursForm.price[1] = this.max_price;
        //         this.loading = false;
        //     }
        // }).catch();
        axios.get('home').then((res)=>{
            this.popularTours = res.data.data ? res.data.data.slider_tours : [];
        }).catch();
    },
    methods: {
        cahangePrice(price){
            if(this.currency){
                return parseFloat(parseFloat(price).toFixed(2) / parseFloat(this.currency.ex_rate).toFixed(2)).toFixed(2);
            }else{
                return parseFloat(price).toFixed(2);
            }
        },
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
                    this.filterToursForm.cities = this.cities;
                })
                .catch();
        },
        fillFormData(){
            this.searchToursForm.fill(this.searchTours);
        },
        getTours(page = 1){
            axios.get('tours?page=' + page).then((res)=>{
                this.tours = res.data.data ? res.data.data.tours : [];
                this.search = false;
                this.filter = false;
            }).catch(() =>{});
        },
        getSearchTours(page = 1){
            this.searchToursForm.get('searchTour?page=' + page).then((res)=>{
                this.tours = res.data.data ? res.data.data.tours : [];
                this.search = true;
                this.filter = false;
            }).catch(() =>{});
        },
        searchTour(){
            this.searchToursForm.city =  this.searchToursForm.sCity ? this.searchToursForm.sCity.id : '';
            this.searchToursForm.get("searchTour").then((res)=>{
                if (res.data.success === 'true'){
                    this.$store.dispatch('searchTours', this.searchToursForm);
                    this.tours = res.data.data && res.data.data.tours ? res.data.data.tours : [];
                    this.search = true;
                    this.filter = false;
                }else{
                    this.searchToursForm.errors.set(res.data.data);
                }
            }).catch(()=>{});
        },
        gridViewFun(view){view === 'grid' ? this.gridView = true : this.gridView = false},
        starSelected(star){
            if(star.selected){
                this.filterToursForm.star_rate.push(parseInt(star.star));
            }else{
                const index =this.filterToursForm.star_rate.indexOf(star.star);
                this.filterToursForm.star_rate.splice(index,1);
            }
            // console.log(this.filterHotelForm.star_rate);
        },
        citySelected(city){
            const index = this.filterToursForm.gov_id.indexOf(city.id);
            if(index < 0){
                this.filterToursForm.gov_id.push(parseInt(city.id));
            }else {
                this.filterToursForm.gov_id.splice(index,1);
            }
        },
        filterTour(page = 1){
            this.filterToursForm.get("filterTours?page=" + page).then((res)=>{
                if (res.data.success === 'true'){
                    // this.$store.dispatch('searchHotels', this.searchHotelsForm);
                    this.tours = res.data.data && res.data.data.tours ? res.data.data.tours : [];
                    this.search = false;
                    this.filter = true;
                }else{
                    this.filterToursForm.errors.set(res.data.data);
                }
            }).catch(()=>{});
        },
    }
}
</script>
