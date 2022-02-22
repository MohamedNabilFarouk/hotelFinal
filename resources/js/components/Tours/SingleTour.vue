<template>
    <div>
        <div class="image-top">
            <img :src="tour.image" :alt="tour.title_api" class="img-responsive">
        </div>
        <!-- Main Container  -->
        <div class="container product-detail tour-single">
            <div class="row">
                <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                    <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i>Sidebar</a>
                    <div class="detail-content">

                        <div class="sticky-content">
                            <h1>{{tour.type}} - {{tour.title_api}}</h1>
                            <ul class="box-meta">
                                <li>
                                    <starRating
                                        :star-size="15"
                                        :rating="tour.star_rate ? parseInt(tour.star_rate) : 0"
                                        :show-rating="false"
                                        :read-only="true"></starRating>
                                </li>
                            </ul>
                            <div class="top-tab" id="nav">
                                <ul class="nav nav-tabs">
                                    <li><a href="#gallery">gallery</a></li>
                                    <li><a href="#tour_content">content</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-tabs">
                            <div class="tab-content m-0" id="gallery">
                                <h3>Gallery</h3>
                                <Gallery v-if="tour.gallery && tour.gallery.length > 0" :images="tour.gallery" />
                            </div>

                            <div class="tab-content m-0" id="tour_content">
                                <h3>Content</h3>
                                {{tour.content_api}}
                            </div>


                            <div class="tab-content">
                                <p id="home">
                                </p>
                                <ul class="location-wee clearfix">
                                    <li>
                                        <label>address</label>
                                        <div class="item">{{tour.address_api}}</div>
                                    </li>
                                    <li>
                                        <label>min people</label>
                                        <div class="item">{{tour.min_people}} person</div>
                                    </li>
                                    <li>
                                        <label>max people</label>
                                        <div class="item">{{tour.max_people}} person</div>
                                    </li>
                                    <li>
                                        <label>min day befor booking</label>
                                        <div class="item">{{tour.min_day_befor_booking}} day</div>
                                    </li>
                                    <li>
                                        <label>Prices</label>
                                        <div class="item">
                                            <div class="info">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                {{ tour.price ? tour.price_api.price : "" }}/person
                                            </div>
                                            <div class="info">
                                                <i class="fa fa-child" aria-hidden="true"></i>
                                                {{ tour.price ? tour.price_api.ch_price : "" }}/child
                                            </div>
                                        </div>
                                    </li>
                                </ul>



                                <div id="menu4" class="tour-review">
                                    <h3>Review</h3>
                                    <form method="post" class="clearfix">
                                        <div class="image"><img src="image/profile.png" alt="" class="img-responsive"></div>
                                        <div class="content-right">
                                            <textarea name="comment" placeholder="What are you thoughts about this tour?" id="comment" class="input-block-level" rows="4" tabindex="4" aria-required="true"></textarea>
                                            <div class="rate">
                                                <label>Your rate:</label><div class="star"><span style="width: 0px"></span></div>
                                            </div>
                                            <input name="submit" type="submit" id="submit" class="submit" value="Send Review">
                                        </div>
                                    </form>
                                    <div class="comment clearfix">
                                        <div class="item clearfix">
                                            <div class="image"><img src="image/profile2.png" alt="" class="img-responsive"></div>
                                            <div class="info">
                                                <div class="name">
                                                    <div class="rate pull-left">
                                                        <label>John wich</label><div class="star"><span style="width: 80px"></span></div>
                                                    </div>
                                                    <span class="pull-right">14 Jully 2018</span>
                                                </div>
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image"><img src="image/profile2.png" alt="" class="img-responsive"></div>
                                            <div class="info">
                                                <div class="name">
                                                    <div class="rate pull-left">
                                                        <label>John wich</label><div class="star"><span style="width: 80px"></span></div>
                                                    </div>
                                                    <span class="pull-right">14 Jully 2018</span>
                                                </div>
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image"><img src="image/profile2.png" alt="" class="img-responsive"></div>
                                            <div class="info">
                                                <div class="name">
                                                    <div class="rate pull-left">
                                                        <label>John wich</label><div class="star"><span style="width: 80px"></span></div>
                                                    </div>
                                                    <span class="pull-right">14 Jully 2018</span>
                                                </div>
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
                    <span id="close-sidebar" class="fa fa-times"></span>
                    <div class="module-search2 clearfix">
                        <h3 class="modtitle">
                            <label>{{ tour.price ? tour.price_api.price : "" }}</label><span>person</span>
                            <label>{{ tour.price ? tour.price_api.ch_price : "" }}</label><span>child</span>
                        </h3>

                        <form @submit.prevent="showCheckinModal" class="search-pr">

                            <div class="form-group">
                                <label>date from
                                    <input
                                        :class="{
                                        'is-invalid': bookingTourForm.errors.has('from')
                                    }"
                                        v-model="bookingTourForm.from"
                                        type="date" placeholder="date from" />
                                </label>
                                <span class="text-danger"
                                      v-if="bookingTourForm.errors.has('from')"
                                      v-html="bookingTourForm.errors.get('from')">
                                </span>
                            </div>

                            <div class="form-group">
                                <label>date to
                                    <input
                                        :class="{
                                        'is-invalid': bookingTourForm.errors.has('to')
                                    }"
                                        v-model="bookingTourForm.to" type="date" placeholder="date to" />
                                </label>
                                <span class="text-danger"
                                      v-if="bookingTourForm.errors.has('to')"
                                      v-html="bookingTourForm.errors.get('to')">
                                </span>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <label>adults
                                            <input
                                                :class="{
                                                'is-invalid': bookingTourForm.errors.has('adult')
                                                }"
                                                min="0"
                                                type="number" v-model="bookingTourForm.adult" placeholder="adults" />
                                        </label>
                                        <span class="text-danger"
                                              v-if="bookingTourForm.errors.has('adult')"
                                              v-html="bookingTourForm.errors.get('adult')">
                                     </span>
                                    </div>

                                    <div class="mx-2"></div>

                                    <div>
                                        <label>children
                                            <input
                                                :class="{
                                                'is-invalid': bookingTourForm.errors.has('child')
                                                }"
                                                min="0" type="number" v-model="bookingTourForm.child" placeholder="children" />
                                        </label>
                                        <span class="text-danger"
                                              v-if="bookingTourForm.errors.has('child')"
                                              v-html="bookingTourForm.errors.get('child')">
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div v-if="bookingTourForm.from && bookingTourForm.to && bookingTourForm.adult">
                                <hr>
                                <h4>
                                    children prices:
                                    {{parseInt(bookingTourForm.child) * parseFloat(tour.price_api.ch_price).toFixed(2) * parseInt(diffDate(bookingTourForm.from, bookingTourForm.to))}}
                                </h4>
                                <h4>Adult prices: {{parseInt(bookingTourForm.adult) * parseFloat(tour.price_api.price).toFixed(2) * parseInt(diffDate(bookingTourForm.from, bookingTourForm.to))}}</h4>

                                <h4>Days: {{diffDate(bookingTourForm.from, bookingTourForm.to)}}</h4>
                                <h4>Total: {{total_price(bookingTourForm.child, bookingTourForm.adult, tour.price_api.ch_price, tour.price_api.price, diffDate(bookingTourForm.from, bookingTourForm.to))}}</h4>
                                <hr>

                                <div class="text-center">
                                    <button class="btn btn-primary">
                                        book now
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="module-why clearfix">
                        <h3>Why should travel with us?</h3>
                        <ul>
                            <li><i class="fa fa-usd" aria-hidden="true"></i>No-hassle best price guarantee</li>
                            <li><i class="fa fa-star" aria-hidden="true"></i>Hand-picked Tours & Activities</li>
                            <li><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Passenger service 24/7</li>
                            <li><i class="fa fa-user" aria-hidden="true"></i>Professional tour guide</li>
                        </ul>
                    </div>
                    <div class="module-ques clearfix">
                        <h3>get a questions</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem que laudantium.</p>
                        <ul>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>+1 2618 181 612</li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i>travelsp@gmail.com</li>
                        </ul>
                    </div>
                    <div class="module-pop clearfix">
                        <h3>popular tours</h3>
                        <div class="item clearfix">
                            <div class="image">
                                <a href="tour-detail.html"><img src="image/catalog/demo/product/travel/p1.jpg" alt="Bougainvilleas on Lombard Street" class="img-responsive"></a>
                            </div>
                            <div class="content">
                                <h4><a href="tour-detail.html">7-Day Great Britain Tour Packag...</a></h4>
                                <p>from $250</p>
                            </div>
                        </div>
                        <div class="item clearfix">
                            <div class="image">
                                <a href="tour-detail.html"><img src="image/catalog/demo/product/travel/p2.jpg" alt="Bougainvilleas on Lombard Street" class="img-responsive"></a>
                            </div>
                            <div class="content">
                                <h4><a href="tour-detail.html">7-Day Great Britain Tour Packag...</a></h4>
                                <p>from $250</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        <!-- //Main Container -->
        <CheckinModal :bookingTourForm="bookingTourForm" />
    </div>
