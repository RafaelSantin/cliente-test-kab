<template>
    <div class="post" v-if="cliente">
        <div class="row">
            <div class="col-md-8">
                <label for="exampleInputPassword1">Nome</label>
                <input
                    class="form-control"
                    v-model="cliente.nome"
                    :disabled="notEdit"
                />
            </div>
            <div class="col">
                <label for="exampleInputPassword1">Nascimento</label>
                <datepicker :format="customFormatter" input-class="form-control" :disabled="notEdit" v-model="cliente.data_nascimento"></datepicker>
                <!-- <input
                    class="form-control"
                    v-model="cliente.data_nascimento"
                    :disabled="notEdit"
                /> -->
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputPassword1">Telefone</label>
                <the-mask
                    :disabled="notEdit"
                    class="form-control"
                    v-model="cliente.telefone"
                    :mask="['(##) ####-####', '(##) #####-####']"
                />
                <!-- <input
                    type="text"
                    v-model="cliente.telefone"
                    class="form-control"
                    placeholder="Telefone"
                    :disabled="notEdit"
                /> -->
            </div>
            <div class="col">
                <label for="exampleInputPassword1">CPF</label>
                <the-mask
                    placeholder="CPF"
                    class="form-control"
                    :disabled="notEdit"
                    v-model="cliente.cpf"
                    :mask="['###.###.###-##']"
                />

                <!-- <input
                    type="text"
                    v-model="cliente.cpf"
                    class="form-control"
                    placeholder="CPF"
                    :disabled="notEdit"
                /> -->
            </div>
            <div class="col">
                <label for="exampleInputPassword1">RG</label>
                <the-mask
                    placeholder="RG"
                    class="form-control"
                    :disabled="notEdit"
                    v-model="cliente.rg"
                    :mask="['##.###.###-X']"
                />

                <!-- <input
                    type="text"
                    v-model="cliente.rg"
                    class="form-control"
                    placeholder="RG"
                    :disabled="notEdit"
                /> -->
            </div>
        </div>
        <div class="container">
            <div class="mt-5 row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col-8">Endereços</th>
                                <th scope="col-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="!enderecos.length">
                                <td colspan="2">Sem Endereços</td>
                            </tr>
                            <tr
                                v-for="(end, index) in enderecos"
                                v-bind:key="index"
                            >
                                <td style="width:400px;">
                                    {{ end.descricao }}
                                </td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-success"
                                         v-if="!notEdit"
                                        @click="abrirModalEndereco(end, index, true)"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        type="button"
                                         v-if="!notEdit"
                                        class="btn btn-danger"
                                        @click="excluirEndereco(index)"
                                    >
                                        Excluir
                                    </button>
                                    <button
                                        type="button"
                                         v-if="notEdit"
                                        class="btn btn-primary"
                                        @click="abrirModalEndereco(end, index)"
                                    >
                                        Ver
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-5 row">
            <div class=" col-md-6">
                <button type="button" class="btn btn-primary" @click="voltarLista">Voltar</button>
            </div>
            <div class="col-md-6 text-right">
                <button
                    type="button"
                    class="btn btn-success"
                    v-if="!notEdit"
                    @click="abrirModalEndereco(null, null)"
                >
                    Adicionar endereço
                </button>
                <button
                    type="button"
                    class="btn btn-success"
                    v-if="!notEdit"
                    @click="salvar()"
                >
                    Salvar
                </button>
                <button
                    type="button"
                    class="btn btn-danger"
                    v-if="showCancel"
                    @click="cancelar()"
                >
                    Cancelar
                </button>
                <button type="button"  v-if="notEdit" class="btn btn-danger" @click="inEdit()">
                    Editar
                </button>
            </div>
        </div>
        <ModalEndereco
            v-if="modalOpen"
            :enderecoParent="enderecoToEdit"
            @fechar="modalOpen = false"
            :notEdit="notEdit"
            @new-endereco="salvarEndereco"
        ></ModalEndereco>
    </div>
</template>
<script>
import axios from "axios";

import ModalEndereco from "./ModalEnderecoComponent.vue";
import Datepicker from 'vuejs-datepicker';
import moment from 'moment'


export default {
    props: ["id"],
    data() {
        console.log('oeee');
        return {
            cliente: {
                'nome':'',
                'data_nascimento':'',
                'cpf':'',
                'rg':'',
                'telefone':'',
            },
            clienteOld: null,
            notEdit: true,
            modalOpen: false,
            enderecoToEdit: {},
            enderecos: [],
            editingItem: null,
        };
    },
    methods: {
        getCliente(id) {
            axios
                .get("/api/clientes/" + id)
                .then(response => {
                    console.log(response.data);
                    this.cliente = response.data;
                    this.enderecos = response.data.enderecos;
                    //copia o resultado para poder usar o cancel
                    this.clienteOld = JSON.parse(JSON.stringify(this.cliente));
                })
                .catch(error => {
                    console.log(error);
                });
        },
        inEdit() {
            this.notEdit = !this.notEdit;
        },
        salvar() {
            console.log(this.cliente);
            if(this.id !== undefined)
            {
                axios
                    .patch(
                        "/api/clientes/"+this.id, {
                            'cliente': this.cliente,
                            'enderecos': this.enderecos
                        }                    
                    )
                    .then(response => {
                        console.log("salvou");
                        this.voltarLista();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }else{
                 axios
                    .post(
                        "/api/clientes/", {
                            'cliente': this.cliente,
                            'enderecos': this.enderecos
                        }                    
                    )
                    .then(response => {
                        console.log("salvou");
                        this.voltarLista();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        cancelar() {
            //this.inEdit();
            this.cliente = this.clienteOld;
            this.enderecos = this.clienteOld.enderecos;
            this.inEdit();
        },
        abrirModalEndereco(endEdit, id, canEdit) {
            this.editingItem = id;
            console.log(endEdit);
            console.log("endEdit");
            if (endEdit == null) {
                this.enderecoToEdit = {
                    cep: "",
                    descricao: "",
                    endereco: "",
                    bairro: "",
                    numero: "",
                    complemento: "",
                    referencia: "",
                    cidade: "",
                    estado: ""
                };
            } else {
                this.enderecoToEdit = endEdit;
            }
            this.modalOpen = !this.modalOpen;
        },
        salvarEndereco(endereco) {
            if (this.editingItem == null) {
                this.enderecos.push(endereco);
            } else {
                this.enderecos[this.editingItem] = endereco;
            }
        },
        excluirEndereco(index) {
            this.enderecos.splice(index, 1);
        },
        customFormatter(date) {
            return moment(date).format('DD-MM-YYYY');
        },
        voltarLista() {
            this.$router.push({ name: 'home' });
        }
    },
    computed:{        
        showCancel: function () { 
            return !this.notEdit && this.id !== undefined;
        }
    },
    validations: {
        form: {
        nome: { required },
        email: { required, email }
        }
    },
    components: {
        ModalEndereco,
        Datepicker
    },
    created() {
        if(this.id !== undefined)
        {
            this.getCliente(this.id);
        }else{
            this.inEdit();
        }
    }
};
</script>
