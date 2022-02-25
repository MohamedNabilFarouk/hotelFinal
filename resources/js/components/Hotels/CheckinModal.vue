<template>
    <div>
        <!-- booking modal  -->
        <modal :scrollable="true" :width="checkinItem === 'authItem' ? '350px' : '90%'" height="auto" name="bookingModal">
            <div class="tt_popup_modal">
                <i @click="closeModal()" class="fa fa-times-circle close-modal"></i>
                <strong v-if="checkinItem !== 'authItem'">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    Checkin Now
                </strong>
                <strong v-if="checkinItem === 'authItem'">
                    <i class="fa fa fa-address-card" aria-hidden="true"></i>
                    {{$t('login')}}
                    {{$t('or')}}
                    {{$t('registration')}}
                </strong>
            </div>

            <div v-if="checkinItem === 'authItem'">
                <ul class="nav nav-tabs">
                    <li class="nav-item w-50">
                        <button
                            @click="switchFormAuth('registration')"
                            :class="registration ? 'active': ''"
                            class="nav-link w-100">
                            <i class="fa fa-address-card mr-1"></i>
                            {{$t('registration')}}
                        </button>
                    </li>
                    <li class="nav-item w-50">
                        <button
                            @click="switchFormAuth('login')"
                            :class="login ? 'active': ''"
                            class="nav-link w-100">
                            <i class="fa fa-sign-in mr-1"></i>
                            {{$t('login')}}
                        </button>
                    </li>
                </ul>
                <form v-if="registration" @submit.prevent="registrationFun()" class="p-3 border">

                    <div class="mb-3">
                        <label for="name" class="form-label text-capitalize">{{$t('name')}}</label>
                        <input type="text" :class="{'is-invalid': authForm.errors.has('name')}" v-model="authForm.name" class="form-control" id="name" :placeholder="$t('name')">
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('name')"
                             v-html="authForm.errors.get('name')">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-capitalize">{{$t('email')}}</label>
                        <input type="email" autocomplete="off" :class="{'is-invalid': authForm.errors.has('email')}" v-model="authForm.email" class="form-control" id="email" :placeholder="$t('email')">
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('email')"
                             v-html="authForm.errors.get('email')">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label text-capitalize">{{$t('phone')}}</label>
                        <VuePhoneNumberInput id="phone" :default-country-code="'EG'" :show-code-on-list="true" @update="updatedddd($event)"
                                             :placeholder="$t('phone')" v-model="authForm.phone" :class="{'is-invalid': authForm.errors.has('phone')}"
                        />
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('phone')"
                             v-html="authForm.errors.get('phone')">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-capitalize">{{$t('password')}}</label>
                        <input type="password" autocomplete="new-password" :class="{'is-invalid': authForm.errors.has('password')}" v-model="authForm.password" class="form-control" id="password" :placeholder="$t('password')">
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('password')"
                             v-html="authForm.errors.get('password')">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-capitalize">{{$t('password_confirmation')}}</label>
                        <input type="password" :class="{'is-invalid': authForm.errors.has('password_confirmation')}" v-model="authForm.password_confirmation" class="form-control" id="password_confirmation" :placeholder="$t('password_confirmation')">
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('password_confirmation')"
                             v-html="authForm.errors.get('password_confirmation')">
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn button btn-info">
                            <span v-if="authForm.busy" class="spinner-border spinner-border-sm"></span>
                            <i v-if="!authForm.busy" class="fa fa-address-card mr-1"></i>
                            {{$t('registration')}}
                        </button>
                    </div>
                </form>

                <form v-if="login" @submit.prevent="loginFun()" class="p-3 border">

                    <div class="mb-3">
                        <label for="login-email" class="form-label text-capitalize">{{$t('email')}}</label>
                        <input type="email" autocomplete="off" :class="{'is-invalid': authForm.errors.has('email')}" v-model="authForm.email" class="form-control" id="login-email" :placeholder="$t('email')">
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('email')"
                             v-html="authForm.errors.get('email')">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="login-password" class="form-label text-capitalize">{{$t('password')}}</label>
                        <input type="password" autocomplete="new-password" :class="{'is-invalid': authForm.errors.has('password')}" v-model="authForm.password" class="form-control" id="login-password" :placeholder="$t('password')">
                        <div class="invalid-feedback"
                             v-if="authForm.errors.has('password')"
                             v-html="authForm.errors.get('password')">
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn button btn-info">
                            <span v-if="authForm.busy" class="spinner-border spinner-border-sm"></span>
                            <i v-if="!authForm.busy" class="fa fa-sign-in mr-1"></i>
                            {{$t('login')}}
                        </button>
                    </div>
                </form>
            </div>

            <div v-if="checkinItem === 'checkItem'">
                <form @submit.prevent="checkinHotelRooms()" class="row">

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="bookingHotelName" class="form-label text-capitalize">{{$t('name')}}</label>
                            <input type="text" autocomplete="off" :class="{'is-invalid': bookingHotelForm.errors.has('name')}" v-model="bookingHotelForm.name" class="form-control" id="bookingHotelName" :placeholder="$t('name')">
                            <div class="invalid-feedback"
                                 v-if="bookingHotelForm.errors.has('name')"
                                 v-html="bookingHotelForm.errors.get('name')">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="bookingHotelEmail" class="form-label text-capitalize">{{$t('email')}}</label>
                            <input type="email" autocomplete="off" :class="{'is-invalid': bookingHotelForm.errors.has('email')}" v-model="bookingHotelForm.email" class="form-control" id="bookingHotelEmail" :placeholder="$t('email')">
                            <div class="invalid-feedback"
                                 v-if="bookingHotelForm.errors.has('email')"
                                 v-html="bookingHotelForm.errors.get('email')">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="bookingHotelPhone" class="form-label text-capitalize">{{$t('phone')}}</label>

                            <VuePhoneNumberInput id="bookingHotelPhone" :show-code-on-list="true"
                                :default-country-code="user ? user.country : 'EG'"
                                @update="updateddd($event)" :class="{'is-invalid': bookingHotelForm.errors.has('phone')}"
                                v-model="bookingHotelForm.phone"
                                :placeholder="$t('phone')" />
                            <div class="invalid-feedback" v-if="bookingHotelForm.errors.has('phone')" v-html="bookingHotelForm.errors.get('phone')"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr />
                    </div>

                    <div class="col-md-3" v-if="bookingHotelForm.sCity && bookingHotelForm.sCity.name">
                        <div class="mb-3">
                            <strong>{{$t('city')}}:</strong> {{ bookingHotelForm.sCity.name }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('hotel')}}:</strong> {{ bookingHotelForm.hotel.title_api }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('date from')}}:</strong> {{ bookingHotelForm.from }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('date to')}}:</strong> {{ bookingHotelForm.to }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr />
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('adults')}}:</strong> {{ bookingHotelForm.adult }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('children')}}:</strong> {{ bookingHotelForm.children }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('rooms')}}:</strong> {{ total_rooms }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <strong>{{$t('days')}}:</strong> {{ diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <hr />
                            <h3 class="text-center">{{$t('rooms')}}</h3>
                            <hr />
                            <div class="row" v-for="room in bookingHotelForm.rooms">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <strong>{{$t('room')}}:</strong> {{ room.title_api }}
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <span><strong>{{$t('adults')}}:</strong> {{ room.adult }} </span>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <span><strong>{{$t('children')}}:</strong> {{ room.child }} </span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <span><strong>{{$t('price')}}:</strong> {{ room.price }} /Night</span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <span><strong>{{$t('number of rooms')}}:</strong> {{ room.number }} </span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <span><strong>{{$t('total price')}}:</strong> {{ room.price * diffDate(bookingHotelForm.date_from, bookingHotelForm.date_to) * room.number }} </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7"></div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <span><strong>{{$t('total of rooms')}}:</strong> {{ total_rooms }} </span>
                        </div>
                        <hr />
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <span><strong>{{$t('total price')}}:</strong> {{ total_price }} </span>
                        </div>
                        <hr />

                        <div class="mb-3">

                            <label for="partial_payment" class="form-label text-capitalize">{{$t('partial payment')}}</label>

                                <input @change="depositHotel(bookingHotelForm.total, bookingHotelForm.hotel.deposit_percentage)" :class="{'is-invalid': bookingHotelForm.errors.has('partial_payment')}" v-model="bookingHotelForm.partial_payment"
                                    id="partial_payment" type="checkbox" :placeholder="$t('partial payment')">

                            <div class="invalid-feedback"
                                  v-if="bookingHotelForm.errors.has('partial_payment')"
                                  v-html="bookingHotelForm.errors.get('partial_payment')">
                            </div>
                        </div>

                        <hr />

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mb-3">
                                <label for="paid" class="form-label text-capitalize">{{$t('paid')}}</label>
                                <input class="form-control" id="paid" :class="{ 'is-invalid': bookingHotelForm.errors.has('paid') }" v-model="bookingHotelForm.paid" type="number" :min="bookingHotelForm.paid" step="0.01" :max="bookingHotelForm.total" :placeholder="$t('paid')">
                                <div class="invalid-feedback"
                                      v-if="bookingHotelForm.errors.has('partial_payment')"
                                      v-html="bookingHotelForm.errors.get('partial_payment')">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div v-if="bookingHotelForm.partial_payment">
                                    <strong>{{$t('min deposit')}}:</strong>
                                    {{depositHotel(bookingHotelForm.total, bookingHotelForm.hotel.deposit_percentage)}}
                                    <br/>
                                    <strong>{{$t('percentage')}}:</strong>
                                    {{bookingHotelForm.hotel.deposit_percentage}} %
                                </div>
                            </div>
                        </div>

                        <hr />
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="notes" class="form-label text-capitalize">{{$t('notes')}}</label>
                            <textarea id="notes" :class="{ 'is-invalid': bookingHotelForm.errors.has('note') }" rows="5"
                                v-model="bookingHotelForm.note" class="form-control" :placeholder="$t('notes')"></textarea>
                            <div class="invalid-feedback"
                                  v-if="bookingHotelForm.errors.has('note')"
                                  v-html="bookingHotelForm.errors.get('note')">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-sm btn-info text-capitalize">
                                <span v-if="bookingHotelForm.busy" class="spinner-border spinner-border-sm"></span>
                                <i v-if="!bookingHotelForm.busy" class="fa fa-check mr-1"></i>
                                {{$t('checkin')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </modal>
        <!-- end booking modal-->
    </div>
</template>

<script>
import Form from "vform";
import { mapGetters } from 'vuex';
export default {
    props: {
        bookingHotelForm: {type: Object, default:  () => ({})}
    },
    name: 'CheckinModal',
    computed: {
        ...mapGetters(['user']),
        total_price(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.price * room.number * this.diffDate(this.bookingHotelForm.date_from, this.bookingHotelForm.date_to)) + parseFloat(Sum),0);},
        total_rooms(){return this.bookingHotelForm.rooms.reduce( (Sum, room) => parseFloat(room.number) + parseFloat(Sum),0);},
    },
    data(){
        return{
            registration: true,
            login: false,
            checkinItem: "",
            authForm: new Form({
                name: "",
                email: "",
                phone: "",
                e164Phone: "",
                country: "",
                password: "",
                password_confirmation: ""
            })
        }
    },
    mounted() {
        this.checkinItem = !this.user ? "authItem" : "checkItem";
    },
    watch:{
        user: function () {
            this.checkinItem = !this.user ? "authItem" : "checkItem";
            if (this.user){
                this.bookingHotelForm.name = this.user.name;
                this.bookingHotelForm.email = this.user.email;
                this.bookingHotelForm.phone = this.user.phone;
                this.bookingHotelForm.e164Phone = this.user.phone;
                this.bookingHotelForm.country = this.user.country;
            }
        }
    },
    methods: {
        closeModal(){
            this.$modal.hide('bookingModal');
        },
        switchCheckinItem(item){
            this.checkinItem = item;
        },
        switchFormAuth(switcher){
            if (switcher === 'registration'){
                this.registration = true;
                this.login = false;
            }else {
                this.registration = false;
                this.login = true;
            }
        },
        registrationFun() {
            this.authForm.phone = this.authForm.e164Phone;
            this.authForm.post("user/store").then((res) => {
                if (res.data.success === 'true') {
                    this.checkinItem = "checkItem";
                    this.$store.dispatch('login', this.authForm);
                } else {
                    this.authForm.errors.set(res.data.data);
                }
            }).catch();
        },
        loginFun(){
            this.authForm.post("user/login").then((res) => {
                if (res.data.status === 'success') {
                    this.checkinItem = "checkItem";
                    this.$store.dispatch('login', this.authForm);
                } else {
                    this.authForm.errors.set(res.data.data);
                }
            }).catch();
        },
        updatedddd(event){
            this.authForm.e164Phone = event.e164;
            this.authForm.country = event.countryCode;
        },
        updateddd(event){
            this.bookingHotelForm.e164Phone = event.e164;
            this.bookingHotelForm.country = event.countryCode;
        },
        checkinHotelRooms(){

            this.bookingHotelForm.partial_payment ? this.bookingHotelForm.partial_payment = 1 : this.bookingHotelForm.partial_payment = 0;
            this.bookingHotelForm.post("doBooking").then((res) => {
                // if (res.data.success === 'true') {
                    if (res.data && res.data.frame){
                        window.open(res.data.frame, "_blank") || window.location.replace(res.data.frame);
                        this.bookingHotelForm.reset();
                        this.$store.dispatch('clearSearchHotels');
                        this.closeModal();
                    }
                // }
                else {
                    this.bookingHotelForm.errors.set(res.data);
                }
                console.log(res.data);
            }).catch(()=>{});
        },
        diffDate(date1, date2){
            const a = moment(date1);
            const b = moment(date2);
            return b.diff(a, 'days');
        },
        depositHotel(total, percentage){
            const discount = (total * percentage) / 100;
            this.bookingHotelForm.deposit = discount;
            this.bookingHotelForm.partial_payment ? this.bookingHotelForm.paid = parseFloat(total - discount).toFixed(2) : this.bookingHotelForm.paid = total;
            return parseFloat(total - discount).toFixed(2);
        }
    }
}
</script>
