<template>
    <div>
        <!-- Main Container  -->
        <Breadcrumbs PageTitle="Hotels" PageLink="hotels" backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

        <div class="container product-detail">
            <div class="row">

                <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
                    <span id="close-sidebar" class="fa fa-times"></span>

                    <div class="module-search clearfix">
                        <h3 class="modtitle">Hotel searching</h3>
                        <form @submit.prevent="searchHotel()"
                              class="row py-3 justify-content-between align-items-center">

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
                                <button type="submit" class="btn btn-sm button btn-primary">
                                    Search
                                    <span v-if="searchHotelsForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!searchHotelsForm.busy" aria-hidden="true" class="fa fa-search"></i>
                                </button>

                                <button v-if="search" @click="getHotels" type="button" class="btn btn-sm button btn-danger">
                                    Cancel
                                </button>
                            </div>
                        </form>

                    </div>

                    <HotelsFilter />
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
                            v-if="hotels.data && !search"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="hotels" @pagination-change-page="getHotels">
                            <span class="w-auto" slot="prev-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                            <span slot="next-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </pagination>

                        <pagination
                            v-if="hotels.data && search"
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
export default {
    name: 'Hotels',
    components:{
        Breadcrumbs,
        HotelsFilter,
        starRating
    },
    data(){
        return{
            hotels: this.$route.params.hotels ? this.$route.params.hotels : [],
            search: this.$route.params.search ? this.$route.params.search : false,
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
        }
    },
    mounted() {
        this.search ? this.fillFormData() : this.getHotels();
        this.getCities();
    },
    methods: {
        getCities(){
            axios.get('cities')
                .then((res)=>{
                    this.cities = res.data.data && res.data.data.cities ? res.data.data.cities : [];
                })
                .catch();
        },
        getHotels(page = 1){
            axios.get('hotels?page=' + page).then((res)=>{
                this.hotels = res.data.data ? res.data.data.hotels : [];
                this.search = false;
            }).catch(() =>{});
        },
        fillFormData(){
            this.$route.params.formData ? this.searchHotelsForm.fill(this.$route.params.formData): '';
        },
        getSearchHotels(page = 1){
            this.searchHotelsForm.get('searchHotel?page=' + page).then((res)=>{
                this.hotels = res.data.data ? res.data.data.hotels : [];
                this.search = true;
            }).catch(() =>{});
        },
        gridViewFun(view){view === 'grid' ? this.gridView = true : this.gridView = false},
        searchHotel(){
            this.searchHotelsForm.city =  this.searchHotelsForm.sCity.id ? this.searchHotelsForm.sCity.id : '';
            this.searchHotelsForm.get("searchHotel").then((res)=>{
                if (res.data.success === 'true'){
                    this.hotels = res.data.data && res.data.data.hotels ? res.data.data.hotels : [];
                    this.search = true;
                }else{
                    this.searchHotelsForm.errors.set(res.data.data);
                }
            }).catch(()=>{});
        }

    }
}
</script>
