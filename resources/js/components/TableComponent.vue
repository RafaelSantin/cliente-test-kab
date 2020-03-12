<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col-6">Nome</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="post in posts" v-bind:key="post.id">
                            <td>{{ post.id }}</td>
                            <td style="width:400px;">{{ post.nome }}</td>
                            <td > 
                                <button type="button" class="btn btn-success" @click="goToEdit(post.id)">
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
            endpoint: "/api/clientes"
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
        goToEdit(id) {
            this.$router.push({ name: 'form', params: { id: id } });
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
