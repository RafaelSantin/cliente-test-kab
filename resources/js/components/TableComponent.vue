<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts" v-bind:key="post.cliente_id">
                            <td>{{ post.cliente_id }}</td>
                            <td>{{ post.cliente_nome }}</td>
                            <td>
                                <button type="button" class="btn btn-success">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
function Crud({ id, color, name }) {
    this.id = id;
    this.color = color;
    this.name = name;
}

import TableComponent from "./TableComponent.vue";

import axios from "axios";
export default {
    data() {
        return {
            posts: null,
            endpoint: "https://api.myjson.com/bins/6zu12"
        };
    },

    created() {
        this.getAllPosts();
    },

    methods: {
        getAllPosts() {
            axios
                .get(this.endpoint)
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.log("-----error-------");
                    console.log(error);
                });
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
};
</script>
