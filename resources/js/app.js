import Vue from 'vue'
import Router from 'vue-router'
import App from './components/App.vue'
import Form from './components/Form.vue'
import TableComponent from './components/TableComponent.vue'
import VueTheMask from 'vue-the-mask'
import { VueMaskDirective } from 'v-mask'


Vue.directive('mask', VueMaskDirective);

Vue.use(Router)
Vue.use(VueTheMask)


Vue.component('my-component-name', { /* ... */ })

const router = new Router({
 routes: [
   {
     path: '/',
     name:'home',
     component: TableComponent,
   },
   {
     path: '/cliente/:id',
     name:'form',
     component: Form,
     props: true,
   },
   {
     path: '/cliente/',
     name:'new',
     component: Form,
   },
 ]
})

new Vue({
 el: '#app-vue',
 render: h => h(App),
 router
})