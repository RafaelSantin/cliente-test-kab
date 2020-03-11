<template>
  <div id="app">
    <header>
      <h1>Vue.js SPA</h1>
    </header>
    <main>
        <aside class="sidebar">
            <router-link
                v-bind:key="post.id"
                v-for="post in posts"
                active-class="is-active"
                class="link"
                :to="{ name: 'post', params: { id: post.id } }">
            {{post.id}}. {{post.title}}
            </router-link>
        </aside>
        <div class="content">
            <router-view></router-view>
        </div>
    </main>
  </div>
</template>

<script>
  function Crud({ id, color, name}) {
    this.id = id;
    this.color = color;
    this.name = name;
  }
 
  import TableComponent from './TableComponent.vue';

  import axios from 'axios'
    export default {
    data () {
        return {
            posts: null,
            endpoint: 'https://jsonplaceholder.typicode.com/posts/',
        }
    },

    created() {
        this.getAllPosts();
    },

    methods: {
        getAllPosts() {
        axios.get(this.endpoint)
            .then(response => {
                this.posts = response.data;
            })
            .catch(error => {
                console.log('-----error-------');
                console.log(error);
            })
        },
        async create() {
            // To do
        },
        async read() {
            // To do
        },
        async update(id, color) {
            // To do
        },
        async del(id) {
            // To do
        }
    },
    components: {
      TableComponent
    }
} 
</script>