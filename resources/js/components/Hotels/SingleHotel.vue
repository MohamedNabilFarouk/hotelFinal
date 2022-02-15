<template>
    <div>
        <div class="image-top">
            <img :src="hotel.image" :alt="hotel.title_api" class="img-responsive">
        </div>
        <!-- Main Container  -->
        <div  class="container product-detail tour-single">
            <div class="row">
                <div id="content" class="col-md-9 col-sm-12 col-xs-12">

                    <a href="" class="open-sidebar hidden-lg hidden-md">
                        <i class="fa fa-bars"></i>Sidebar
                    </a>

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
                                    <li><a href="#gallery">Gallery</a></li>
                                    <li><a href="#hotel_content">Content</a></li>
                                    <li><a href="#rooms">Rooms</a></li>
                                    <li><a href="#Map">Map</a></li>
                                    <li><a href="#review">Review</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content-tabs">
                            <div class="tab-content m-0" id="gallery">
                                <h3>Gallery</h3>
                                <Gallery v-if="hotel.gallery && hotel.gallery.length > 0" :images="hotel.gallery" />
                            </div>

                            <div class="tab-content m-0" id="hotel_content">
                                <h3>Content</h3>
                                {{hotel.content_api}}
                            </div>

                            <div class="tab-content m-0 products-category" id="rooms">
                                <h3>Rooms</h3>
                                <div v-if="hotel.rooms" class="section-style4 products-list row number-col-3 so-filter-gird list">

                                    <div v-for="room in hotel.rooms" class="product-layout col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="product-item-container item">
                                            <div class="item-block so-quickview">
                                                <div class="image">
                                                    <img :src="room.image" :alt="room.title_api" class="img-responsive">
                                                </div>
                                                <div class="item-content clearfix">
                                                    <h3>{{room.title_api}}</h3>

                                                    <ul>
                                                        <li title="size"><i aria-hidden="true" class="fa fa-arrows-alt"></i> {{room.size}} m<sup>2</sup></li>
                                                        <li title="bed"><i aria-hidden="true" class="fa fa-bed"></i> {{room.bed}}</li>
                                                        <li title="adult"><i aria-hidden="true" class="fa fa-user"></i> {{room.adult}}</li>
                                                        <li title="child"><i aria-hidden="true" class="fa fa-child"></i> {{room.child}}</li>
                                                        <li title="bathroom"><i aria-hidden="true" class="fa fa-bath"></i> {{room.bathroom}}</li>
                                                    </ul>

                                                    <div class="des">{{room.content_api}}</div>

                                                    <div class="item-bot text-center clearfix">
                                                        <div class="price">
                                                            Rooms ({{room.availability}})<br>
                                                            price
                                                            <label>{{room.price}}</label>
                                                            <span>{{room.adult}} adult | {{room.child}} child</span>
                                                        </div>
                                                        <button v-if="room.availability > 0"
                                                            @click="addRoomToBookingHotelForm(room)"
                                                                class="book-now btn-quickview quickview quickview_handler" >
                                                            Add To checkin
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-content m-0" id="Map">
                                <div class="tour-map">
                                    <h3>Map Located</h3>
