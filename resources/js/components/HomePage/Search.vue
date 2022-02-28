<template>
    <div class="my-3 travel-search-content">
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button
                        @click="switchFormSearch('hotelSearch')"
                        :class="hotelSearch ? 'active': ''"
                        class="nav-link text-capitalize">
                        <i class="fa fa-building-o"></i>
                        {{$t('hotels')}}
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        @click="switchFormSearch('tourSearch')"
                        :class="tourSearch ? 'active': ''"
                        class="nav-link text-capitalize">
                        <i class="fa fa-pagelines"></i>
                        {{$t('tours')}}
                    </button>
                </li>
            </ul>

            <form v-if="hotelSearch" @submit.prevent="searchHotel()"
              class="row py-3 shadow-lg justify-content-between align-items-center">

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="mb-3">
                        <label for="city" class="form-label text-capitalize">{{$t('city')}}</label>
                        <v-select
                            v-model="searchHotelsForm.sCity"
                            :class="{
                                'is-invalid': searchHotelsForm.errors.has('city')
                            }"
                            autocomplete="on"
                            id="city"
                            :placeholder="$t('city')"
                            :get-option-label="(option) => option.name"
                            :options="cities"></v-select>
                        <div class="invalid-feedback"
                          v-if="searchHotelsForm.errors.has('city')"
                          v-html="searchHotelsForm.errors.get('city')">
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="mb-3">
                        <label for="date_from" class="form-label text-capitalize">{{$t('date from')}}</label>
                        <vuejs-datepicker :disabledDates="disabledTodayDates" :format="customFormatter"  v-model="searchHotelsForm.date_from" :placeholder="$t('date from')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': searchHotelsForm.errors.has('date_from')}"></vuejs-datepicker>
                        <div class="invalid-feedback" v-if="searchHotelsForm.errors.has('date_from')" v-html="searchHotelsForm.errors.get('date_from')"></div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="mb-3">
                        <label for="date_to" class="form-label text-capitalize">{{$t('date to')}}</label>
                        <vuejs-datepicker :disabledDates="disabledTomorrowDates" :format="customFormatter"  v-model="searchHotelsForm.date_to" :placeholder="$t('date to')" :bootstrap-styling="true" input-class="form-control" :class="{'is-invalid': searchHotelsForm.errors.has('date_to')}"></vuejs-datepicker>
                        <div class="invalid-feedback"
                              v-if="searchHotelsForm.errors.has('date_to')"
                              v-html="searchHotelsForm.errors.get('date_to')">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <label for="adult" class="form-label text-capitalize">{{$t('adults')}}</label>
                                <input type="number" :class="{'is-invalid': searchHotelsForm.errors.has('adult')}" v-model="searchHotelsForm.adult" class="form-control" id="adult" :placeholder="$t('adults')">
                                <div class="invalid-feedback"
                                      v-if="searchHotelsForm.errors.has('adult')"
                                      v-html="searchHotelsForm.errors.get('adult')">
                                </div>
                            </div>

                            <div class="mx-2"></div>

                            <div>
                                <label for="children" class="form-label text-capitalize">{{$t('children')}}</label>
                                <input type="number" :class="{'is-invalid': searchHotelsForm.errors.has('children')}" v-model="searchHotelsForm.children" class="form-control" id="children" :placeholder="$t('children')">
                                <div class="invalid-feedback"
                                      v-if="searchHotelsForm.errors.has('children')"
                                      v-html="searchHotelsForm.errors.get('children')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 text-center col-md-12 col-12">
                    <button type="submit" class="btn btn-sm btn-info">
                        {{$t('search')}}
                        <span v-if="searchHotelsForm.busy" class="spinner-border spinner-border-sm"></span>
                        <i v-if="!searchHotelsForm.busy" aria-hidden="true" class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <form v-if="tourSearch" @submit.prevent="searchTour()" class="row py-3 shadow-lg justify-content-between align-items-center">

                <div class="col-lg-4 col-md-4 col-6">
                    <div class="mb-3">
                        <label for="searchToursForm-city" class="form-label text-capitalize">{{$t('city')}}</label>
                        <v-select v-model="searchToursForm.sCity" :class="{'is-invalid': searchToursForm.errors.has('city')}" autocomplete="on" id="searchToursForm-city"
                            :placeholder="$t('city')" :get-option-label="(option) => option.name" :options="cities"></v-select>
                        <div class="invalid-feedback"
                             v-if="searchToursForm.errors.has('city')"
                             v-html="searchToursForm.errors.get('city')">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-6">
                    <div class="mb-3">
                        <label for="date" class="form-label text-capitalize">{{$t('date')}}</label>
                        <input type="date" :class="{'is-invalid': searchToursForm.errors.has('date')}" v-model="searchToursForm.date" class="form-control" id="date" :placeholder="$t('date')">
                        <div class="invalid-feedback"
                             v-if="searchToursForm.errors.has('date')"
                             v-html="searchToursForm.errors.get('date')">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-center col-md-12 col-12">
                    <button type="submit" class="btn btn-sm btn-info text-capitalize">
                        {{$t('search')}}
                        <span v-if="searchToursForm.busy" class="spinner-border spinner-border-sm"></span>
                        <i v-if="!searchToursForm.busy" aria-hidden="true" class="fa fa-search"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>
