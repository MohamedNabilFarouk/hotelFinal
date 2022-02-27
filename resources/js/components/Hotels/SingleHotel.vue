<template>
    <div>
        <div v-if="loading" class="ovely-loading">
            <div class="image">
                <vue-load-image>
                    <img slot="image" src="../../../assets/loading.gif" />
                    <img slot="preloader" src="../../../assets/loading.gif">
                    <img slot="error" src="../../../assets/no_image.png">
                </vue-load-image>
            </div>
        </div>
        <div v-if="!loading && hotel.rooms && hotel.rooms.length >= 0">
        <div class="image-top">
            <vue-load-image>
                <img slot="image" :src="hotel.image" :alt="hotel.title_api" class="img-responsive" />
                <img slot="preloader" src="../../../assets/loading.gif">
                <img slot="error" src="../../../assets/no_image.png">
            </vue-load-image>
        </div>
        <!-- Main Container  -->
        <div  class="container product-detail tour-single">
            <div class="row">
                <div id="content" class="col-md-9 col-sm-12 col-xs-12">

                    <div class="detail-content">
                        <div class="sticky-content">
                            <h1>{{hotel.title_api}}</h1>
                            <ul class="box-meta">
                                <li>
                                    <starRating
                                        :star-size="15"
                                        :rating="hotel.star_rate ? parseInt(hotel.star_rate) : 0"
                                        :show-rating="false"
                                        :read-only="true"></starRating>
                                </li>
                            </ul>
                            <div class="top-tab" id="nav">
                                <ul class="nav nav-tabs">
                                    <li><a @click.prevent="scrollToSection('gallery')" href="#gallery">{{$t('gallery')}}</a></li>
                                    <li><a @click.prevent="scrollToSection('hotel_content')" href="#hotel_content">{{$t('content')}}</a></li>
                                    <li><a @click.prevent="scrollToSection('rooms')" href="#rooms">{{$t('rooms')}}</a></li>
                                    <li v-if="hotel.map"><a @click.prevent="scrollToSection('maps')" href="#maps">{{$t('map')}}</a></li>