<!--                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5235.281234622878!2d-74.009579709455!3d40.71146597631483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2zVGjDoG5oIHBo4buRIE5ldyBZb3JrLCBUaeG7g3UgYmFuZyBOZXcgWW9yaywgSG9hIEvhu7M!5e0!3m2!1svi!2s!4v1572333240599!5m2!1svi!2s" width="900" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
                                </div>
                            </div>

                            <div class="tab-content m-0" id="review">
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
                        </div>
                    </div>
                </div>

                <aside class="col-md-3 col-sm-4 col-xs-12 content-aside right_column sidebar-offcanvas">
                    <span id="close-sidebar" class="fa fa-times"></span>
                    <div class="module-search2 clearfix">
                        <h3 class="modtitle">Checkin</h3>
                        <form @submit.prevent="showModal()" class="search-pr">

                            <div class="form-group">
                                <label>date from
                                    <input
                                        :class="{
                                        'is-invalid': bookingHotelForm.errors.has('date_from')
                                    }"
                                        v-model="bookingHotelForm.date_from"
                                        type="date" placeholder="date from" />
                                </label>
                                <span class="text-danger"
                                      v-if="bookingHotelForm.errors.has('date_from')"
                                      v-html="bookingHotelForm.errors.get('date_from')">
                                </span>
                            </div>

                            <div class="form-group">
                                <label>date to
                                    <input
                                        :class="{
                                        'is-invalid': bookingHotelForm.errors.has('date_to')
                                    }"
                                        v-model="bookingHotelForm.date_to" type="date" placeholder="date to" />
                                </label>
                                <span class="text-danger"
                                      v-if="bookingHotelForm.errors.has('date_to')"
                                      v-html="bookingHotelForm.errors.get('date_to')">
                                </span>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <label>adults
                                            <input
                                                :class="{
                                                'is-invalid': bookingHotelForm.errors.has('adult')
                                            }"
                                                type="number" v-model="bookingHotelForm.adult" placeholder="adults" />
                                        </label>
                                        <span class="text-danger"
                                              v-if="bookingHotelForm.errors.has('adult')"
                                              v-html="bookingHotelForm.errors.get('adult')">
                                     </span>
                                    </div>

                                    <div class="mx-2"></div>

                                    <div>
                                        <label>children
                                            <input
                                                :class="{
                                            'is-invalid': bookingHotelForm.errors.has('children')
                                            }"
                                                min="0" type="number" v-model="bookingHotelForm.children" placeholder="children" />
                                        </label>
                                        <span class="text-danger"
                                              v-if="bookingHotelForm.errors.has('children')"
                                              v-html="bookingHotelForm.errors.get('children')">
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length === 0">
                                <h4>Choose Rooms To checkin</h4>
                            </div>

                            <div v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0" class="form-group">
                                <h4>Rooms</h4>

                                <div
                                    v-for="(room, index) in bookingHotelForm.rooms"
                                    :class="index === 0 ? 'border-top': ''"
                                    class="media mb-3 border-bottom align-items-center justify-content-between">
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <h4 class="mt-2 text-center">{{room.title_api}}</h4>
                                        </div>
                                        <div class="form-group">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-6">
                                                    <label>adults
                                                        <input
                                                            :class="{
                                                                'is-invalid': bookingHotelForm.errors.has('adult')
                                                            }"
                                                            type="number" min="1" :max="room.maxAdult" v-model="room.adult" placeholder="adults" />
                                                    </label>
                                                    <span class="text-danger"
                                                          v-if="bookingHotelForm.errors.has('adult')"
                                                          v-html="bookingHotelForm.errors.get('adult')">
                                                    </span>
                                                </div>

                                                <div class="col-6">
                                                    <label>children
                                                        <input
                                                            :class="{
                                                                'is-invalid': bookingHotelForm.errors.has('children')
                                                            }"
                                                            min="0" type="number" :max="room.maxChild" v-model="room.child" placeholder="children" />
                                                    </label>
                                                    <span class="text-danger"
                                                          v-if="bookingHotelForm.errors.has('children')"
                                                          v-html="bookingHotelForm.errors.get('children')">
                                                    </span>
                                                </div>

                                                <div class="col-6">
                                                    <label>number
                                                        <input
                                                            :class="{
                                                                'is-invalid': bookingHotelForm.errors.has('adult')
                                                            }"
                                                            type="number" min="1" :max="room.maxNumber" v-model="room.number" placeholder="number" />
                                                    </label>
                                                    <span class="text-danger"
                                                          v-if="bookingHotelForm.errors.has('adult')"
                                                          v-html="bookingHotelForm.errors.get('adult')">
                                                    </span>
                                                </div>

                                                <div class="col-6">
                                                    <label>price
                                                        <input
                                                            disabled
                                                            :class="{
                                                                'is-invalid': bookingHotelForm.errors.has('adult')
                                                            }"
                                                            type="number"
                                                            v-model="room.price * room.number" placeholder="total" />
                                                    </label>
                                                    <span class="text-danger"
                                                          v-if="bookingHotelForm.errors.has('adult')"
                                                          v-html="bookingHotelForm.errors.get('adult')">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-right">
                                        <button type="button" @click="removeRoomFromBookingHotelForm(index)" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0">
                                <h4>Total: {{total_price}}</h4>
                                <hr />
                            </div>

                            <div class="text-center" v-if="bookingHotelForm.rooms && bookingHotelForm.rooms.length > 0">
                                <button type="submit" class="btn btn-primary">
                                    book now
                                    <span v-if="bookingHotelForm.busy" class="spinner-border spinner-border-sm"></span>
                                    <i v-if="!bookingHotelForm.busy" aria-hidden="true" class="fa fa-check"></i>
                                </button>
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

        <!-- booking modal  -->
        <modal :scrollable="true" width="90%" height="auto" name="bookingModal">
            <div class="tt_popup_modal">
                <i @click="closeModal()" class="fa fa-times-circle close-modal"></i>
                <strong>
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    Checkin Now
                </strong>
            </div>

            <form @submit.prevent="" class="row">

                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <label>first name
                            <input
                                :class="{
                                    'is-invalid': checkinForm.errors.has('first_name')
                                }"
                                v-model="checkinForm.first_name"
                                type="text" placeholder="first name" />
                        </label>
                        <span class="text-danger"
                          v-if="checkinForm.errors.has('first_name')"
                          v-html="checkinForm.errors.get('first_name')">
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <label>last name
                            <input
                                :class="{
                                    'is-invalid': checkinForm.errors.has('last_name')
                                }"
                                v-model="checkinForm.last_name"
                                type="text" placeholder="last name" />
                        </label>
                        <span class="text-danger"
                              v-if="checkinForm.errors.has('last_name')"
                              v-html="checkinForm.errors.get('last_name')">
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <label>email
                            <input
                                :class="{
                                    'is-invalid': checkinForm.errors.has('email')
                                }"
                                v-model="checkinForm.email"
                                type="email" placeholder="email" />
                        </label>
                        <span class="text-danger"
                              v-if="checkinForm.errors.has('email')"
                              v-html="checkinForm.errors.get('email')">
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <label>phone
                            <input
                                :class="{
                                    'is-invalid': checkinForm.errors.has('phone')
                                }"
                                v-model="checkinForm.phone"
                                type="text" placeholder="phone" />
                        </label>
                        <span class="text-danger"
                              v-if="checkinForm.errors.has('phone')"
                              v-html="checkinForm.errors.get('phone')">
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <label>country
                            <input
                                :class="{
                                    'is-invalid': checkinForm.errors.has('country')
                                }"
                                v-model="checkinForm.country"
                                type="text" placeholder="country" />
                        </label>
                        <span class="text-danger"
                              v-if="checkinForm.errors.has('country')"
                              v-html="checkinForm.errors.get('country')">
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="form-group">
                        <label>city
                            <input
                                :class="{
                                    'is-invalid': checkinForm.errors.has('city')
                                }"
                                v-model="checkinForm.city"
                                type="text" placeholder="city" />
                        </label>
                        <span class="text-danger"
                              v-if="checkinForm.errors.has('city')"
                              v-html="checkinForm.errors.get('city')">
                        </span>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label>notes
                            <textarea
                                rows="5"
                                :class="{
                                    'is-invalid': checkinForm.errors.has('notes')
                                }"
                                v-model="checkinForm.notes"
                                placeholder="notes" ></textarea>
                        </label>
                        <span class="text-danger"
                              v-if="checkinForm.errors.has('notes')"
                              v-html="checkinForm.errors.get('notes')">
                        </span>
                    </div>
                </div>

                <div class="text-center col-12">
                    <button type="submit" class="btn btn-primary">
                        Done
                        <span v-if="checkinForm.busy" class="spinner-border spinner-border-sm"></span>
                        <i v-if="!checkinForm.busy" aria-hidden="true" class="fa fa-check"></i>
                    </button>
                </div>
            </form>
        </modal>
        <!-- end booking modal-->
    </div>
