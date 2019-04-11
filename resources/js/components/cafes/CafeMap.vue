<style lang="scss">
    div#cafe-map {
        width: 100%;
        height: 400px;
    }
</style>

<template>
    <div id="cafe-map">

    </div>
</template>

<script>
    import {config} from '../../config';
    export default {
        props: {
            'latitude': {  // 经度
                type: Number,
                default: function () {
                    return 113.27
                }
            },
            'longitude': {  // 纬度
                type: Number,
                default: function () {
                    return 23.13
                }
            },
            'zoom': {   // 缩放级别
                type: Number,
                default: function () {
                    return 5
                }
            }
        },
        data() {
            return {
                markers: [],
                infoWindwos: []
            }
        },
        mounted() {
            this.map = new AMap.Map('cafe-map', {
                center: [this.latitude, this.longitude],
                zoom: this.zoom
            });
            this.clearMarkers();
            this.buildMarkers();
        },
        computed: {
            cafes() {
                return this.$store.getters.getCafes;
            }
        },
        methods: {
            buildMarkers() {
                const img = config.APP_URL + '/storage/img/coffee-marker.png';
                const icon = new AMap.Icon({
                    image: img,
                    imageSize: new AMap.Size(18,18)
                });
                // 清空点标记数组
                this.markers = [];

                // 遍历所有咖啡店并为每个咖啡店创建点标记
                for (var i = 0; i < this.cafes.length; i++) {

                    // 通过高德地图 API 为每个咖啡店创建点标记并设置经纬度
                    var marker = new AMap.Marker({
                        position: new AMap.LngLat(parseFloat(this.cafes[i].longitude), parseFloat(this.cafes[i].latitude)),
                        title: this.cafes[i].name,
                        icon: icon
                    });

                    var infoWindow = new AMap.InfoWindow({
                        content: this.cafes[i].name
                    });
                    this.infoWindwos.push(infoWindow);
                    marker.on('click', function () {
                        infoWindow.open(this.getMap(), this.getPosition());
                    });
                    // 将每个点标记放到点标记数组中
                    this.markers.push(marker);
                }
                // 将所有点标记显示到地图上
                this.map.add(this.markers);
            },
            clearMarkers() {
                // 遍历所有点标记并将其设置为 null 从而从地图上将其清除
                for (var i = 0; i < this.markers.length; i++) {
                    this.markers[i].setMap(null);
                }
            }
        },
        watch: {
            // 一旦 cafes 有更新立即重构地图点标记
            cafes() {
                this.clearMarkers();
                this.buildMarkers();
            }
        }
    }
</script>
