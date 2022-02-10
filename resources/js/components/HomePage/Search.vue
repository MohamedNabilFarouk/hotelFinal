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

            <form v-if="hotelSearch" @submit.prevent="" class="row py-3 shadow-lg justify-content-between align-items-center">

                <div class="col-lg-3 col-md-3 col-6">
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

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="form-group">
                        <label>date from
                            <input type="date" placeholder="date from" />
                        </label>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="form-group">
                        <label>date to
                            <input type="date" placeholder="date to" />
                        </label>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label>adults
                                <input min="1" type="number" v-model="searchForm.people.adult" placeholder="adults" />
                            </label>

                            <div class="mx-2"></div>

                            <label>children
                                <input min="0" type="number" v-model="searchForm.people.children" placeholder="children" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 text-center col-md-12 col-12">
                    <button type="submit" class="btn button btn-primary">
                        search
                        <i aria-hidden="true" class="fa fa-angle-right"></i>
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
import Form from 'vform';
export default {
name: 'Search',
    data() {
        return {
            hotelSearch: true,
            tourSearch: false,
            cities: [
                {id: 1, name: 'cairo'},
                {id: 2, name: 'aswan'},
                {id: 3, name: 'sa sas a'},
                {id: 4, name: 'sadad asdasd '},
                {id: 5, name: 'fsdf sdfsd '},
                {id: 6, name: 'sa  fsdf  a'},
            ],
            searchForm: new Form({
                city: '',
                date_from: '',
                date_to: '',
                people: {adult: 2, children: 0}
            })
        }
    },
    methods: {
        switchFormSearch(switcher){
            if (switcher === 'hotelSearch'){
                this.hotelSearch = true;
                this.tourSearch = false;
            }else {
                this.hotelSearch = false;
                this.tourSearch = true;
            }
        }
    }
}
</script>