</template>
<script>
import starRating from "vue-star-rating";
import Gallery from "../Layouts/Gallery";
import Form from "vform";
import { mapGetters } from 'vuex';

export default {
    name: 'SingleHotel',
    components:{
        starRating, Gallery
    },
    computed: {
        ...mapGetters([
            'searchHotels'
        ]),
        total_price(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.price * room.number) + parseFloat(Sum),0);},
    },
    data(){
        return{
            id: this.$route.params.id,
            hotel: {},
            cities: [],
            bookingHotelForm: new Form({
                city: '',
                sCity: '',
                date_from: '',
                date_to: '',
                adult: 2,
                children: 0,
                rooms: []
            }),
            checkinForm: new Form({
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                country: "",
                city: "",
                notes: ""
            })
        }
    },
    mounted() {
        this.getHotel();
        this.getCities();
        this.fillBookingHotelForm(this.searchHotels);
    },
    methods: {
        showModal(){
            this.$modal.show('bookingModal');
        },
        closeModal(){
            this.$modal.hide('bookingModal');
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
            if (room.availability > 0){
                this.bookingHotelForm.rooms.push({
                    id: room.id,
                    price: room.price,
                    adult: room.adult <= this.bookingHotelForm.adult ? room.adult : this.bookingHotelForm.adult,
                    maxAdult: room.adult,
                    child: room.child <= this.bookingHotelForm.child ? room.child : this.bookingHotelForm.child,
                    maxChild: room.child,
                    number: 1,
                    maxNumber: room.availability,
                    title_api: room.title_api
                });
            }
        },
        removeRoomFromBookingHotelForm(index){
            this.bookingHotelForm.rooms.splice(index, 1);
        },
    }
}
</script>
