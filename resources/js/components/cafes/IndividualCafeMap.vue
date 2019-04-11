<style lang="scss">
    @import '~@/_variables.scss';

    div#individual-cafe-map {
        width: 700px;
        height: 500px;
        margin: auto;
        margin-bottom: 200px;
    }
</style>

<template>
    <div id="individual-cafe-map">

    </div>
</template>

<script>
    import {config} from '../../config.js';

    export default {
        computed: {
            cafeLoadStatus() {
                return this.$store.getters.getCafeLoadStatus;
            },

            cafe() {
                return this.$store.getters.getCafe;
            }
        },

        watch: {
            cafeLoadStatus() {
                if (this.cafeLoadStatus === 2) {
                    this.displayIndividualCafeMap();
                }
            }
        },

        methods: {

            displayIndividualCafeMap() {

                this.map = new AMap.Map('individual-cafe-map', {
                    center: [parseFloat(this.cafe.longitude), parseFloat(this.cafe.latitude)],
                    zoom: 15
                });

                var image = config.APP_URL + '/storage/img/coffee-marker.png';
                var icon = new AMap.Icon({
                    image: image,  // Icon的图像
                    imageSize: new AMap.Size(18, 18)
                });

                var marker = new AMap.Marker({
                    position: new AMap.LngLat(parseFloat(this.cafe.longitude), parseFloat(this.cafe.latitude)),
                    icon: icon
                });

                this.map.add(marker);
            }
        }
    }
</script>
