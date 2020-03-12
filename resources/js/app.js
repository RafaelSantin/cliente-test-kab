import Vue from 'vue'
import Router from 'vue-router'
import App from './components/App.vue'
import Form from './components/Form.vue'
import TableComponent from './components/TableComponent.vue'
Vue.use(Router)

const router = new Router({
 routes: [
   {
     path: '/',
     name:'home',
     component: TableComponent,
   },
   {
     path: '/post/:id',
     name:'form',
     component: Form,
     props: true,
   },
 ]
})

new Vue({
 el: '#app-vue',
 render: h => h(App),
 router
})