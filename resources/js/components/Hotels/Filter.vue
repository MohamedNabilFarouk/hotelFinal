<template>
    <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
        <span id="close-sidebar" class="fa fa-times"></span>
        <div class="module-search clearfix">
            <h3 class="modtitle">Hotel searching</h3>
            <form method="get" class="search-pr">
                <div class="search-item city">
                    <label>
                        Your Destination
                        <input type="text" placeholder="Your Destination">
                    </label>
                </div>
                <div class="search-item">
                    <label>
                        Day start
                        <input type="date" placeholder="Day start">
                    </label>
                </div>
                <div class="search-item">
                    <label>
                        Day end
                        <input type="date" placeholder="Day end">
                    </label>
                </div>
                <div class="search-item item-select">
                    <label>
                        Number People
                        <select>
                            <option value="1">1 people</option>
                            <option value="2">2 people</option>
                            <option value="3">3 people</option>
                            <option value="4">4 people</option>
                        </select>
                    </label>
                </div>
                <div class="search-item item-budget">
                    <label>
                        Max budget
                        <input type="number" placeholder="Max budget">
                    </label>
                </div>
                <div class="button-submit">
                    <button type="submit" class="button">Search Tour <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    <input type="hidden" name="s">
                    <input type="hidden" name="search_tour" value="1">
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
        // PageTitle: {type: String, default:  () => ('')},
    },
    data(){
        return{}
    },
    mounted() {
    },
    methods: {
    }
}
</script>
