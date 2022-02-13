<template>
    <div class="mt-5 travel-search-content">
        <div class="container page-builder-ltr">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button
                        @click="switchFormSearch('hotelSearch')"
                        :class="hotelSearch ? 'active': ''"
                        class="nav-link">
                        <i class="fa fa-building-o mr-1"></i>
                        Hotels
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        @click="switchFormSearch('tourSearch')"
                        :class="tourSearch ? 'active': ''"
                        class="nav-link">
                        <i class="fa fa-pagelines mr-1"></i>
                        tours
                    </button>
                </li>
            </ul>

            <form v-if="hotelSearch" @submit.prevent="searchHotel()"
              class="row py-3 shadow-lg justify-content-between align-items-center">

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="form-group location-input">
                        <label>Destinations
                            <v-select
                                v-model="searchHotelsForm.sCity"
                                :class="{
                                    'is-invalid': searchHotelsForm.errors.has('city')
                                }"
                                autocomplete="on"
                                placeholder="City, region or anywhere"
                                :get-option-label="(option) => option.name"
                                :options="cities"></v-select>
                        </label>
                        <span class="text-danger"
                          v-if="searchHotelsForm.errors.has('city')"
                          v-html="searchHotelsForm.errors.get('city')">
                        </span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="form-group">
                        <label>date from
                            <input
                                :class="{
                                    'is-invalid': searchHotelsForm.errors.has('date_from')
                                }"
                                v-model="searchHotelsForm.date_from"
                                type="date" placeholder="date from" />
                        </label>
                        <span class="text-danger"
                              v-if="searchHotelsForm.errors.has('date_from')"
                              v-html="searchHotelsForm.errors.get('date_from')">
                        </span>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="form-group">
                        <label>date to
                            <input
                                :class="{
                                    'is-invalid': searchHotelsForm.errors.has('date_to')
                                }"
                                v-model="searchHotelsForm.date_to" type="date" placeholder="date to" />
                        </label>
                        <span class="text-danger"
                              v-if="searchHotelsForm.errors.has('date_to')"
                              v-html="searchHotelsForm.errors.get('date_to')">
                        </span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <label>adults
                                    <input
                                        :class="{
                                        'is-invalid': searchHotelsForm.errors.has('adult')
                                        }"
                                        type="number" v-model="searchHotelsForm.adult" placeholder="adults" />
                                </label>
                                <span class="text-danger"
                                      v-if="searchHotelsForm.errors.has('adult')"
                                      v-html="searchHotelsForm.errors.get('adult')">
                                </span>
                            </div>

                            <div class="mx-2"></div>

                            <div>
                                <label>children
                                    <input
                                        :class="{
                                        'is-invalid': searchHotelsForm.errors.has('children')
                                        }"
                                        min="0" type="number" v-model="searchHotelsForm.children" placeholder="children" />
                                </label>
                                <span class="text-danger"
                                      v-if="searchHotelsForm.errors.has('children')"
                                      v-html="searchHotelsForm.errors.get('children')">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 text-center col-md-12 col-12">
                    <button type="submit" class="btn button btn-primary">
                        search
                        <span v-if="searchHotelsForm.busy" class="spinner-border spinner-border-sm"></span>
                        <i v-if="!searchHotelsForm.busy" aria-hidden="true" class="fa fa-search"></i>
                    </button>
                </div>
            </form>

            <form v-if="tourSearch" @submit.prevent="" class="row py-3 shadow-lg justify-content-between align-items-center">

                <div class="col-lg-4 col-md-4 col-6">
                    <div class="form-group location-input">
                        <label>Destinations
                            <v-select
                                autocomplete="on"
                                placeholder="City, region or anywhere"
                                :get-option-label="(option) => option.name"
                                :options="cities"></v-select>
                        </label>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-6">
                    <div class="form-group">
                        <label>date
                            <input type="date" placeholder="date" />
                        </label>
                    </div>
                </div>

                <div class="col-lg-4 text-center col-md-12 col-12">
                    <button type="submit" class="btn button btn-primary">
                        search
                        <i aria-hidden="true" class="fa fa-angle-right"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>
<script>
import Form from "vform";
export default {
name: 'Search',
    data() {
        return {
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
            })
        }
    },
    mounted(){
        this.getCities();
    },
    methods: {
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
            this.searchHotelsForm.city =  this.searchHotelsForm.sCity.id ? this.searchHotelsForm.sCity.id : '';
            this.searchHotelsForm.get("searchHotel").then((res)=>{
                    if (res.data.success === 'true'){
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
        }
    }
}
</script>
