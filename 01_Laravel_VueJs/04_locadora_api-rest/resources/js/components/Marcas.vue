<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <card-component textoCabecalho="Buscar Marcas">
                    <template v-slot:card-body>
                        <div class="px-4">
                            <input-container id="inputId" titulo="Id">
                                <input id="inputId" type="number" placeholder="Informe o ID da Marca"
                                    class="form-control w-100" name="inputId" aria-describedby="idHelp" min="0">
                            </input-container>

                            <input-container id="inputNomeMarca" titulo="Marca">
                                <input id="inputNomeMarca" type="text" placeholder="Informe o Nome da Marca"
                                    class="form-control w-100" name="inputNomeMarca" aria-describedby="inputNomeMarca">
                            </input-container>
                        </div>
                    </template>

                    <template v-slot:card-footer>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary ml-auto">Pesquisar</button>
                        </div>
                    </template>
                </card-component>

                <card-component textoCabecalho="Relação de Marcas">
                    <template v-slot:card-body>
                        <div class="d-flex justify-content-center gap-3">
                            <div v-if="marcasLoading" class="spinner-border text-primary" role="status"></div>
                            <table-component v-else :dados="marcas" :titulos="{
                                id: { titulo: 'Id', tipo: 'text' },
                                nome: { titulo: 'Nome', tipo: 'text' },
                                imagem: { titulo: 'Imagem', tipo: 'text' },
                            }"></table-component>
                        </div>
                    </template>

                    <template v-slot:card-footer>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-sm btn-primary ml-auto" data-toggle="modal"
                                data-target="#modalMarca">
                                Adicionar
                            </button>
                        </div>
                    </template>
                </card-component>
            </div>
        </div>

        <modal-component id="modalMarca" modalTitulo="Adicionar Marca">
            <template v-slot:alertas>
                <div class="d-flex flex-col justify-content-center">
                    <div v-if="salvarLoading" class="spinner-border text-primary" role="status"></div>
                    <alert-component class="w-100" v-else-if="transacaoStatus == 'adicionado'" tipo="success"
                        titulo="Marca cadastrada com sucesso!" :detalhes="transacaoDetalhes"></alert-component>
                    <alert-component class="w-100" v-else-if="transacaoStatus == 'erro'" tipo="danger"
                        titulo="Erro ao tentar cadastrar a marca" :detalhes="transacaoDetalhes"></alert-component>
                </div>
            </template>

            <template v-slot:conteudo>
                <input-container id="novoNomeMarca" titulo="Marca">
                    <input v-model="nomeMarca" id="novoNomeMarca" placeholder="Informe o Nome da Marca" type="text"
                        class="form-control" name="novoNomeMarca" aria-describedby="novoNomeMarca">
                </input-container>

                <input-container id="novaImagemMarca" textoDeAjuda="Adicionar Imagem da Marca">
                    <input @change="carregarImagem($event)" id="novaImagemMarca" type="file"
                        class="form-control-file mt-4" name="novaImagemMarca" aria-describedby="novaImagemMarca">
                </input-container>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button @click="salvar()" type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import InputContainer from './InputContainer.vue'

export default {
    computed: {
        token() {
            const tokenMatch = document.cookie.match(/token=([^;]+)/)
            const token = `Bearer ${tokenMatch[1]}`

            return token
        }
    },
    data() {
        return {
            urlBase: 'http://localhost:8000/api/v1/marca',
            nomeMarca: '',
            arquivoImagem: [],
            transacaoStatus: '',
            transacaoDetalhes: {},
            marcas: [],
            marcasLoading: false,
            salvarLoading: false,
        }
    },
    methods: {
        async carregarLista() {
            const config = this.getTokenConfig()
            this.marcasLoading = true

            try {
                const res = await axios.get(this.urlBase, config)
                const data = res.data
                this.marcas = data
            } catch (error) {
                console.error('Erro ao carregar lista:', error)
            } finally {
                this.marcasLoading = false
            }
        },
        salvar() {
            let formData = new FormData()
            const config = this.getTokenConfig()
            this.salvarLoading = true

            formData.append('nome', this.nomeMarca)
            formData.append('imagem', this.arquivoImagem[0])

            axios.post(this.urlBase, formData, config).then(res => { // Consuming REST_API by AXIOS
                this.transacaoStatus = 'adicionado'
                this.transacaoDetalhes = {
                    mensagem: 'ID do registro: ' + res.data.id
                }
            }).catch(err => {
                this.transacaoStatus = 'erro'
                this.transacaoDetalhes = {
                    mensagem: err.response.data.errors ? err.response.data.errors[Object.keys(err.response.data.errors)[0]][0] : err.response.data.message
                }
            }).finally(() => {
                this.salvarLoading = false;
            });
        },
        getTokenConfig() {
            return {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                    'Authorization': this.token,
                }
            };
        },
        carregarImagem(e) {
            this.arquivoImagem = e.target.files
        },
    },
    mounted() {
        this.carregarLista()
    },
    components: {
        InputContainer
    }
}
</script>
