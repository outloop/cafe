import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Home from './pages/Home'

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Vue.component('Home', Home)
        }
    ]
});
