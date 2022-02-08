<template>
    <div class="mt-5 pt-5 travel-search-content">
        <div class="container page-builder-ltr">
            <div class="row">
                <form method="get" class="travl-search-advanced border-1 clearfix">
                    <div class="search-item city pull-left">
                        <p>Destinations</p>
                        <input type="text" class="tour-search-input" id="city" placeholder="City, region or anywhere">
                    </div>
                    <div class="search-item date pull-left">
                        <p>Check in</p>
                        <input type="text" class="tour-search-input datepicker hasDatepicker" id="date_from" placeholder="DD/MM/YY">
                    </div>
                    <div class="search-item date pull-left">
                        <p>Check out</p>
                        <input type="text" class="tour-search-input datepicker hasDatepicker" id="date_to" placeholder="DD/MM/YY">
                    </div>
                    <div class="search-item item-select pull-left">
                        <p>People</p>
                        <select name="people">
                            <option value="1">1 people</option>
                            <option value="2">2 people</option>
                            <option value="3">3 people</option>
                            <option value="4">4 people</option>
                        </select>
                    </div>
                    <div class="search-item item-budget pull-left">
                        <p>Max Budget</p>
                        <input type="number" class="hotel-budget-input" id="budget" placeholder="$1000">
                    </div>
                    <div class="search-item button-submit pull-left">
                        <p>.</p>
                        <button type="submit" class="button">Search Tour <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        <input type="hidden" name="s">
                        <input type="hidden" name="search_tour" value="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>

export default {
name: 'Search',
    data() {
        return {

        }
    }
}
</script>