<!--                                    <li><a @click.prevent="" href="#review">Review</a></li>-->
                                    <li @click.prevent="toggleSideBar()" class="ms-auto d-block d-md-none">
                                        <a @click.prevent="" href="#"><i class="fa fa-bars"></i> {{$t('checkin')}}
                                            <sup class="text-danger p-0">{{total_rooms}}</sup>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-tabs">
                            <div class="tab-content m-0" id="gallery" ref="gallery">
                                <h3>{{$t('gallery')}}</h3>
                                <Gallery v-if="hotel.gallery && hotel.gallery.length > 0" :images="hotel.gallery" />
                            </div>

                            <div class="tab-content m-0" id="hotel_content" ref="hotel_content">
                                <h3>{{$t('content')}}</h3>
                                {{hotel.content_api}}
                            </div>

                            <div class="tab-content m-0 products-category" ref="rooms" id="rooms">
                                <h3>{{$t('rooms')}}</h3>
                                <div v-if="hotel.rooms && hotel.rooms.length > 0">

                                    <div v-for="room in hotel.rooms" :key="room.id" class="hotel-rooms shadow mb-3 rounded border">

                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-4 col-12">
                                                <Gallery v-if="room.room.gallery && room.room.gallery.length > 0" :images="room.room.gallery" />

                                                <!-- <img :src="room.image" :alt="room.title_api" class="img-responsive"> -->
                                            </div>

                                            <div class="col-md-5 col-12">
                                                <div class="p-2">
                                                    <h3>{{room.room.title_api}}</h3>

                                                    <ul class="d-inline-flex">
                                                        <li :title="$t('size')"><i class="fa fa-arrows-alt"></i> {{room.room.size}} {{$t('m')}}<sup>2</sup></li>
                                                        <li :title="$t('bed')"><i class="fa fa-bed"></i> {{room.room.bed}}</li>
                                                        <li :title="$t('adults')"><i class="fa fa-user"></i> {{room.room.adult}}</li>
                                                        <li :title="$t('child')"><i class="fa fa-child"></i> {{room.room.child}}</li>
                                                        <li :title="$t('bathroom')"><i class="fa fa-bath"></i> {{room.room.bathroom}}</li>
                                                    </ul>
                                                    <div class="des">{{room.room.content_api}}</div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12 ">
                                                <div class="text-md-center p-2 text-sm-start">
                                                    <div class="price">
                                                        <h3>{{room.room.main_price}}/{{$t('night')}}</h3>
                                                        <strong>{{room.room.adult}} {{$t('adult')}}</strong> | <strong>{{room.room.child}} {{$t('child')}}</strong><br>
                                                        <strong v-if="searchHotels">{{ $t('available') }}: {{ room.av_number }} {{ $t('room') }}</strong>
                                                        <strong v-if="!searchHotels">{{ $t('room number') }}: {{ room.av_number }} {{ $t('room') }}</strong>
                                                    </div>
                                                </div>

                                                <form class="px-2 mb-3" v-if="!bookingHotelForm.rooms.some(r => r.id === room.room.id)"
                                                      @submit.prevent="addRoomToBookingHotelForm(room)">

                                                    <div v-if="room.room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                                        {{$t('please check date from and date to from checkin')}}.
                                                        <br>
                                                        <div v-if="room.room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                                            {{checkAvailabilityForm.errors.get('from')}}
                                                        </div>
                                                        <br>
                                                        <div v-if="room.room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                                            {{checkAvailabilityForm.errors.get('to')}}
                                                        </div>
                                                    </div>

                                                    <div v-if="room.room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('number')" class="invalid-feedback">
                                                        {{$t('this room only available')}}: {{checkAvailabilityForm.errors.get('number')}}.
                                                    </div>
                                                    <div v-if="room.room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('diffDate')" class="invalid-feedback">
                                                        {{$t('please check date from and date to from checkin')}}.
                                                    </div>

                                                    <div class="input-group">
                                                        <input
                                                            :id="'number'+ room.room.id"
                                                            value="1"
                                                            style="height: 31px;"
                                                            min="1" type="number"
                                                            class="form-control" :placeholder="$t('room number')">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-info" type="submit">
                                                                <i class="fa fa-plus-circle"></i>
                                                                {{$t('checkin')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="hotel.map" class="tab-content m-0" ref="maps" id="maps">
                                <div class="tour-map">
                                    <h3>{{$t('Map Located')}}</h3>
                                    <div  v-html="hotel.map"></div>
                                </div>
                            </div>

                            <!--
                            <div class="tab-content m-0" ref="review" id="review">
                                <div class="tour-review">
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
                            -->
                        </div>
                    </div>
                </div>

                <aside :class="sideBar ? 'active' : ''" class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
                    <span @click.prevent="toggleSideBar()" id="close-sidebar" class="fa fa-times"></span>
                    <div class="module-search mt-2 clearfix">
                        <h3 class="modtitle">{{ $t('checkin') }}</h3>
                        <form @submit.prevent="showCheckinModal()" class="search-pr">

                            <div class="mb-3">
                                <label for="date_from" class="form-label text-capitalize">{{$t('date from')}}</label>
                                <vuejs-datepicker :disabledDates="disabledTodayDates" :format="customFormatter"  v-model="bookingHotelForm.date_from" :placeholder="$t('date from')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': bookingHotelForm.errors.has('date_from')}"></vuejs-datepicker>
                                <div class="invalid-feedback"
                                     v-if="bookingHotelForm.errors.has('date_from')"
                                     v-html="bookingHotelForm.errors.get('date_from')">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="date_to" class="form-label text-capitalize">{{$t('date to')}}</label>
                                <vuejs-datepicker :disabledDates="disabledTomorrowDates" :format="customFormatter"  v-model="bookingHotelForm.date_to" :placeholder="$t('date to')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': bookingHotelForm.errors.has('date_to')}"></vuejs-datepicker>
                                <div class="invalid-feedback"
                                     v-if="bookingHotelForm.errors.has('date_to')"
                                     v-html="bookingHotelForm.errors.get('date_to')">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-3">
                                    <label for="adults" class="form-label text-capitalize">{{$t('adults')}}</label>
                                    <input type="number" :class="{'is-invalid': bookingHotelForm.errors.has('adult')}" v-model="bookingHotelForm.adult" class="form-control" id="adults" :placeholder="$t('adults')">
                                    <div class="invalid-feedback"
                                         v-if="bookingHotelForm.errors.has('adult')"
                                         v-html="bookingHotelForm.errors.get('adult')">
                                    </div>
                                </div>

                                <div class="mx-2"></div>

                                <div class="mb-3">
                                    <label for="children" class="form-label text-capitalize">{{$t('children')}}</label>
                                    <input type="number" :class="{'is-invalid': bookingHotelForm.errors.has('children')}" v-model="bookingHotelForm.children" class="form-control" id="children" :placeholder="$t('children')">
                                    <div class="invalid-feedback"
                                         v-if="bookingHotelForm.errors.has('children')"
                                         v-html="bookingHotelForm.errors.get('children')">
                                    </div>
                                </div>
                            </div>

                            <div v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length === 0">
                                <strong>{{$t('choose rooms to checkin')}}</strong>
                            </div>

                            <div v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0" class="form-group">
                                <h3 class="mb-1 py-1 border-bottom border-top">{{$t('rooms')}}</h3>

                                <div v-for="(room, index) in bookingHotelForm.rooms" :key="room.id"
                                    class="media mb-3 border-bottom align-items-center justify-content-between">
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <strong class="mt-2 text-center">{{room.title_api}}</strong>
                                        </div>
                                        <div class="form-group">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-6">
                                                    <strong>{{$t('adults')}}: {{room.adult}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong>{{$t('children')}}: {{room.child}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="room_number" class="form-label text-capitalize">{{$t('room number')}}</label>
                                                        <input type="number" min="1" :max="room.maxNumber" v-model="room.number" class="form-control" id="room_number" :placeholder="$t('room number')">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="mb-1">
                                                        <label for="room_price" class="form-label text-capitalize">{{$t('room price')}}</label>
                                                        <input type="text" min="1" :max="room.maxNumber" :value="parseFloat(room.price).toFixed(2) + '/Night'" class="form-control" id="room_price" :placeholder="$t('room price')" disabled />
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-between">
                                                    <strong>{{$t('days')}}: {{diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to)}}</strong>
                                                    <strong>{{$t('price')}}: {{parseFloat(room.price * diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to) * room.number).toFixed(2)}}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-right">
                                        <span type="button" @click="removeRoomFromBookingHotelForm(index)" class="remove-room">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0">
                                <strong>{{$t('total_rooms')}}: {{total_rooms}} {{$t('room')}}</strong><br>
                                <strong>{{$t('nights')}}: {{diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to)}} {{$t('night')}}</strong><br>
                                <strong>{{$t('total_price')}}: {{total_price}}</strong>
                                <hr />
                            </div>

                            <div class="text-center"
                             v-if="(bookingHotelForm.children > total_children || bookingHotelForm.adult > total_adults) && (bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0)">
                                <strong class="text-danger">{{ $t('choose the number of rooms suitable for the number of visitors') }}</strong>
                            </div>

                            <div class="text-center"
                             v-if="bookingHotelForm.children <= total_children && bookingHotelForm.adult <= total_adults && (bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0)">
                                <button :disabled="bookingHotelForm.busy"
                                 type="submit" class="btn btn-sm btn-info">
                                    {{$t('book now')}}
                                    <span v-if="bookingHotelForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!bookingHotelForm.busy" aria-hidden="true" class="fa fa-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="module-pop clearfix" v-if="hotel.rooms && hotel.rooms.length > 0">
                        <h3>{{$t('popular rooms')}}</h3>
                        <div v-for="room in hotel.rooms.slice(0, 2)" class="item clearfix" :key="room.room.id">
                            <div class="image">
                                <Gallery v-if="room.room.gallery && room.room.gallery.length > 0" :images="room.room.gallery" />
                            </div>
                            <div class="content text-center">
                                <h4>{{room.room.title_api}}</h4>
                                <div class="mb-2">
                                    <strong>{{room.room.adult}} {{$t('adult')}} | {{room.room.child}} {{$t('child')}}</strong><br>
                                    <strong>{{room.room.main_price}}/{{$t('night')}}</strong><br>
                                    <strong v-if="searchHotels">{{ $t('available') }}: {{ room.av_number }} {{ $t('room') }}</strong>
                                    <strong v-if="!searchHotels">{{ $t('room number') }}: {{ room.av_number }} {{ $t('room') }}</strong><br>
                                </div>
                                <form v-if="!bookingHotelForm.rooms.some(r => r.id === room.room.id)"
                                      @submit.prevent="addRoomToBookingHotelForm(room)">
                                    <div v-if="room.room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                        {{$t('please check date from and date to from checkin')}}.
                                        <br>
                                        <div v-if="room.room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                            {{checkAvailabilityForm.errors.get('from')}}
                                        </div>
                                        <br>
                                        <div v-if="room.room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                            {{checkAvailabilityForm.errors.get('to')}}
                                        </div>
                                    </div>
                                    <div v-if="room.room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('number')" class="invalid-feedback">
                                        {{$t('this room only available')}}: {{checkAvailabilityForm.errors.get('number')}}.
                                    </div>
                                    <div v-if="room.room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('diffDate')" class="invalid-feedback">
                                        {{$t('please check date from and date to from checkin')}}.
                                    </div>
                                    <div class="input-group mb-2">
                                        <input
                                            :id="'number'+room.room.id"
                                            value="1"
                                            style="height: 31px;"
                                            min="1" type="number"
                                            class="form-control" :placeholder="$t('room number')">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-info" type="submit">
                                                <i class="fa fa-plus-circle"></i>
                                                {{$t('checkin')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="module-why clearfix">
                        <h3>{{$t('Why should travel with us?')}}</h3>
                        <ul>
                            <li><i class="fa fa-usd"></i>No-hassle best price guarantee</li>
                            <li><i class="fa fa-star"></i>Hand-picked Tours & Activities</li>
                            <li><i class="fa fa-volume-control-phone" aria-hidden="true"></i>Passenger service 24/7</li>
                            <li><i class="fa fa-user"></i>Professional tour guide</li>
                        </ul>
                    </div>
                    <div class="module-why clearfix">
                        <h3>{{$t('become a vendor')}}</h3>
                        
                        <ul>
                            <li><router-link to="/become-a-vendor">{{ $t('registration') }} {{ $t('vendor') }}</router-link></li>
                            <li><router-link to="/vendor-terms-and-conditions">{{ $t('vendor') }} {{ $t('terms_condition') }}</router-link></li>
                        </ul>
                        <!-- <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem que laudantium.</p>
                        <ul>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>+1 2618 181 612</li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i>travelsp@gmail.com</li>
                        </ul> -->
                    </div>
                    
                </aside>
            </div>
        </div>
        <!-- //Main Container -->
        <CheckinModal :bookingHotelForm="bookingHotelForm" />
        </div>
    </div>
</template>
<script>
import starRating from "vue-star-rating";
import Gallery from "../Layouts/Gallery";
import Form from "vform";
import { mapGetters } from 'vuex';
import CheckinModal from "./CheckinModal";
export default {
    name: 'SingleHotel',
    components:{
        starRating, Gallery, CheckinModal
    },
    computed: {
        ...mapGetters(['searchHotels', 'user']),
        total_price(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.price * room.number * this.diffDate(this.bookingHotelForm.date_from, this.bookingHotelForm.date_to)) + parseFloat(Sum),0);},
        total_rooms(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.number) + parseFloat(Sum),0);},
        total_adults(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.adult * room.number) + parseFloat(Sum),0);},
        total_children(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.child * room.number) + parseFloat(Sum),0);},
    },
    data(){
        return{
            loading: true,
            sideBar: false,
            disabledTodayDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledTomorrowDates: {
                to: new Date(Date.now())
            },
            id: this.$route.params.id,
            hotel: {},
            cities: [],
            bookingHotelForm: new Form({
                name: "",
                email: "",
                phone: "",
                e164Phone: "",
                country: "",
                vendor_id: "",
                type: "hotel", // hotel , tour
                hotel: {},
                customer_id: "", //from auth
                object_id: this.$route.params.id, // hotel id
                from: "", // date from
                to: "", // date to
                adult: "",
                child: 0,
                total: "", // price * no. of rooms*nights if hotel // if tour person no * person price
                deposit: 0, // دفع جزئي (x%) (total*x/100)
                note: "",
                is_paid: 0,
                partial_payment: 0, //
                paid: "",
                rooms: [],
                city: '',
                sCity: '',
                date_from: '',
                date_to: '',
                children: 0,
            }),
            checkAvailabilityForm: new Form({
                from: '',
                to: '',
                number: 1,
                room_id: '',
            }),
            ava_number: 1
        }
    },
    mounted() {
        this.fillBookingHotelForm(this.searchHotels);
        this.getHotel();
        // this.getCities();
        // this.recommendationRooms();
    },
    watch:{
        user: function () {
            if (this.user){
                this.bookingHotelForm.name = this.user.name;
                this.bookingHotelForm.email = this.user.email;
                this.bookingHotelForm.phone = this.user.phone;
                this.bookingHotelForm.e164Phone = this.user.phone;
                this.bookingHotelForm.country = this.user.country;
                this.bookingHotelForm.customer_id = this.user.id;
            }
        }
    },
    methods: {
        customFormatter(date) {
            return moment(date).format('DD-MM-YYYY');
        },
        recommendationRooms(){
            if(this.searchHotels){
                    axios.post('recommendation', {
                        hotel_id: this.$route.params.id,
                        adult: this.bookingHotelForm.adult,
                        child: this.bookingHotelForm.children
                        }).then((res)=>{
                            res.data.map((room) =>{
                                if(this.hotel.rooms.some(r => r.id === room.room.id )){
                                    console.log( this.hotel.rooms.some(r => r.id === room.room.id ));
                                }
                            });

                    }).catch((error) =>{
                        console.log(error.response.data);
                    });
            }
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
        showCheckinModal(){
            if (this.user){
                this.bookingHotelForm.name = this.user.name;
                this.bookingHotelForm.email = this.user.email;
                this.bookingHotelForm.phone = this.user.phone;
                this.bookingHotelForm.e164Phone = this.user.phone;
                this.bookingHotelForm.country = this.user.country;
                this.bookingHotelForm.customer_id = this.user.id;
            }
            this.bookingHotelForm.hotel = this.hotel;
            this.bookingHotelForm.child = this.bookingHotelForm.children;
            this.bookingHotelForm.from = moment(this.bookingHotelForm.date_from).format('YYYY-MM-DD');
            this.bookingHotelForm.to = moment(this.bookingHotelForm.date_to).format('YYYY-MM-DD');
            this.bookingHotelForm.total = this.total_price;
            this.bookingHotelForm.paid = this.total_price;
            this.bookingHotelForm.deposit = 0;
            this.bookingHotelForm.vendor_id = this.hotel.vendor_id;
            this.sideBar = false;
            this.$modal.show('bookingModal');
        },
        getCities(){
            axios.get('cities')
                .then((res)=>{
                    this.cities = res.data.data && res.data.data.cities ? res.data.data.cities : [];
                })
                .catch();
        },
        async getHotel(){
           await axios.post('hotel', {id: this.id}).then(  (res)=>{
                this.hotel = res.data.data && res.data.data.hotel ? res.data.data.hotel : {};

                 this.hotel.rooms =   this.hotel.rooms.map( (r, i) => {
                    if (this.searchHotels){
                        axios.get("checkAvailability", {
                            params: {
                                from: this.searchHotels.date_from,
                                to: this.searchHotels.date_to,
                                number: 1,
                                room_id: r.id
                            }
                        }).then((res)=>{
                            this.hotel.rooms[i].av_number = res.data.number ? res.data.number : 1;
                           console.log( this.hotel.rooms[i] );
                        }).catch();
                    }
                    return { room: r, av_number: r['number'] };
                })
                this.loading = false;
            }).catch();
        },
        fillBookingHotelForm(searchHotels){
            if (searchHotels){
                this.bookingHotelForm.city = searchHotels.city ? searchHotels.city: '';
                this.bookingHotelForm.sCity = searchHotels.sCity ? searchHotels.sCity: '';
                this.bookingHotelForm.date_from = searchHotels.date_from ? searchHotels.date_from: '';
                this.bookingHotelForm.date_to = searchHotels.date_to ? searchHotels.date_to: '';
                this.bookingHotelForm.adult = searchHotels.adult ? searchHotels.adult: 2;
                this.bookingHotelForm.children = searchHotels.children ? searchHotels.children: 0;
                this.bookingHotelForm.rooms = [];
            }
        },
        addRoomToBookingHotelForm(room){
            const number = document.getElementById("number" + room.room.id).value;
            this.checkAvailabilityForm.number = number;
            this.checkAvailabilityForm.room_id = room.room.id;
            this.checkAvailabilityForm.from = this.bookingHotelForm.date_from;
            this.checkAvailabilityForm.to = this.bookingHotelForm.date_to;
            return this.diffDate(this.bookingHotelForm.date_from, this.bookingHotelForm.date_to) < 1 ? this.checkAvailabilityForm.errors.set({diffDate: 'dirty date'}) :
            this.checkAvailabilityForm.get('checkAvailability').then((res)=>{
                if (res.data.success === 'true') {
                    this.bookingHotelForm.rooms.push({
                        id: room.room.id,
                        room_id: room.room.id,
                        price: room.room.main_price,
                        adult: room.room.adult,
                        maxAdult: room.room.adult,
                        child: room.room.child,
                        maxChild: room.room.child,
                        number: this.checkAvailabilityForm.number,
                        maxNumber: res.data.number,
                        title_api: room.room.title_api,
                        av_number: room.av_number
                    });
                    this.sideBar = true;
                } else {
                    this.checkAvailabilityForm.errors.set(res.data.data ? res.data.data : res.data);
                }

            }).catch()
        },
        removeRoomFromBookingHotelForm(index){
            this.bookingHotelForm.rooms.splice(index, 1);
        },
        changeRoomNumber(event){
            this.checkAvailabilityForm.number = event.target.value;
        },
        diffDate(date1, date2){
            const a = moment(date1);
            const b = moment(date2);
            return b.diff(a, 'days');
        }
    }
}
</script>
