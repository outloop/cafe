<style>

</style>

<template>
    <div id="home">
        <span v-show="cafesLoadStatus == 1">Loading</span>
        <span v-show="cafesLoadStatus == 2">Cafes loaded successfully!</span>
        <span v-show="cafesLoadStatus == 3">Cafes loaded unsuccessfully!</span>
        <ul>
            <li v-for="cafe in cafes"><router-link :to="{ name: 'cafe', params: {id: cafe.id}}">{{ cafe.name }}</router-link></li>
        </ul>
    </div>
</template>

<script>

    export default {
        created() {
            this.$store.dispatch('loadCafes');
        },
        computed: {
            cafesLoadStatus() {
                return this.$store.getters.getCafesLoadStatus;
            },
            cafes(){
                return this.$store.getters.getCafes;
            }
        }
    }
</script>
