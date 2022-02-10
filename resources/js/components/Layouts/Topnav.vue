<template>
    <div class="header-bonus">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="bonus-login pull-left">
                        <a href="login">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            {{$t('login')}}
                            {{$t('or')}}
                            {{$t('registration')}}
                        </a>
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
    </div>
</template>
<script>
export default {
name: 'Topnav',

    data() {
        return {
        }
    },
    methods: {
        langChange(lang) {
            localStorage.setItem("lang", lang);
            window.location.reload();
        },
    }
}
</script>
