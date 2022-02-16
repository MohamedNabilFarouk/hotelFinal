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
                check in Form
                {{bookingHotelForm}}
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
        ...mapGetters([
            'user'
        ]),
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
            }),
            checkinForm: new Form({})
        }
    },
    mounted() {
        this.checkinItem = !this.user ? "authItem" : "checkItem";
    },
    watch:{
        user: function () {
            this.checkinItem = !this.user ? "authItem" : "checkItem";
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
    }
}
</script>
