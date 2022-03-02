<template>
    <div>
        <div class="image-top">
            <vue-load-image>
                <img slot="image" :src="tour.image" :alt="tour.title_api" class="img-responsive" />
                <img slot="preloader" src="../../../assets/loading.gif">
                <img slot="error" src="../../../assets/no_image.png">
            </vue-load-image>
        </div>

        <!-- Main Container  -->
        <div class="container product-detail tour-single">
            <div class="row">
                <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                    <div class="detail-content">

                        <div class="sticky-content">
                            <h1>{{$t(tour.type)}} - {{tour.title_api}}</h1>
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
                                    <li><a class="text-capitalize" @click.prevent="scrollToSection('gallery')" href="#gallery">{{$t('gallery')}}</a></li>
                                    <li><a class="text-capitalize" @click.prevent="scrollToSection('tour_content')" href="#tour_content">{{$t('content')}}</a></li>
                                    <li v-if="tour.map"><a class="text-capitalize" @click.prevent="scrollToSection('maps')" href="#maps">{{$t('map')}}</a></li>
<!--                                    <li><a @click.prevent="" href="#review">Review</a></li>-->
                                    <li  @click.prevent="toggleSideBar()" class="ms-auto text-capitalize d-block d-md-none">
                                        <a @click.prevent="" href="#">{{$t('checkin')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-tabs">
                            <div class="tab-content m-0" id="gallery">
                                <h3>{{ $t('gallery') }}</h3>
                                <Gallery v-if="tour.gallery && tour.gallery.length > 0" :images="tour.gallery" />
                            </div>

                            <div class="tab-content m-0" id="tour_content">
                                <h3>{{$t('content')}}</h3>
                                {{tour.content_api}}
                            </div>


                            <div class="tab-content">
                                
                                <ul class="location-wee clearfix">
                                    <li>
                                        <label>{{$t('address')}}</label>
                                        <div class="item">{{tour.address_api}}</div>
                                    </li>
                                    <!--
                                    <li>
                                        <label>min people</label>
                                        <div class="item">{{tour.min_people}} person</div>
                                    </li> 
                                    <li>
                                        <label>max people</label>
                                        <div class="item">{{tour.max_people}} person</div>
                                    </li>-->
                                    <li>
                                        <label>{{$t('min day befor booking')}}</label>
                                        <div class="item">{{tour.min_day_befor_booking}} day</div>
                                    </li>
                                
                                    <li>
                                        <label>{{$t('adult prices')}}</label>
                                        <div class="item"><i class="fa fa-user" aria-hidden="true"></i>
                                            {{ tour.price ? cahangePrice(tour.price_api.price) : "" }}{{ currency ? $t(currency.abbr) : $t("LE")}}/{{$t('person')}}                                            
                                        </div>
                                    </li>

                                    <li>
                                        <label>{{$t('child prices')}}</label>
                                        <div class="item"><i class="fa fa-user" aria-hidden="true"></i>
                                            {{ tour.price ? cahangePrice(tour.price_api.ch_price) : "" }}{{ currency ? $t(currency.abbr) : $t("LE")}}/{{$t('child')}}                                            
                                        </div>
                                    </li>
                                    <li>
                                        <label>{{$t('child prices')}}</label>
                                        <div class="item"><i class="fa fa-user" aria-hidden="true"></i>
                                            {{ tour.price ? cahangePrice(tour.price_api.ch_price) : "" }}{{ currency ? $t(currency.abbr) : $t("LE")}}/{{$t('child')}}                                            
                                        </div>
                                    </li>
                                </ul>


                                <!--
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
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

                <aside :class="sideBar ? 'active' : ''" class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
                    <span @click.prevent="toggleSideBar()" id="close-sidebar" class="fa fa-times"></span>
                    <div class="module-search mt-2 clearfix">
                        <h3 class="modtitle">
                            <span style="color: #d89939;">{{ tour.price_api ? cahangePrice(tour.price_api.price) : "" }}{{ currency ? $t(currency.abbr) : $t("LE") }}</span><label>/{{ $t('person') }}</label><br>
                            <span style="color: #d89939;">{{ tour.price_api ? cahangePrice(tour.price_api.ch_price) : "" }}{{ currency ? $t(currency.abbr) : $t("LE") }}</span><label>/{{ $t('child') }}</label>
                        </h3>

                        <form @submit.prevent="showCheckinModal" class="search-pr">
                            <div class="mb-3">
                                <label for="date_from" class="form-label text-capitalize">{{$t('date from')}}</label>
                                <vuejs-datepicker :disabledDates="disabledTodayDates" :format="customFormatter"  v-model="bookingTourForm.from" :placeholder="$t('date from')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': bookingTourForm.errors.has('from')}"></vuejs-datepicker>
                                <div class="invalid-feedback"
                                     v-if="bookingTourForm.errors.has('from')"
                                     v-html="bookingTourForm.errors.get('from')">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="date_to" class="form-label text-capitalize">{{$t('date to')}}</label>
                                <vuejs-datepicker :disabledDates="disabledTodayDates" :format="customFormatter"  v-model="bookingTourForm.to" :placeholder="$t('date to')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': bookingTourForm.errors.has('to')}"></vuejs-datepicker>
                                <div class="invalid-feedback"
                                     v-if="bookingTourForm.errors.has('to')"
                                     v-html="bookingTourForm.errors.get('to')">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-3">
                                    <label for="adults" class="form-label text-capitalize">{{$t('adults')}}</label>
                                    <input type="number" :class="{'is-invalid': bookingTourForm.errors.has('adult')}" v-model="bookingTourForm.adult" class="form-control" id="adults" :placeholder="$t('adults')">
                                    <div class="invalid-feedback"
                                         v-if="bookingTourForm.errors.has('adult')"
                                         v-html="bookingTourForm.errors.get('adult')">
                                    </div>
                                </div>

                                <div class="mx-2"></div>

                                <div class="mb-3">
                                    <label for="children" class="form-label text-capitalize">{{$t('children')}}</label>
                                    <input type="number" :class="{'is-invalid': bookingTourForm.errors.has('child')}" v-model="bookingTourForm.child" class="form-control" id="children" :placeholder="$t('children')">
                                    <div class="invalid-feedback"
                                         v-if="bookingTourForm.errors.has('child')"
                                         v-html="bookingTourForm.errors.get('child')">
                                    </div>
                                </div>
                            </div>

                            <div v-if="bookingTourForm.from && bookingTourForm.to && bookingTourForm.adult">
                                <hr>
                                <strong class="text-capitalize">{{ $t('children prices') }}:</strong>
                                {{cahangePrice(parseInt(bookingTourForm.child) * parseFloat(tour.price_api.ch_price).toFixed(2) * parseInt(diffDate(bookingTourForm.from, bookingTourForm.to)))}}{{ currency ? $t(currency.abbr) : $t("LE") }}<br>
                                
                                <strong class="text-capitalize">{{ $t('adult prices') }}:</strong>
                                {{cahangePrice(parseInt(bookingTourForm.adult) * parseFloat(tour.price_api.price).toFixed(2) * parseInt(diffDate(bookingTourForm.from, bookingTourForm.to)))}}{{ currency ? $t(currency.abbr) : $t("LE") }}<br>

                                <strong class="text-capitalize">{{ $t('days') }}:</strong> {{diffDate(bookingTourForm.from, bookingTourForm.to)}}<br>

                                <strong class="text-capitalize">{{ $t('total_price') }}:</strong>
                                {{cahangePrice(total_price(bookingTourForm.child, bookingTourForm.adult, tour.price_api.ch_price, tour.price_api.price, diffDate(bookingTourForm.from, bookingTourForm.to)))}}{{ currency ? $t(currency.abbr) : $t("LE") }}<br>
                                <hr>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-info">
                                        {{$t('book now')}}
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
        ...mapGetters(['searchTours', 'user', 'currency']),
    },
    data(){
        return{
            sideBar: false,
            disabledTodayDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledTomorrowDates: {
                to: new Date(Date.now())
            },
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
        customFormatter(date) {
            return moment(date).format('DD-MM-YYYY');
        },
        toggleSideBar(){
            this.sideBar = this.sideBar === false;
        },
        scrollToSection(section){
          const sec = document.getElementById(section).offsetTop;
          const number = section === 'hotel_content' ? 190 : 160;
            if (sec){
                window.scrollTo({
                    top: sec - number,
                    behavior: "smooth"
                });
            }
        },
        cahangePrice(price){
            if(this.currency){
                return parseFloat(parseFloat(price).toFixed(2) / parseFloat(this.currency.ex_rate).toFixed(2)).toFixed(2);
            }else{
                return parseFloat(price).toFixed(2);
            }
        },
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
            this.bookingTourForm.from = moment(this.bookingTourForm.from).format('YYYY-MM-DD');
            this.bookingTourForm.to = moment(this.bookingTourForm.to).format('YYYY-MM-DD');
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
