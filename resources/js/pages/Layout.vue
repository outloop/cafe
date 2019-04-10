<style>

</style>

<template>
    <div id="app-layout">
        <Navigation></Navigation>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navigation from '../components/global/Navigation'

    export default {
        components: {
            Navigation
        },
    }
</script>