</template>
<script>
import starRating from "vue-star-rating";
import Gallery from "../Layouts/Gallery";
import Form from "vform";
import {mapGetters} from "vuex";
import CheckinModal from "./CheckinModal"
export default {
    name: 'SingleTour',
    props: {
        // PageTitle: {type: String, default:  () => ('')},
    },
    components:{
        starRating, Gallery, CheckinModal
    },
    computed: {
        ...mapGetters(['searchTours', 'user']),
    },
    data(){
        return{
            id: this.$route.params.id,
            tour: {},
            bookingTourForm: new Form({
                name: "",
                email: "",
                phone: "",
                e164Phone: "",
                country: "",
                vendor_id: "",
                type: "tour", // hotel , tour
                tour: {},
                customer_id: "", //from auth
                object_id: this.$route.params.id, // hotel id
                from: "", // date from
                to: "", // date to
                adult: 2,
                child: 0,
                total: "", // price * no. of rooms*nights if hotel // if tour person no * person price
                deposit: 0, // دفع جزئي (x%) (total*x/100)
                note: "",
                is_paid: 0,
                partial_payment: 0, //
                paid: "",
                city: '',
                sCity: '',
                date_from: '',
                date_to: '',
                children: 0,
            }),

        }
    },
    mounted() {
        this.getTour();
    },
    methods: {
        showCheckinModal(){
            if (this.user){
                this.bookingTourForm.name = this.user.name;
                this.bookingTourForm.email = this.user.email;
                this.bookingTourForm.phone = this.user.phone;
                this.bookingTourForm.e164Phone = this.user.phone;
                this.bookingTourForm.country = this.user.country;
                this.bookingTourForm.customer_id = this.user.id;
            }
            this.bookingTourForm.tour = this.tour;
            // this.bookingTourForm.child = this.bookingHotelForm.children;
            // this.bookingTourForm.from = this.bookingHotelForm.date_from;
            // this.bookingTourForm.to = this.bookingHotelForm.date_to;
            this.bookingTourForm.deposit = 0;
            this.bookingTourForm.vendor_id = this.tour.vendor_id;
            this.$modal.show('bookingModal');
        },
        getTour(){
            axios.post('tour', {id: this.id}).then((res)=>{
                this.tour = res.data.data && res.data.data.tour ? res.data.data.tour : {};
            }).catch(() =>{});
        },
        diffDate(date1, date2){
            const a = moment(date1);
            const b = moment(date2);
            return b.diff(a, 'days') + 1;
        },
        total_price(child_number, adult_number, child_price, adult_price, diffDate){
            const child_prices = parseInt(child_number) * parseFloat(child_price).toFixed(2) * parseInt(diffDate);
            const adult_prices = parseInt(adult_number) * parseFloat(adult_price).toFixed(2) * parseInt(diffDate);
            this.bookingTourForm.total = child_prices + adult_prices;
            this.bookingTourForm.paid = child_prices + adult_prices;
            return child_prices + adult_prices;
        }
    }
}
</script>
