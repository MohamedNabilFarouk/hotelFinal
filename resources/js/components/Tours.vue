<template>
    <div>
        <!-- Main Container  -->
        <Breadcrumbs PageTitle="Tours" PageLink="tours" backgroundImage="https://demo.wpthemego.com/html/sw_portkey/image/breadcrumbs.jpg" />

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
                                <!-- <div class="short-by-show justify-content-end form-inline col-md-10 col-sm-10">
                                    <div class="form-group">
                                        <label class="control-label">Show 1-6 of 8 results</label>
                                    </div>
                                    <div class="form-group short-by">
                                        <select class="form-control w-100">
                                            <option value="" selected="selected">Sort By</option>
                                            <option value="">Name (A - Z)</option>
                                            <option value="">Name (Z - A)</option>
                                            <option value="">Price (Low &gt; High)</option>
                                            <option value="">Price (High &gt; Low)</option>
                                            <option value="">Rating (Highest)</option>
                                            <option value="">Rating (Lowest)</option>
                                            <option value="">Model (A - Z)</option>
                                            <option value="">Model (Z - A)</option>
                                        </select>
                                    </div>

                                </div>-->
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
                            v-if="tours.data"
                            align="center"
                            :showDisabled="true"
                            :limit="5"
                            :data="tours" @pagination-change-page="getTours">
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
    name: 'Tours',
    components:{
        Breadcrumbs,
        HotelsFilter,
        starRating
    },
    data(){
        return{
            gridView: true,
            tours: [],
        }
    },
    mounted() {
        this.getTours();
    },
    methods: {
        getTours(page = 1){
            axios.get('tours?page=' + page).then((res)=>{
                this.tours = res.data.data ? res.data.data.tours : [];
            }).catch(() =>{});
        },
        gridViewFun(view){view === 'grid' ? this.gridView = true : this.gridView = false},
    }
}
</script>
