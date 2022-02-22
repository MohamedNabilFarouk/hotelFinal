<template>
    <div>
        <Breadcrumbs PageTitle="Become A Vendor" PageLink="/become-a-vendor"
         backgroundImage="https://d-themes.com/wordpress/wolmart/elements/wp-content/uploads/sites/3/2021/05/banner-1.jpg" />

        <div class="container">
            <div class="contact-bot shadow mt-0 mb-5 clearfix">
                <form @submit.prevent="becomeVendorFun()" enctype="multipart/form-data" class="form-contact">
                    <h3>Join our partners your success</h3>

                    <p>List your hotel or tourism company and add housing units and tourist trips.</p>

                    <div class="form-group">
                        <label>Full Name
                            <input
                                :class="{
                                'is-invalid': vendorForm.errors.has('name')
                            }"
                                v-model="vendorForm.name"
                                type="name" placeholder="Your  Name" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('name')"
                              v-html="vendorForm.errors.get('name')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Your  Email
                            <input
                                :class="{
                                'is-invalid': vendorForm.errors.has('email')
                            }"
                                v-model="vendorForm.email"
                                type="email" placeholder="Your  email" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('email')"
                              v-html="vendorForm.errors.get('email')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Your Phone
                            <VuePhoneNumberInput
                                :show-code-on-list="true"
                                default-country-code="EG"
                                @update="updatedddd($event)"
                                :class="{
                                'is-invalid': vendorForm.errors.has('phone')
                            }"
                                v-model="vendorForm.phone"
                                placeholder="Your Phone" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('phone')"
                              v-html="vendorForm.errors.get('phone')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>password
                            <input
                                :class="{
                                'is-invalid': vendorForm.errors.has('password')
                            }"
                                v-model="vendorForm.password"
                                type="password" placeholder="password" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('password')"
                              v-html="vendorForm.errors.get('password')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>password confirmation
                            <input
                                :class="{
                                'is-invalid': vendorForm.errors.has('password_confirmation')
                            }"
                                v-model="vendorForm.password_confirmation"
                                type="password" placeholder="password confirmation" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('password_confirmation')"
                              v-html="vendorForm.errors.get('password_confirmation')">
                    </span>
                    </div>

                    <div class="form-group">
                        <label>company name
                            <input
                                :class="{
                                    'is-invalid': vendorForm.errors.has('company_name ')
                                }"
                                v-model="vendorForm.company_name"
                                type="text" placeholder="Company Name" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('company_name')"
                              v-html="vendorForm.errors.get('company_name')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Tax Card
                            <input
                                ref="taxCard"
                                @change="handleFileTaxCardUpload"
                                :class="{
                                    'is-invalid': vendorForm.errors.has('tax_card')
                                }"
                                type="file" placeholder="tax card" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('tax_card')"
                              v-html="vendorForm.errors.get('tax_card')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Commercial Record
                            <input
                                @change="handleFileCommercialRecordUpload"
                                ref="commercialRecord"
                                :class="{
                                'is-invalid': vendorForm.errors.has('commercial_record')
                                }"
                                type="file" placeholder="tax card" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('commercial_record')"
                              v-html="vendorForm.errors.get('commercial_record')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Bank Name
                            <input
                                :class="{
                                'is-invalid': vendorForm.errors.has('bank_name')
                                }"
                                v-model="vendorForm.bank_name"
                                type="text" placeholder="Bank Name" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('bank_name')"
                              v-html="vendorForm.errors.get('bank_name')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Bank Account
                            <input
                                :class="{
                                    'is-invalid': vendorForm.errors.has('bank_account')
                                }"
                                v-model="vendorForm.bank_account"
                                type="text" placeholder="Bank Account" />
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('bank_account')"
                              v-html="vendorForm.errors.get('bank_account')">
                        </span>
                    </div>

                    <div class="form-group">
                        <label>
                            <input style="display: inline-block;width: auto; margin: 0 5px 0 0;float: inherit;"
                                   v-model="vendorForm.vendor_terms_and_conditions"
                                   type="checkbox" placeholder="Read Vendor Terms And Conditions"
                            />

                            <h5 class="d-inline-block"> Read <router-link to="/vendor-terms-and-conditions">Vendor Terms And Conditions.</router-link></h5>
                        </label>
                        <span class="text-danger"
                              v-if="vendorForm.errors.has('vendor_terms_and_conditions')"
                              v-html="vendorForm.errors.get('vendor_terms_and_conditions')">
                        </span>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn text-capitalize button btn-primary">
                            <span v-if="vendorForm.busy" class="spinner-border spinner-border-sm"></span>
                            <i v-if="!vendorForm.busy" class="fa fa-address-card mr-1"></i>
                            Become A Vendor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Breadcrumbs from "./Layouts/Breadcrumbs";
import Form from "vform";
export default {
    name: 'BecomeVendor',
    components:{
        Breadcrumbs
    },
    data() {
        return {
            vendorForm: new Form({
                headers: {
                    'enctype': "multipart/form-data"
                },
                name: "",
                email: "",
                phone: "",
                e164Phone: "",
                country: "",
                password: "",
                password_confirmation: "",
                tax_card: "",
                commercial_record: "",
                bank_name: "",
                bank_account: "",
                company_name: "",
                vendor_terms_and_conditions: false,
                role: 3
            })
        }
    },
    methods: {
        updatedddd(event){
            this.vendorForm.e164Phone = event.e164;
            this.vendorForm.country = event.countryCode;
        },
        handleFileTaxCardUpload(){
            let selectedFiles = this.$refs.taxCard.files;
            if (selectedFiles.length > 0){
                this.vendorForm.tax_card = selectedFiles[0];
            }else {
                this.vendorForm.tax_card = "";
            }
        },
        handleFileCommercialRecordUpload(){
            let selectedFiles = this.$refs.commercialRecord.files;
            if (selectedFiles.length > 0){
                this.vendorForm.commercial_record = selectedFiles[0];
            }else {
                this.vendorForm.commercial_record = "";
            }
        },
        becomeVendorFun(){
            this.vendorForm.phone = this.vendorForm.e164Phone;
            this.vendorForm.post("user/store").then((res) => {
                if (res.data.status === 'success') {
                    this.$store.dispatch('login', this.vendorForm);
                    this.vendorForm.reset();
                    this.$refs.commercialRecord.value = null;
                    this.$refs.taxCard.value = null;
                } else {
                    this.vendorForm.errors.set(res.data.data);
                }
            }).catch();
        }
    }
}
</script>
