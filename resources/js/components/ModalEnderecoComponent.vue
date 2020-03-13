<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header"><h3>custom header</h3></div>
                    <div class="modal-body">
                         <div class="row">
                            <div class="col-md-8">
                                <label for="exampleInputPassword1">Descrição</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.descricao" />
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputPassword1">CEP</label>
                                <input v-on:blur="getCep()" :disabled="notEdit" v-mask="'#####-###'" class="form-control"  v-model="endereco.cep"  />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="exampleInputPassword1">Endereço</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.endereco" />
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">Numero</label>
                                <input class="form-control"  :disabled="notEdit" v-model="endereco.numero" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleInputPassword1">Bairro</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.bairro" />
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">Cidade</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.cidade" />
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">Estado</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.estado" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleInputPassword1">Complemento</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.complemento" />
                            </div>
                            <div class="col">
                                <label for="exampleInputPassword1">Referencia</label>
                                <input class="form-control" :disabled="notEdit" v-model="endereco.referencia"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">                      
                        <button type="button" v-if="!notEdit" class="btn btn-success"  @click="salvar()">Salvar</button>
                        <button type="button" v-if="!notEdit" class="btn btn-danger" @click="fechar()">Cancelar</button>
                        <button type="button" v-if="notEdit" class="btn btn-danger" @click="fechar()">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>

import axios from "axios";
export default {
    name: "Modal",
    props: {
        enderecoParent: Object,
        notEdit: Boolean
    },
    data(){
       return {           
            endereco: Object
        };
    },
    methods: {
        setEndereco(endParent){
            this.endereco = JSON.parse(JSON.stringify(endParent));
        },
        fechar() {
            this.$emit("fechar", false);
        },
        salvar(){            
            this.$emit("new-endereco", this.endereco);
            this.fechar();
        },
        getCep(){
            axios.get("http://viacep.com.br/ws/" + this.endereco.cep + '/json')
                .then(response => {
                    this.endereco.endereco = response.data.logradouro;
                    this.endereco.complemento = response.data.complemento;
                    this.endereco.estado = response.data.uf;
                    this.endereco.cidade = response.data.localidade;                    
                    this.endereco.bairro = response.data.bairro;                    

                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created(){
        this.setEndereco(this.enderecoParent);
    }
};
</script>

<style lang="css">
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    width: 900px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
    * The following styles are auto-applied to elements with
    * transition="modal" when their visibility is toggled
    * by Vue.js.
    *
    * You can easily play with the modal transition by editing
    * these styles.
    */

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>
