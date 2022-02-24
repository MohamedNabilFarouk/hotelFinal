<template>
    <div class="breadcrumbs"
         :style="'background-image: url('+backgroundImage+')'">
        <div class="container">
            <div class="title-breadcrumb">
                {{PageTitle}}
            </div>
            <ul class="breadcrumb-cate">
                <li><router-link to="/">{{$t('home')}}</router-link></li>
                <li><router-link :to="'/'+PageLink">{{PageTitle}}</router-link></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Breadcrumbs',
    props: {
        PageTitle: {type: String, default:  () => ('')},
        PageLink: {type: String, default:  () => ('')},
        backgroundImage:{type: String, default:  () => ('')},
    },
    data(){
        return{
            hotels: [],
        }
    },
    mounted() {
    },
    methods: {
    }
}
</script>
