<template>
<div>
<!--    <div class="section-style1">-->
<!--&lt;!&ndash;        <div class="container page-builder-ltr">&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="row row-style row_a1">&ndash;&gt;-->
<!--&lt;!&ndash;                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c about-video">&ndash;&gt;-->
<!--                    <div class="ytvideo" :data-video="video"-->
<!--                        :style="'background-image: url('+backgroundImage+')'"-->
<!--                         style="width:100%; height:420px; background-repeat: no-repeat;-->
<!--                            background-position-x: center; background-position-y: center;-->
<!--                          background-size: cover;-->
<!--                        ">-->
<!--                        <div class="seo">Travel</div>-->
<!--                    </div>-->
<!--&lt;!&ndash;                </div>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;        </div>&ndash;&gt;-->
<!--    </div>-->
</div>
</template>

<script>
export default {
    name: 'BannerVideo',
    props: {
        video: {type: String, default:  () => ('')},
        backgroundImage: {type: String, default:  () => ('')},
    },
    data() {
        return {
        }
    },
    methods: {
    }
}

</script>
