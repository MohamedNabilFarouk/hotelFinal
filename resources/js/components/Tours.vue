<template>
    <div>
        <!-- Main Container  -->
        <Breadcrumbs PageTitle="Tours" PageLink="tours" backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

        <div class="container product-detail">
            <div class="row">
                <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                    <span id="close-sidebar" class="fa fa-times"></span>

                    <div class="module-rate clearfix">
                        <h3 class="modtitle">Tours searching</h3>
                        <form @submit.prevent="searchTour()"
                              class="row px-4 justify-content-between align-items-center">

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group location-input">
                                    <label>Destinations
                                        <v-select
                                            v-model="searchToursForm.sCity"
                                            :class="{
                                                'is-invalid': searchToursForm.errors.has('city')
                                            }"
                                            autocomplete="on"
                                            placeholder="City, region or anywhere"
                                            :get-option-label="(option) => option.name"
                                            :options="cities"></v-select>
                                    </label>
                                    <span class="text-danger"
                                          v-if="searchToursForm.errors.has('city')"
                                          v-html="searchToursForm.errors.get('city')">
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>date
                                        <input
                                            :class="{
                                                'is-invalid': searchToursForm.errors.has('date')
                                            }"
                                            v-model="searchToursForm.date"
                                            type="date" placeholder="date from" />
                                    </label>
                                    <span class="text-danger"
                                          v-if="searchToursForm.errors.has('date')"
                                          v-html="searchToursForm.errors.get('date')">
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center col-md-12 col-12">
                                <button type="submit" class="btn button btn-primary">
                                    Search
                                    <span v-if="searchToursForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!searchToursForm.busy" aria-hidden="true" class="fa fa-search"></i>
                                </button>

                                <button v-if="search" @click="getTours" type="button" class="btn button btn-danger">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                    <form @submit.prevent="filterTour()" class="sidefilter-form">
                        <div style="position: sticky;top: 63px; z-index: 2; background: #f8f8f8;">
                            <button class="btn btn-primary">
                                <i class="fa fa-filter"></i>
                                filter
                            </button>
                            <button v-if="filter" @click="getTours" type="button" class="btn button btn-danger">
                                Cancel
                            </button>
                        </div>

                        <div class="module-travel clearfix">
                            <h3>Price</h3>
                            <span class="text-danger"
                              v-if="filterToursForm.errors.has('price')"
                              v-html="filterToursForm.errors.get('price')">
                            </span>
                            <div class="d-flex justify-content-between">
                                <div class="form-group mr-1">
                                    <label>min price
                                        <input
                                        :class="{
                                                'is-invalid': filterToursForm.errors.has('price')
                                        }"
                                        :min="min_price"
                                        :max="max_price"
                                        v-model="filterToursForm.price[0]"
                                        type="number" placeholder="date from" />
                                    </label>
                                </div>

                                <div class="form-group ml-1">
                                    <label>max price
                                        <input
                                            :class="{
                                                'is-invalid': filterToursForm.errors.has('price')
                                            }"
                                            :min="min_price"
                                            :max="max_price"
                                            v-model="filterToursForm.price[1]"
                                            type="number" placeholder="date from" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="module-rate clearfix">
                            <h3>star rating</h3>
                            <ul>
                                <li v-for="star in filterToursForm.stars">
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
                                <li v-for="city in filterToursForm.cities">
                                    <label class="d-flex align-items-center">
                                        <input :checked="filterToursForm.gov_id.indexOf(city.id) >= 0 ? 'checked' : ''" @change="citySelected(city)" type="checkbox">
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
                            v-if="tours.data"
                            :class="gridView ? 'gird': 'list'"
                            class="section-style4 products-list row number-col-3 so-filter-gird">

                            <div v-for="tour in tours.data"
                                 :class="gridView ? 'col-lg-6 col-md-6 col-sm-6 col-xs-6': 'col-lg-12 col-md-12 col-sm-12 col-xs-12'"
                                 class="product-layout ">
                                <div class="product-item-container item">
                                    <div class="item-block so-quickview">
                                        <div class="image">
                                            <router-link :to="'tour/'+tour.id" target="_self">
                                                <img :src="tour.image" :alt="tour.title_api" class="img-responsive">
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
                                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> 2 Day</li>
                                                <li><i class="fa fa-user-circle" aria-hidden="true"></i> 4 persons</li>
                                            </ul>
                                            <div class="des">{{tour.content_api}}</div>
                                            <div class="item-bot clearfix">
                                                <div class="price pull-left">
                                                    from <label>$230</label><span>person</span>
                                                </div>
                                                <router-link :to="'tour/'+tour.id" class="book-now btn-quickview quickview quickview_handler pull-right" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">Book now</router-link>
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
            'searchTours'
        ]),
    },
    components:{
        Breadcrumbs,
        HotelsFilter,
        starRating
    },
    data(){
        return{
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
    },
    methods: {
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
