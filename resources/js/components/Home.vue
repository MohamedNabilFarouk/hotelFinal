<template>
    <div>
        <Slider :tours="slider_tours" :hotels="slider_hotels" :cities="slider_governorates" />
        <Search />
        <Hotels :hotels="hotels" />
        <Tours :tours="tours" />
        <BannerVideo video="BapSQFJPMM0" backgroundImage="https://d3jmn01ri1fzgl.cloudfront.net/photoadking/webp_thumbnail/6068378361475_json_image_1617442691.webp" />
        <Spaces :spaces="spaces" />

<!--        <section class="section-home2-style6">-->
<!--            <div class="container page-builder-ltr">-->
<!--                <div class="row row-style row_a1">-->
<!--                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c">-->
<!--                        <div class="module so-deals-1tr so-deals">-->
<!--                            <div class="head-title clearfix">-->
<!--                                <div class="block-title pull-left">-->
<!--                                    <h3><span>Travel tips</span></h3>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="module custom-ourblog2 clearfix default-nav">-->
<!--                                <div class="modcontent">-->
<!--                                    <div id="so_latest_blog_1" class="so-blog-external button-type2 button-type2">-->
<!--                                        <div class="category-slider-inner products-list yt-content-slider blog-external clearfix " data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">-->
<!--                                            <div class="media">-->
<!--                                                <div class="item head-button">-->
<!--                                                    <div class="content-detail">-->
<!--                                                        <div class="media-content so-block">-->
<!--                                                            <h4 class="media-heading head-item">-->
<!--                                                                <a href="blog-detail.html" title="Aestibulum ipsum a ornare car" >The 7 Best Ways To Travel Around Europe Cheap</a>-->
<!--                                                            </h4>-->
<!--                                                            <div class="entry-meta clearfix">-->
<!--                                                                <div class="entry-date font-ct date-bottom">-->
<!--                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>11/11/2019-->
<!--                                                                </div>-->
<!--                                                                <div class="entry-comment">-->
<!--                                                                    <i class="fa fa-commenting" aria-hidden="true"></i>2 Comments-->
<!--                                                                </div>-->
<!--                                                                <div class="entry-social">-->
<!--                                                                    <i class="fa fa-share-alt" aria-hidden="true"></i><a href="#">Share</a>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="description">-->
<!--                                                                Traveling around Europe can be fairly expensive. Airline tickets, high-speed trains, overnight trains, ferries they can all eat into your limited and precious travel budget.  I mean, you came to spend money on delicious...-->
<!--                                                            </div>-->
<!--                                                            <div class="readmore">-->
<!--                                                                <a href="blog-detail.html" >Read more</a>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="content-img">-->
<!--                                                        <a href="#" >-->
<!--                                                            <img src="image/catalog/demo/blog/blogh21.jpg" alt="Aestibulum ipsum a ornare car" width="670" height="477">-->
<!--                                                        </a>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="media">-->
<!--                                                <div class="item head-button">-->
<!--                                                    <div class="content-detail">-->
<!--                                                        <div class="media-content so-block">-->
<!--                                                            <h4 class="media-heading head-item">-->
<!--                                                                <a href="blog-detail.html" title="Aestibulum ipsum a ornare car" >The 7 Best Ways To Travel Around Europe Cheap</a>-->
<!--                                                            </h4>-->
<!--                                                            <div class="entry-meta clearfix">-->
<!--                                                                <div class="entry-date font-ct date-bottom">-->
<!--                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>11/11/2019-->
<!--                                                                </div>-->
<!--                                                                <div class="entry-comment">-->
<!--                                                                    <i class="fa fa-commenting" aria-hidden="true"></i>2 Comments-->
<!--                                                                </div>-->
<!--                                                                <div class="entry-social">-->
<!--                                                                    <i class="fa fa-share-alt" aria-hidden="true"></i><a href="#">Share</a>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="description">-->
<!--                                                                Traveling around Europe can be fairly expensive. Airline tickets, high-speed trains, overnight trains, ferries they can all eat into your limited and precious travel budget.  I mean, you came to spend money on delicious...-->
<!--                                                            </div>-->
<!--                                                            <div class="readmore">-->
<!--                                                                <a href="blog-detail.html" >Read more</a>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="content-img">-->
<!--                                                        <a href="#" >-->
<!--                                                            <img src="image/catalog/demo/blog/blogh22.jpg" alt="Aestibulum ipsum a ornare car" width="670" height="477">-->
<!--                                                        </a>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="media">-->
<!--                                                <div class="item head-button">-->
<!--                                                    <div class="content-detail">-->
<!--                                                        <div class="media-content so-block">-->
<!--                                                            <h4 class="media-heading head-item">-->
<!--                                                                <a href="blog-detail.html" title="Aestibulum ipsum a ornare car" >The 7 Best Ways To Travel Around Europe Cheap</a>-->
<!--                                                            </h4>-->
<!--                                                            <div class="entry-meta clearfix">-->
<!--                                                                <div class="entry-date font-ct date-bottom">-->
<!--                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>11/11/2019-->
<!--                                                                </div>-->
<!--                                                                <div class="entry-comment">-->
<!--                                                                    <i class="fa fa-commenting" aria-hidden="true"></i>2 Comments-->
<!--                                                                </div>-->
<!--                                                                <div class="entry-social">-->
<!--                                                                    <i class="fa fa-share-alt" aria-hidden="true"></i><a href="#">Share</a>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                            <div class="description">-->
<!--                                                                Traveling around Europe can be fairly expensive. Airline tickets, high-speed trains, overnight trains, ferries they can all eat into your limited and precious travel budget.  I mean, you came to spend money on delicious...-->
<!--                                                            </div>-->
<!--                                                            <div class="readmore">-->
<!--                                                                <a href="blog-detail.html" >Read more</a>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="content-img">-->
<!--                                                        <a href="#" >-->
<!--                                                            <img src="image/catalog/demo/blog/blogh23.jpg" alt="Aestibulum ipsum a ornare car" width="670" height="477">-->
<!--                                                        </a>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->

    </div>
</template>

<script>
import Slider from "./HomePage/Slider";
import Search from "./HomePage/Search";
import Hotels from "./HomePage/Hotels";
import Tours from "./HomePage/Tours";
import BannerVideo from  "./HomePage/BannerVideo";
import Spaces from  "./HomePage/Spaces";
export default {
    name: 'Home',
    components:{
        Slider,
        Search,
        Hotels,
        Tours,
        BannerVideo,
        Spaces
    },
    data(){
        return{
            hotels: [],
            tours: [],
            spaces: [],
            slider_tours: [],
            slider_hotels: [],
            slider_governorates: [],
        }
    },
    mounted() {
        axios.get('home').then((res)=>{
            this.hotels = res.data.data ? res.data.data.hotels : [];
            this.tours = res.data.data ? res.data.data.tours : [];
            this.spaces = res.data.data ? res.data.data.spaces : [];
            this.slider_tours = res.data.data ? res.data.data.slider_tours : [];
            this.slider_hotels = res.data.data ? res.data.data.slider_hotels : [];
            this.slider_governorates = res.data.data ? res.data.data.slider_governorates : [];
        }).catch();
    },
    methods: {
    }
}
</script>
