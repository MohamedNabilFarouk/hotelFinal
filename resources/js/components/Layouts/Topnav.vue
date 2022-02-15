<template>
    <div class="header-bonus">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="bonus-login pull-left">
                        <button v-if="user" class="btn-link dropdown-toggle" data-toggle="dropdown">
                            {{user.name}}
                            <span class="hidden-xs hidden-sm hidden-md"></span> <i class="fa fa-angle-down"></i>
                        </button>
                        <ul v-if="user" class="dropdown-menu">
                            <li>
                                <button @click="logout()" class="btn-block language-select" type="button">
                                    {{$t('logout')}}
                                </button>
                            </li>
                        </ul>

                        <span v-if="!user" @click="showModal()" class="cursor-pointer">
                            <i class="fa fa fa-address-card" aria-hidden="true"></i>
                            {{$t('login')}}
                            {{$t('or')}}
                            {{$t('registration')}}
                        </span>
                    </div>
                    <div class="bonus-language pull-left">
                        <div class="btn-group">
                            <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                                {{$t('lang')}}
                                <span class="hidden-xs hidden-sm hidden-md"></span> <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button @click="langChange('ar')" class="btn-block language-select" type="button" name="ar-ar">
                                        <img src="https://hoteelsegypt.com/libs/flags/flags/4x3/eg.svg"
                                             alt="Ar" title="Ar" />
                                        {{$t('arabic')}}
                                    </button>
                                </li>
                                <li>
                                    <button @click="langChange('en')" class="btn-block language-select" type="button" name="en-gb">
                                        <img src="https://hoteelsegypt.com/libs/flags/flags/4x3/gb.svg" alt="En" title="En" />
                                        {{$t('english')}}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="bonus-social pull-right">
                        <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    </ul>
                    <div class="bonus-mail pull-right">
                        <a target="_blank" href="mailto:info@hoteelsegypt.com">info@hoteelsegypt.com</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- auth modal  -->
        <modal :scrollable="true" width="350px" height="auto" name="authModal">
            <div class="tt_popup_modal">
                <i @click="closeModal()" class="fa fa-times-circle close-modal"></i>
                <strong>
                    <i class="fa fa fa-address-card" aria-hidden="true"></i>
                    {{$t('login')}}
                    {{$t('or')}}
                    {{$t('registration')}}
                </strong>
            </div>

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

        </modal>
        <!-- end auth modal-->
    </div>
</template>
<script>
import Form from "vform";
import { mapGetters } from 'vuex';
export default {
name: 'Topnav',
    computed: {
        ...mapGetters([
            'user'
        ])
    },
    data() {
        return {
            registration: true,
            login: false,
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
    mounted(){
        // console.log(this.$route.name);
    },
    methods: {
        showModal(){
            this.$modal.show('authModal');
        },
        closeModal(){
            this.$modal.hide('authModal');
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
        langChange(lang) {
            localStorage.setItem("lang", lang);
            window.location.reload();
        },
        registrationFun() {
            this.authForm.phone = this.authForm.e164Phone;
            this.authForm.post("user/store").then((res) => {
                if (res.data.success === 'true') {
                    this.closeModal();
                    this.$store.dispatch('login', this.authForm);
                } else {
                    this.authForm.errors.set(res.data.data);
                }
            }).catch();
        },
        loginFun(){
            this.authForm.post("user/login").then((res) => {
                if (res.data.status === 'success') {
                    this.closeModal();
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
        logout(){
            this.$store.dispatch('logout');
            this.showModal();
        }
    }
}
</script>
