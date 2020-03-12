<template>
    <div class="post" v-if="cliente">
        <div class="row">
            <div class="col-md-8">
                <label for="exampleInputPassword1">Nome</label>
                <input class="form-control" v-model="cliente.nome" :disabled="notEdit" />
            </div>
            <div class="col">
                <label for="exampleInputPassword1">Nascimento</label>
                <input class="form-control" v-model="cliente.data_nascimento" :disabled="notEdit" />
            </div>
        </div>
            
        <div class="row">
            <div class="col">
                <label for="exampleInputPassword1">Telefone</label>
                <input type="text" v-model="cliente.telefone" class="form-control" placeholder="Telefone" :disabled="notEdit"/>
            </div>
            <div class="col">
            <label for="exampleInputPassword1">CPF</label>
                <input type="text" v-model="cliente.cpf" class="form-control" placeholder="CPF" :disabled="notEdit" />
            </div>
            <div class="col">
            <label for="exampleInputPassword1">RG</label>
                <input type="text" v-model="cliente.rg" class="form-control" placeholder="RG" :disabled="notEdit" />
            </div>
        </div>
        <div class="mt-5 row">
            <div class=" col-md-6">
                <button type="button" class="btn btn-primary">Voltar</button>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-success" v-if="!notEdit" @click="salvar()">Salvar</button>
                <button type="button" class="btn btn-danger" v-if="!notEdit" @click="cancelar()">Cancelar</button>
                <button type="button" class="btn btn-danger"  @click="inEdit()">Editar</button>
            </div>
        </div>
        
    </div>
</template>
<script>
import axios from "axios";

export default {
    props: ["id"],
    data() {
        return {
            cliente: null,
            clienteOld: null,
            notEdit: true,
            endpoint: "https://jsonplaceholder.typicode.com/posts/"
        };
    },
    methods: {
        getCliente(id) {
            axios
                .get("/api/clientes/" + id)
                .then(response => {
                    this.cliente = response.data;
                    //copia o resultado para poder usar o cancel
                    this.clienteOld = JSON.parse(JSON.stringify(this.cliente));

                })
                .catch(error => {
                    console.log(error);
                });
        },
        inEdit(){
            this.notEdit = !this.notEdit;
        },
        salvar(){
            axios
                .post("/api/clientes/", JSON.parse(JSON.stringify(this.cliente)))
                .then(response => {                    
                    console.log('salvou');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cancelar(){
            //this.inEdit();
            this.cliente = this.clienteOld;
        }
    },

    created() {
        this.getCliente(this.id);
    }
};
</script>
