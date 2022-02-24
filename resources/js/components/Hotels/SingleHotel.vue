<template>
    <div>
        <div class="image-top">
            <img :src="hotel.image" :alt="hotel.title_api" class="img-responsive">
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
                                    <li><a @click.prevent="scrollToSection('maps')" href="#maps">{{$t('map')}}</a></li>
<!--                                    <li><a @click.prevent="" href="#review">Review</a></li>-->
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
                                <div v-if="hotel.rooms">
                                    <div v-for="room in hotel.rooms" class="hotel-rooms shadow mb-3 rounded border pr-1">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-md-4 col-4">
                                                <img :src="room.image" :alt="room.title_api" class="img-responsive">
                                            </div>

                                            <div class="col-md-5 col-4">
                                                <h3>{{room.title_api}}</h3>

                                                <ul class="d-inline-flex">
                                                    <li :title="$t('size')"><i class="fa fa-arrows-alt"></i> {{room.size}} {{$t('m')}}<sup>2</sup></li>
                                                    <li :title="$t('bed')"><i class="fa fa-bed"></i> {{room.bed}}</li>
                                                    <li :title="$t('adults')"><i class="fa fa-user"></i> {{room.adult}}</li>
                                                    <li :title="$t('child')"><i class="fa fa-child"></i> {{room.child}}</li>
                                                    <li :title="$t('bathroom')"><i class="fa fa-bath"></i> {{room.bathroom}}</li>
                                                </ul>
                                                <div class="des">{{room.content_api}}</div>
                                            </div>

                                            <div class="col-md-3 col-4 text-center">
                                                <div class="price">
                                                    <h3>{{room.main_price}}/{{$t('night')}}</h3>
                                                    <strong>{{room.adult}} {{$t('adult')}}</strong> | <strong>{{room.child}} {{$t('child')}}</strong>
                                                </div>

                                                <form v-if="!bookingHotelForm.rooms.some(r => r.id === room.id)"
                                                      @submit.prevent="addRoomToBookingHotelForm(room)">

                                                    <div v-if="room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                                        {{$t('please check date from and date to from checkin')}}.
                                                        <br>
                                                        <div v-if="room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                                            {{checkAvailabilityForm.errors.get('from')}}
                                                        </div>
                                                        <br>
                                                        <div v-if="room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                                            {{checkAvailabilityForm.errors.get('to')}}
                                                        </div>
                                                    </div>

                                                    <div v-if="room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('number')" class="invalid-feedback">
                                                        {{$t('this room only available')}}: {{checkAvailabilityForm.errors.get('number')}}.
                                                    </div>
                                                    <div v-if="room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('diffDate')" class="invalid-feedback">
                                                        {{$t('please check date from and date to from checkin')}}.
                                                    </div>

                                                    <div class="input-group">
                                                        <input
                                                            @change="changeRoomNumber($event)"
                                                            value="1"
                                                            style="height: 31px;"
                                                            min="1" type="number"
                                                            class="form-control" placeholder="Room number">
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

                            <div class="tab-content m-0" ref="maps" id="maps">
                                <div class="tour-map">
                                    <h3>{{$t('Map Located')}}</h3>
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5235.281234622878!2d-74.009579709455!3d40.71146597631483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2zVGjDoG5oIHBo4buRIE5ldyBZb3JrLCBUaeG7g3UgYmFuZyBOZXcgWW9yaywgSG9hIEvhu7M!5e0!3m2!1svi!2s!4v1572333240599!5m2!1svi!2s" width="900" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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

                <aside class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
                    <span id="close-sidebar" class="fa fa-times"></span>
                    <div class="module-search mt-2 clearfix">
                        <h3 class="modtitle">Checkin</h3>
                        <form @submit.prevent="showCheckinModal()" class="search-pr">

                            <div class="mb-3">
                                <label for="date_from" class="form-label text-capitalize">{{$t('date from')}}</label>
                                <input type="date" :class="{'is-invalid': bookingHotelForm.errors.has('date_from')}" v-model="bookingHotelForm.date_from" class="form-control" id="date_from" :placeholder="$t('date from')">
                                <div class="invalid-feedback"
                                     v-if="bookingHotelForm.errors.has('date_from')"
                                     v-html="bookingHotelForm.errors.get('date_from')">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="date_to" class="form-label text-capitalize">{{$t('date to')}}</label>
                                <input type="date" :class="{'is-invalid': bookingHotelForm.errors.has('date_to')}" v-model="bookingHotelForm.date_to" class="form-control" id="date_to" :placeholder="$t('date to')">
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

                                <div v-for="(room, index) in bookingHotelForm.rooms"
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
                                                        <input type="text" min="1" :max="room.maxNumber" v-model="room.price + '/Night'" class="form-control" id="room_price" :placeholder="$t('room price')" disabled />
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-between">
                                                    <strong>{{$t('days')}}: {{diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to)}}</strong>
                                                    <strong>{{$t('price')}}: {{room.price * diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to) * room.number}}</strong>
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
                                <strong>{{$t('total_rooms')}}: {{total_rooms}}</strong><br>
                                <strong>{{$t('nights')}}: {{diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to)}}</strong><br>
                                <strong>{{$t('total_price')}}: {{total_price}}</strong>
                                <hr />
                            </div>

                            <div class="text-center" v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0">
                                <button type="submit" class="btn btn-sm btn-info">
                                    {{$t('book now')}}
                                    <span v-if="bookingHotelForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!bookingHotelForm.busy" aria-hidden="true" class="fa fa-check"></i>
                                </button>
                            </div>
                        </form>
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
                    <div class="module-ques clearfix">
                        <h3>{{$t('get a questions')}}</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem que laudantium.</p>
                        <ul>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>+1 2618 181 612</li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i>travelsp@gmail.com</li>
                        </ul>
                    </div>
                    <div class="module-pop clearfix" v-if="hotel.rooms && hotel.rooms.length > 0">
                        <h3>{{$t('popular rooms')}}</h3>
                        <div v-for="room in hotel.rooms.slice(0, 2)" class="item clearfix">
                            <div class="image">
                                <img :src="room.image" :alt="room.title_api" class="img-responsive">
                            </div>
                            <div class="content">
                                <h4>{{room.title_api}}</h4>
                                <p>{{room.adult}} {{$t('adult')}} | {{room.child}} {{$t('child')}}</p>
                                <p>{{room.main_price}}/{{$t('night')}}</p>
                                <form v-if="!bookingHotelForm.rooms.some(r => r.id === room.id)"
                                      @submit.prevent="addRoomToBookingHotelForm(room)">

                                    <div v-if="room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                        {{$t('please check date from and date to from checkin')}}.
                                        <br>
                                        <div v-if="room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                            {{checkAvailabilityForm.errors.get('from')}}
                                        </div>
                                        <br>
                                        <div v-if="room.id === checkAvailabilityForm.room_id && (checkAvailabilityForm.errors.has('from') || checkAvailabilityForm.errors.has('to'))" class="invalid-feedback">
                                            {{checkAvailabilityForm.errors.get('to')}}
                                        </div>
                                    </div>

                                    <div v-if="room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('number')" class="invalid-feedback">
                                        {{$t('this room only available')}}: {{checkAvailabilityForm.errors.get('number')}}.
                                    </div>
                                    <div v-if="room.id === checkAvailabilityForm.room_id && checkAvailabilityForm.errors.has('diffDate')" class="invalid-feedback">
                                        {{$t('please check date from and date to from checkin')}}.
                                    </div>


                                    <div class="input-group">
                                        <input
                                            @change="changeRoomNumber($event)"
                                            value="1"
                                            style="height: 31px;"
                                            min="1" type="number"
                                            class="form-control" placeholder="Room number">
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

                </aside>
            </div>
        </div>
        <!-- //Main Container -->
        <CheckinModal :bookingHotelForm="bookingHotelForm" />
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
    },
    data(){
        return{
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
                child: "",
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
            })
        }
    },
    mounted() {
        this.getHotel();
        // this.getCities();
        this.fillBookingHotelForm(this.searchHotels);
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
            this.bookingHotelForm.from = this.bookingHotelForm.date_from;
            this.bookingHotelForm.to = this.bookingHotelForm.date_to;
            this.bookingHotelForm.total = this.total_price;
            this.bookingHotelForm.paid = this.total_price;
            this.bookingHotelForm.deposit = 0;
            this.bookingHotelForm.vendor_id = this.hotel.vendor_id;
            this.$modal.show('bookingModal');
        },
        getCities(){
            axios.get('cities')
                .then((res)=>{
                    this.cities = res.data.data && res.data.data.cities ? res.data.data.cities : [];
                })
                .catch();
        },
        getHotel(){
            axios.post('hotel', {id: this.id}).then((res)=>{
                this.hotel = res.data.data && res.data.data.hotel ? res.data.data.hotel : {};
            }).catch(() =>{});
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
            this.checkAvailabilityForm.room_id = room.id;
            this.checkAvailabilityForm.from = this.bookingHotelForm.date_from;
            this.checkAvailabilityForm.to = this.bookingHotelForm.date_to;

            return this.diffDate(this.bookingHotelForm.date_from, this.bookingHotelForm.date_to) < 1 ? this.checkAvailabilityForm.errors.set({diffDate: 'dirty date'}) :

            this.checkAvailabilityForm.get('checkAvailability').then((res)=>{
                if (res.data.success === 'true') {
                    this.bookingHotelForm.rooms.push({
                        id: room.id,
                        room_id: room.id,
                        price: room.main_price,
                        adult: room.adult,
                        maxAdult: room.adult,
                        child: room.child,
                        maxChild: room.child,
                        number: this.checkAvailabilityForm.number,
                        maxNumber: res.data.number,
                        title_api: room.title_api
                    });
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
