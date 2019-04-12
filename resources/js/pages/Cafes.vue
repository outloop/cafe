<style>

</style>
<template>
    <div id="cafes">
        <div class="grid-x">
            <div class="large-9 medium-9 small-12 cell">
                <cafe-map></cafe-map>
            </div>
            <div class="large-3 medium-3 small-12 cell">
                <ul>
                    <li v-for="cafe in cafes"><router-link :to="{ name: 'cafe', params: {id: cafe.id}}">{{ cafe.name }}</router-link></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    import CafeMap from '../components/cafes/CafeMap.vue';
    export default {
        components: {
            CafeMap
        },
        created(){
            this.$store.dispatch('loadCafes');
            this.$store.dispatch('loadBrewMethods');
        },
        computed:{
            cafes(){
                return this.$store.getters.getCafes;
            }
        }
    }
</script>
