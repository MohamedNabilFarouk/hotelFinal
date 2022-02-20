<template>
    <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
        <span id="close-sidebar" class="fa fa-times"></span>

        <div class="module-search clearfix">
            <h3 class="modtitle">Hotel searching</h3>
            <form @submit.prevent=""
                  class="row py-3 justify-content-between align-items-center">

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group location-input">
                        <label>Destinations
                            <select placeholder="City, region or anywhere">
                                <option>City</option>
                                <option>City</option>
                                <option>City</option>
                                <option>City</option>
                                <option>City</option>
                                <option>City</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                        <label>date
                            <input type="date" placeholder="date from" />
                        </label>
                    </div>
                </div>


                <div class="col-lg-12 text-center col-md-12 col-12">
                    <button type="submit" class="btn btn-sm button btn-primary">
                        Search
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="module-travel clearfix">
            <h3>travel style</h3>
            <ul>
                <li class="active"><a href="#"><span>Holiday</span><label>15</label></a></li>
                <li><a href="#"><span>Adventure</span><label>20</label></a></li>
                <li><a href="#"><span>Family Tour</span><label>5</label></a></li>
                <li><a href="#"><span>Cheap Trip</span><label>30</label></a></li>
                <li><a href="#"><span>Open Tour</span><label>18</label></a></li>
                <li><a href="#"><span>Classic Tour</span><label>6</label></a></li>
            </ul>
        </div>
        <div class="module-rate clearfix">
            <h3>star rating</h3>
            <ul>
                <li class="active"><a href="#"><div class="star"><span style="width: 75px"></span></div><label>15</label></a></li>
                <li><a href="#"><div class="star"><span style="width: 60px"></span></div><label>35</label></a></li>
                <li><a href="#"><div class="star"><span style="width: 45px"></span></div><label>20</label></a></li>
                <li><a href="#"><div class="star"><span style="width: 30px"></span></div><label>8</label></a></li>
                <li><a href="#"><div class="star"><span style="width: 15px"></span></div><label>4</label></a></li>
            </ul>
        </div>
        <div class="module-ques clearfix">
            <h3>get a questions</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem que laudantium.</p>
            <ul>
                <li><i class="fa fa-phone" aria-hidden="true"></i>+1 2618 181 612</li>
                <li><i class="fa fa-envelope" aria-hidden="true"></i>travelsp@gmail.com</li>
            </ul>
        </div>
        <div class="module-pop clearfix">
            <h3>popular tours</h3>
            <div class="item clearfix">
                <div class="image">
                    <a href="tour-detail.html"><img src="https://demo.wpthemego.com/html/sw_portkey/image/catalog/demo/product/travel/p1.jpg" alt="Bougainvilleas on Lombard Street" class="img-responsive"></a>
                </div>
                <div class="content">
                    <h4><a href="tour-detail.html">7-Day Great Britain Tour Packag...</a></h4>
                    <p>from $250</p>
                </div>
            </div>
            <div class="item clearfix">
                <div class="image">
                    <a href="tour-detail.html"><img src="image/catalog/demo/product/travel/p2.jpg" alt="Bougainvilleas on Lombard Street" class="img-responsive"></a>
                </div>
                <div class="content">
                    <h4><a href="tour-detail.html">7-Day Great Britain Tour Packag...</a></h4>
                    <p>from $250</p>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
export default {
    name: 'HotelsFilter',
    props: {
    },
    data(){
        return{
        }
    },
    mounted() {
    },
    methods: {
    }
}
</script>