<script>
import Form from "vform";
import { mapGetters } from 'vuex';

export default {
name: 'Search',
    data() {
        return {
            disabledTodayDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledTomorrowDates: {
                to: new Date(Date.now())
            },
            hotelSearch: true,
            tourSearch: false,
            cities: [],
            searchHotelsForm: new Form({
                city: '',
                sCity: '',
                date_from: '',
                date_to: '',
                adult: 2,
                children: 0
            }),
            searchToursForm: new Form({
                city: '',
                sCity: '',
                date: ''
            })
        }
    },
    computed: {
        ...mapGetters([
            'searchHotels', 'searchTours'
        ])
    },
    mounted(){
        this.getCities();
        this.searchHotelsForm.fill(this.searchHotels ? this.searchHotels : '');
        this.searchToursForm.fill(this.searchTours ? this.searchTours : '');
    },
    methods: {
        customFormatter(date) {
            return moment(date).format('DD-MM-YYYY');
        },
        getCities(){
            axios.get('cities')
                .then((res)=>{
                    this.cities = res.data.data && res.data.data.cities ? res.data.data.cities : [];
                })
                .catch();
        },
        switchFormSearch(switcher){
            if (switcher === 'hotelSearch'){
                this.hotelSearch = true;
                this.tourSearch = false;
            }else {
                this.hotelSearch = false;
                this.tourSearch = true;
            }
        },
        searchHotel(){
            this.searchHotelsForm.city =  this.searchHotelsForm.sCity ? this.searchHotelsForm.sCity.id : '';
            this.searchHotelsForm.get("searchHotel").then((res)=>{
                    if (res.data.success === 'true'){
                        this.$store.dispatch('searchHotels', this.searchHotelsForm);
                        this.$router.push({
                            name: 'Hotels',
                            params:{
                                search: true,
                                hotels: res.data.data.hotels,
                                formData: this.searchHotelsForm
                            },
                        }).catch(()=>{});

                    }else{
                        this.searchHotelsForm.errors.set(res.data.data);
                    }
                }).catch(()=>{});
        },
        searchTour(){
            this.searchToursForm.city =  this.searchToursForm.sCity ? this.searchToursForm.sCity.id : '';
            this.searchToursForm.get("searchTour").then((res)=>{
                if (res.data.success === 'true'){
                    this.$store.dispatch('searchTours', this.searchToursForm);
                    this.$router.push({
                        name: 'Tours',
                        params:{
                            search: true,
                            tours: res.data.data.tours,
                            formData: this.searchToursForm
                        },
                    }).catch(()=>{});

                }else{
                    this.searchToursForm.errors.set(res.data.data);
                }
            }).catch(()=>{});
        }
    }
}
</script>
