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

                    <div class="form-group">
                        <label>name
                            <input
                            :class="{
                                'is-invalid': authForm.errors.has('name')
                            }"
                            v-model="authForm.name"
                            type="text" placeholder="name" />
                        </label>
                        <span class="text-danger"
                          v-if="authForm.errors.has('name')"
                          v-html="authForm.errors.get('name')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>email
                            <input
                                :class="{
                                'is-invalid': authForm.errors.has('email')
                            }"
                                v-model="authForm.email"
                                type="email" placeholder="email" />
                        </label>
                        <span class="text-danger"
                              v-if="authForm.errors.has('email')"
                              v-html="authForm.errors.get('email')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>phone
                            <VuePhoneNumberInput
                                :show-code-on-list="true"
                                default-country-code="EG"
                                @update="updatedddd($event)"
                                :class="{
                                'is-invalid': authForm.errors.has('phone')
                            }"
                                v-model="authForm.phone"
                                placeholder="phone" />
                        </label>
                        <span class="text-danger"
                              v-if="authForm.errors.has('phone')"
                              v-html="authForm.errors.get('phone')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>password
                            <input
                                :class="{
                                'is-invalid': authForm.errors.has('password')
                            }"
                                v-model="authForm.password"
                                type="password" placeholder="password" />
                        </label>
                        <span class="text-danger"
                              v-if="authForm.errors.has('password')"
                              v-html="authForm.errors.get('password')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>password confirmation
                            <input
                                :class="{
                                'is-invalid': authForm.errors.has('password_confirmation')
                            }"
                                v-model="authForm.password_confirmation"
                                type="password" placeholder="password confirmation" />
                        </label>
                        <span class="text-danger"
                              v-if="authForm.errors.has('password_confirmation')"
                              v-html="authForm.errors.get('password_confirmation')">
                    </span>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn button btn-primary">
                            <span v-if="authForm.busy" class="spinner-border spinner-border-sm"></span>
                            <i v-if="!authForm.busy" class="fa fa-address-card mr-1"></i>
                            {{$t('registration')}}
                        </button>
                    </div>
                </form>

                <form v-if="login" @submit.prevent="loginFun()" class="p-3 border">

                    <div class="form-group">
                        <label>email
                            <input
                                :class="{
                                'is-invalid': authForm.errors.has('email')
                            }"
                                v-model="authForm.email"
                                type="email" placeholder="email" />
                        </label>
                        <span class="text-danger"
                              v-if="authForm.errors.has('email')"
                              v-html="authForm.errors.get('email')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>password
                            <input
                                :class="{
                                'is-invalid': authForm.errors.has('password')
                            }"
                                v-model="authForm.password"
                                type="password" placeholder="password" />
                        </label>
                        <span class="text-danger"
                              v-if="authForm.errors.has('password')"
                              v-html="authForm.errors.get('password')">
                    </span>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn button btn-primary">
                            <span v-if="authForm.busy" class="spinner-border spinner-border-sm"></span>
                            <i v-if="!authForm.busy" class="fa fa-sign-in mr-1"></i>
                            {{$t('login')}}
                        </button>
                    </div>
                </form>
            </div>

            <div v-if="checkinItem === 'checkItem'">
                <form @submit.prevent="checkinTourRooms()" class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>name
                                <input
                                :class="{
                                    'is-invalid': bookingTourForm.errors.has('name')
                                }"
                                v-model="bookingTourForm.name"
                                type="text" placeholder="name" />
                            </label>
                            <span class="text-danger"
                              v-if="bookingTourForm.errors.has('name')"
                              v-html="bookingTourForm.errors.get('name')">
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>email
                                <input
                                :class="{
                                    'is-invalid': bookingTourForm.errors.has('email')
                                }"
                                v-model="bookingTourForm.email"
                                type="email" placeholder="email" />
                            </label>
                            <span class="text-danger"
                                  v-if="bookingTourForm.errors.has('email')"
                                  v-html="bookingTourForm.errors.get('email')">
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>phone
                                <VuePhoneNumberInput
                                    :show-code-on-list="true"
                                    :default-country-code="user ? user.country : 'EG'"
                                    @update="updateddd($event)"
                                    :class="{
                                        'is-invalid': bookingTourForm.errors.has('phone')
                                    }"
                                    v-model="bookingTourForm.phone"
                                    placeholder="phone" />
                            </label>
                            <span class="text-danger"
                              v-if="bookingTourForm.errors.has('phone')"
                              v-html="bookingTourForm.errors.get('phone')">
                            </span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr />
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Tour name:</strong> {{ bookingTourForm.tour.title_api }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>date from:</strong> {{ bookingTourForm.from }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>date to:</strong> {{ bookingTourForm.to }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr />
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>adult:</strong> {{ bookingTourForm.adult }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>children:</strong> {{ bookingTourForm.child }}
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Days:</strong> {{ diffDate(bookingTourForm.from, bookingTourForm.to) }}
                        </div>
                    </div>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <span><strong>total price:</strong> {{bookingTourForm.total}} </span>
                        </div>
                        <hr />

                        <div class="form-group">
                            <label>Partial Payment
                                <input
                                    @change="depositHotel(bookingTourForm.total, bookingTourForm.tour.deposit_percentage)"
                                    :class="{
                                    'is-invalid': bookingTourForm.errors.has('partial_payment')
                                }"
                                    v-model="bookingTourForm.partial_payment"
                                    type="checkbox"
                                    placeholder="Partial Payment">
                            </label>
                            <span class="text-danger"
                                  v-if="bookingTourForm.errors.has('partial_payment')"
                                  v-html="bookingTourForm.errors.get('partial_payment')">
                        </span>
                        </div>

                        <hr />

                        <div class="form-group d-flex justify-content-between align-items-center">
                            <label>Paid
                                <input
                                    :class="{
                                    'is-invalid': bookingTourForm.errors.has('paid')
                                }"
                                    v-model="bookingTourForm.paid"
                                    type="number"
                                    :min="bookingTourForm.paid"
                                    step="0.01"
                                    :max="bookingTourForm.total"
                                    placeholder="paid">
                                <span class="text-danger"
                                      v-if="bookingTourForm.errors.has('partial_payment')"
                                      v-html="bookingTourForm.errors.get('partial_payment')">
                            </span>
                            </label>

                            <div v-if="bookingTourForm.partial_payment">
                                <strong>min deposit:</strong>
                                {{depositHotel(bookingTourForm.total, bookingTourForm.tour.deposit_percentage)}}
                                <br/>
                                <strong>percentage:</strong>
                                {{bookingTourForm.tour.deposit_percentage}} %
                            </div>
                        </div>

                        <hr />
                    </div>

                    <div class="col-md-12">

                        <div class="form-group">
                            <label>note
                                <textarea
                                    :class="{
                                        'is-invalid': bookingTourForm.errors.has('note')
                                    }"
                                    rows="5"
                                    v-model="bookingTourForm.note"
                                    placeholder="note"></textarea>
                            </label>
                            <span class="text-danger"
                                  v-if="bookingTourForm.errors.has('note')"
                                  v-html="bookingTourForm.errors.get('note')">
                            </span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn button btn-primary text-capitalize">
                                <span v-if="bookingTourForm.busy" class="spinner-border spinner-border-sm"></span>
                                <i v-if="!bookingTourForm.busy" class="fa fa-check mr-1"></i>
                                checkin
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
        bookingTourForm: {type: Object, default:  () => ({})}
    },
    name: 'CheckinModal',
    computed: {
        ...mapGetters(['user']),
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
                this.bookingTourForm.name = this.user.name;
                this.bookingTourForm.email = this.user.email;
                this.bookingTourForm.phone = this.user.phone;
                this.bookingTourForm.e164Phone = this.user.phone;
                this.bookingTourForm.country = this.user.country;
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
            this.bookingTourForm.e164Phone = event.e164;
            this.bookingTourForm.country = event.countryCode;
        },
        checkinTourRooms(){
            this.bookingTourForm.partial_payment ? this.bookingTourForm.partial_payment = 1 : this.bookingTourForm.partial_payment = 0;
            this.bookingTourForm.post("doBooking").then((res) => {
                if (res.data.success === 'true') {
                    this.bookingTourForm.reset();
                    // this.$store.dispatch('clearSearchHotels');
                    this.closeModal();
                } else {
                    this.bookingTourForm.errors.set(res.message);
                }
            }).catch(()=>{});
        },
        diffDate(date1, date2){
            const a = moment(date1);
            const b = moment(date2);
            return b.diff(a, 'days') + 1;
        },
        depositHotel(total, percentage){
            const discount = (total * percentage) / 100;
            this.bookingTourForm.deposit = discount;
            this.bookingTourForm.partial_payment ? this.bookingTourForm.paid = parseFloat(total - discount).toFixed(2) : this.bookingTourForm.paid = total;
            return parseFloat(total - discount).toFixed(2);
        }
    }
}
</script>
