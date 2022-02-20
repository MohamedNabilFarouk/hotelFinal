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
                            <h1>{{tour.title_api}}</h1>
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
                                                {{ tour.price ? tour.price.price : "" }}/person
                                            </div>
                                            <div class="info">
                                                <i class="fa fa-child" aria-hidden="true"></i>
                                                {{ tour.price ? tour.price.ch_price : "" }}/child
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div id="menu1" class="tour-plan clearfix">
                                    <h3>tour plans</h3>
                                    <div class="item-content">
                                        <div class="title"><span>1</span>Day 1 - Departure</div>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, tota rem aperia, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.</p>
                                        <ul>
                                            <li><label>09:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                            <li><label>13:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                            <li><label>17:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                            <li><label>20:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                        </ul>
                                        <div class="title"><span>2</span>Day 2 - Visting The Shire - the Hobbit’s Village</div>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, tota rem aperia, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.</p>
                                        <ul>
                                            <li><label>09:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                            <li><label>13:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                            <li><label>17:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                            <li><label>20:30</label> - <span>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</span></li>
                                        </ul>
                                        <div class="title"><span>3</span>Day 3 - Return</div>
                                    </div>
                                </div>
                                <div id="menu2" class="tour-map">
                                    <h3>Map Located</h3>
<!--                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5235.281234622878!2d-74.009579709455!3d40.71146597631483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2zVGjDoG5oIHBo4buRIE5ldyBZb3JrLCBUaeG7g3UgYmFuZyBOZXcgWW9yaywgSG9hIEvhu7M!5e0!3m2!1svi!2s!4v1572333240599!5m2!1svi!2s" width="900" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
                                </div>
                                <div id="menu3" class="tour-amen clearfix">
                                    <h3>Amenities</h3>
                                    <ul>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Swimming Pool</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Free Wifi</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Security cameras</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Hot Water</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Swimming Pool</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Free Wifi</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Security cameras</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Hot Water</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Swimming Pool</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Free Wifi</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Security cameras</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Hot Water</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Security cameras</li>
                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i>Hot Water</li>
                                    </ul>
                                </div>
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
                            <label>{{ tour.price ? tour.price.price : "" }}</label><span>person</span>
                            <label>{{ tour.price ? tour.price.ch_price : "" }}</label><span>child</span>
                        </h3>

                        <form @submit.prevent="" class="search-pr">

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
                                                    <strong>Adults: {{room.adult}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong>Children: {{room.child}}</strong>
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
                                                            type="text"
                                                            v-model="room.price + '/Night'" placeholder="total" />
                                                    </label>
                                                    <span class="text-danger"
                                                          v-if="bookingHotelForm.errors.has('adult')"
                                                          v-html="bookingHotelForm.errors.get('adult')">
                                                    </span>
                                                </div>

                                                <div class="col-12 d-flex justify-content-between">
                                                    <strong>Days: {{diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to)}}</strong>
                                                    <strong>price: {{room.price * diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to) * room.number}}$</strong>
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
                                <h4>Rooms: {{total_rooms}}</h4>
                                <h4>Days: {{diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to)}}</h4>
                                <h4>Total: {{total_price}}$</h4>
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
    </div>
</template>
<script>
import starRating from "vue-star-rating";
import Gallery from "../Layouts/Gallery";
import Form from "vform";

export default {
    name: 'SingleTour',
    props: {
        // PageTitle: {type: String, default:  () => ('')},
    },
    components:{
        starRating, Gallery
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
                adult: "",
                child: "",
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
        getTour(){
            axios.post('tour', {id: this.id}).then((res)=>{
                this.tour = res.data.data && res.data.data.tour ? res.data.data.tour : {};
            }).catch(() =>{});
        }
    }
}
</script>
