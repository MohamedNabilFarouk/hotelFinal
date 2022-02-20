<template>
    <div>
        <!-- Main Container  -->
        <Breadcrumbs PageTitle="Hotels" PageLink="hotels" backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

        <div v-if="!loading" class="container product-detail">
            <div class="row">
                <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                    <span id="close-sidebar" class="fa fa-times"></span>

                    <div class="module-rate clearfix">
                        <h3 class="modtitle">Hotel searching</h3>
                        <form @submit.prevent="searchHotel()"
                              class="row px-4 justify-content-between align-items-center">

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group location-input">
                                    <label>Destinations
                                        <v-select
                                            v-model="searchHotelsForm.sCity"
                                            :class="{
                                                'is-invalid': searchHotelsForm.errors.has('city')
                                            }"
                                            autocomplete="on"
                                            placeholder="City, region or anywhere"
                                            :get-option-label="(option) => option.name"
                                            :options="cities"></v-select>
                                    </label>
                                    <span class="text-danger"
                                          v-if="searchHotelsForm.errors.has('city')"
                                          v-html="searchHotelsForm.errors.get('city')">
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>date from
                                        <input
                                            :class="{
                                                'is-invalid': searchHotelsForm.errors.has('date_from')
                                            }"
                                            v-model="searchHotelsForm.date_from"
                                            type="date" placeholder="date from" />
                                    </label>
                                    <span class="text-danger"
                                          v-if="searchHotelsForm.errors.has('date_from')"
                                          v-html="searchHotelsForm.errors.get('date_from')">
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>date to
                                        <input
                                            :class="{
                                                'is-invalid': searchHotelsForm.errors.has('date_to')
                                            }"
                                            v-model="searchHotelsForm.date_to" type="date" placeholder="date to" />
                                    </label>
                                    <span class="text-danger"
                                          v-if="searchHotelsForm.errors.has('date_to')"
                                          v-html="searchHotelsForm.errors.get('date_to')">
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <label>adults
                                                <input
                                                    :class="{
                                                        'is-invalid': searchHotelsForm.errors.has('adult')
                                                    }"
                                                    type="number" v-model="searchHotelsForm.adult" placeholder="adults" />
                                            </label>
                                            <span class="text-danger"
                                                  v-if="searchHotelsForm.errors.has('adult')"
                                                  v-html="searchHotelsForm.errors.get('adult')">
                                             </span>
                                        </div>

                                        <div class="mx-2"></div>

                                        <div>
                                            <label>children
                                                <input
                                                    :class="{
                                                    'is-invalid': searchHotelsForm.errors.has('children')
                                                    }"
                                                    min="0" type="number" v-model="searchHotelsForm.children" placeholder="children" />
                                            </label>
                                            <span class="text-danger"
                                                  v-if="searchHotelsForm.errors.has('children')"
                                                  v-html="searchHotelsForm.errors.get('children')">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center col-md-12 col-12">
                                <button type="submit" class="btn button btn-primary">
                                    Search
                                    <span v-if="searchHotelsForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!searchHotelsForm.busy" aria-hidden="true" class="fa fa-search"></i>
                                </button>

                                <button v-if="search" @click="getHotels" type="button" class="btn button btn-danger">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                    <form @submit.prevent="filterHotel()" class="sidefilter-form">
                        <div style="position: sticky;top: 63px; z-index: 2; background: #f8f8f8;">
                            <button class="btn btn-primary">
                                <i class="fa fa-filter"></i>
                                filter
                            </button>
                            <button v-if="filter" @click="getHotels" type="button" class="btn button btn-danger">
                                Cancel
                            </button>
                        </div>

                        <div class="module-travel clearfix">
                            <h3>Price</h3>
                            <VueSimpleRangeSlider
                                style="width: 250px"
                                :min="min_price"
                                :max="max_price"
                                :logarithmic="true"
                                v-model="filterHotelForm.price"
                            />
                        </div>
                        <div class="module-rate clearfix">
                            <h3>star rating</h3>
                            <ul>
                                <li v-for="star in filterHotelForm.stars">
                                    <label class="d-flex align-items-center">
                                        <input @change="starSelected(star)" v-model="star.selected" type="checkbox">
                                        <starRating :star-size="18" :rating="star.star" :show-rating="false" :read-only="true"></starRating>
                                    </label>
                                </li>
                            </ul>

                        </div>
                        <div class="module-rate clearfix">
                            <h3>Cities</h3>
                            <ul>
                                <li v-for="city in filterHotelForm.cities">
                                    <label class="d-flex align-items-center">
                                        <input :checked="filterHotelForm.gov_id.indexOf(city.id) >= 0 ? 'checked' : ''" @change="citySelected(city)" type="checkbox">
                                        <strong>{{city.name}}</strong>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <div class="module-pop clearfix"><h3>popular Hotels</h3>
                        <div class="item clearfix">
                            <div class="image">
                                <a href="tour-detail.html">
                                    <img src="https://demo.wpthemego.com/html/sw_portkey/image/catalog/demo/product/travel/p1.jpg" alt="Bougainvilleas on Lombard Street" class="img-responsive">
                                </a>
                            </div>

                        <div class="content">
                            <h4><a href="tour-detail.html">7-Day Great Britain Tour Packag...</a></h4>
                            <p>from $250</p>
                        </div>
                        </div>
                        <div class="item clearfix"><div class="image"><a href="tour-detail.html"><img src="image/catalog/demo/product/travel/p2.jpg" alt="Bougainvilleas on Lombard Street" class="img-responsive"></a></div> <div class="content"><h4><a href="tour-detail.html">7-Day Great Britain Tour Packag...</a></h4> <p>from $250</p></div></div></div>
                </aside>

                <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                    <router-link to="" class="open-sidebar hidden-lg hidden-md">
                        <i class="fa fa-bars"></i>
                        Sidebar
                    </router-link>
                    <div class="products-category">
                        <div class="product-filter hidden-xs filters-panel">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 hidden-xs">
                                    <div class="list-view">
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
                            </div>
                        </div>

                        <div
                            v-if="hotels.data"
                            :class="gridView ? 'gird': 'list'"
                            class="section-style4 products-list row number-col-3 so-filter-gird">

                            <div v-for="hotel in hotels.data"
                                :class="gridView ? 'col-lg-6 col-md-6 col-sm-6 col-xs-6': 'col-lg-12 col-md-12 col-sm-12 col-xs-12'"
                                class="product-layout ">
                                <div class="product-item-container item">
                                    <div class="item-block so-quickview">
                                        <div class="image">
                                            <router-link :to="'hotel/'+hotel.id" target="_self">
                                                <img :src="hotel.image" :alt="hotel.title_api" class="img-responsive">
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
                                                    from <label>$230</label><span>person</span>
                                                </div>
                                                <router-link :to="'hotel/'+hotel.id" class="book-now btn-quickview quickview quickview_handler pull-right" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">Book now</router-link>
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
import HotelsFilter from "./Hotels/Filter";
import starRating from "vue-star-rating";
import Form from "vform";
import { mapGetters } from 'vuex';
import VueSimpleRangeSlider from 'vue-simple-range-slider';
export default {
    name: 'Hotels',
    components:{
        Breadcrumbs,
        HotelsFilter,
        starRating,
        VueSimpleRangeSlider
    },
    computed: {
        ...mapGetters([
            'searchHotels'
        ]),
    },
    data(){
        return{
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
            min_price: 100,
            max_price: 5000,
            filterHotelForm: new Form({
                price: [100, 5000],
                star_rate: [],
                stars: [{star: 5, selected: false}, {star: 4, selected: false}, {star: 3, selected: false}, {star: 2, selected: false}, {star: 1, selected: false}, {star: 0, selected: false}],
                gov_id: [],
                cities: [],
            })
        }
    },
    watch: {},
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
    },
    methods: {
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
