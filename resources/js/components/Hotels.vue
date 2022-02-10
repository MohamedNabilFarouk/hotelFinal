<template>
    <div>
        <!-- Main Container  -->
        <Breadcrumbs PageTitle="Hotels" PageLink="hotels" backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

        <div class="container product-detail">
            <div class="row">
                <HotelsFilter />
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
                            v-if="hotels.data"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="hotels" @pagination-change-page="getHotels">
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

export default {
    name: 'Hotels',
    components:{
        Breadcrumbs,
        HotelsFilter,
        starRating
    },
        data(){
            return{
                gridView: true,
                hotels: [],
            }
        },
        mounted() {
            this.getHotels();
        },
        methods: {
            getHotels(page = 1){
                axios.get('hotels?page=' + page).then((res)=>{
                    this.hotels = res.data.data ? res.data.data.hotels : [];
                }).catch(() =>{});
            },
            gridViewFun(view){view === 'grid' ? this.gridView = true : this.gridView = false},
        }
    }
</script>
