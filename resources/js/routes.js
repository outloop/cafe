import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Layout from './pages/layout'
import Home from './pages/Home'
import NewCafe from './pages/NewCafe'

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'layout',
            component: Vue.component('Layout', Layout),
            children: [
                {
                    path: 'home',
                    name: 'home',
                    component: Vue.component('Home', Home)
                },
                {
                    path: 'cafes/new',
                    name: 'newcafe',
                    component: Vue.component('NewCafe', NewCafe)
                }
            ]
        }
    ]
});
