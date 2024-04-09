<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <card-component textoCabecalho="Buscar Marcas">
                    <template v-slot:card-body>
                        <div class="px-4">
                            <input-container id="inputId" titulo="Id">
                                <input v-model="busca.id" id="inputId" type="number" placeholder="Informe o ID da Marca"
                                    class="form-control w-100" name="inputId" aria-describedby="idHelp" min="0">
                            </input-container>

                            <input-container id="inputNomeMarca" titulo="Marca">
                                <input v-model="busca.nome" id="inputNomeMarca" type="text"
                                    placeholder="Informe o Nome da Marca" class="form-control w-100"
                                    name="inputNomeMarca" aria-describedby="inputNomeMarca">
                            </input-container>
                        </div>
                    </template>

                    <template v-slot:card-footer>
                        <div class="d-flex justify-content-end gap-3">
                            <a v-if="urlFiltro" class="btn btn-sm btn-primary ml-auto" href="/marcas">Limpar</a>
                            <button @click="pesquisar()" type="submit"
                                class="btn btn-sm btn-primary ml-auto">Pesquisar</button>
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
                            }" :visualizarBtn="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaView' }"
                                :atualizarBtn="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaUpdate' }"
                                :removerBtn="{ visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaDelete' }"></table-component>
                        </div>
                    </template>

                    <template v-slot:card-footer>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <paginate-component>
                                <li v-for="(link, chave) in marcas.links"
                                    :class="link.active ? 'page-item active' : 'page-item'" :key="chave">
                                    <button @click="paginacao(link)" class="page-link" v-html="link.label"></button>
                                </li>
                            </paginate-component>

                            <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal"
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
                    <alert-component class="w-100" v-else-if="$store.state.item.status" :tipo="$store.state.item.status"
                        :titulo="$store.state.item.mensagem" :detalhes="transacaoDetalhes"></alert-component>
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
                <button :disabled="botaoAtivo" @click="salvar()" type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>

        <modal-component id="modalMarcaView" :modalTitulo="'Marca: ' + $store.state.item.nome">
            <template v-slot:conteudo>
                <input-container id="ID" titulo="Id">
                    <input disabled :value="$store.state.item.id" id="idMarca" type="text" class="form-control"
                        name="idMarca" aria-describedby="idMarca">
                </input-container>

                <input-container id="Nome" titulo="Marca">
                    <input disabled :value="$store.state.item.nome" id="editNomeMarca" titulo="Nome da Marca"
                        type="text" class="form-control" name="editNomeMarca" aria-describedby="editNomeMarca">
                </input-container>

                <input-container id="Imagem" :textoDeAjuda="'Logo ' + $store.state.item.nome">
                    <img v-if="$store.state.item.imagem" :src="'storage/' + $store.state.item.imagem"
                        :alt="'Logo ' + $store.state.item.nome" width="40" height="auto">
                </input-container>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </template>
        </modal-component>

        <modal-component id="modalMarcaDelete" :modalTitulo="'Deletar Marca: ' + $store.state.item.nome">
            <template v-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="text-danger"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
            </template>

            <template v-slot:alertas>
                <div class="d-flex flex-col justify-content-center">
                    <div v-if="erroLoading" class="spinner-border text-primary" role="status"></div>
                    <alert-component class="w-100" v-else-if="$store.state.item.status" :tipo="$store.state.item.status"
                        :titulo="$store.state.item.mensagem" :detalhes="transacaoDetalhes"></alert-component>
                </div>
            </template>

            <template v-slot:conteudo>
                <input-container id="ID" titulo="Id">
                    <input disabled :value="$store.state.item.id" id="idMarca" type="text" class="form-control"
                        name="idMarca" aria-describedby="idMarca">
                </input-container>

                <input-container id="Nome" titulo="Marca">
                    <input disabled :value="$store.state.item.nome" id="deleteNomeMarca" titulo="Nome da Marca"
                        type="text" class="form-control" name="deleteNomeMarca" aria-describedby="deleteNomeMarca">
                </input-container>

                <input-container id="Imagem" :textoDeAjuda="'Logo ' + $store.state.item.nome">
                    <img v-if="$store.state.item.imagem" :src="'storage/' + $store.state.item.imagem"
                        :alt="'Logo ' + $store.state.item.nome" width="40" height="auto">
                </input-container>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button :disabled="botaoAtivo" @click="deletarMarca($store.state.item.id)" type="button"
                    class="btn btn-danger">Deletar</button>
            </template>
        </modal-component>

        <modal-component id="modalMarcaUpdate" :modalTitulo="'Atualizar Marca: ' + $store.state.item.nome">
            <template v-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-pencil-square text-info" viewBox="0 0 16 16">
                    <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg>
            </template>

            <template v-slot:alertas>
                <div class="d-flex flex-col justify-content-center">
                    <div v-if="atualizaLoading" class="spinner-border text-primary" role="status"></div>
                    <alert-component class="w-100" v-else-if="$store.state.item.status" :tipo="$store.state.item.status"
                        :titulo="$store.state.item.mensagem" :detalhes="transacaoDetalhes"></alert-component>
                </div>
            </template>

            <template v-slot:conteudo>
                <input-container id="ID" titulo="Id">
                    <input disabled :value="$store.state.item.id" id="idMarca" type="text" class="form-control"
                        name="idMarca" aria-describedby="idMarca">
                </input-container>

                <input-container id="Nome" titulo="Marca">
                    <input v-model="nomeMarca" id="editNomeMarca" :placeholder="$store.state.item.nome" titulo="Nome da
                        Marca" type="text" class="form-control" name="editNomeMarca" aria-describedby="editNomeMarca">
                </input-container>

                <input-container id="imagemMarca" textoDeAjuda="Adicionar Imagem da Marca">
                    <input @change="carregarImagem($event)" id="atualizaImagemMarca" type="file"
                        class="form-control-file mt-4" name="atualizaImagemMarca"
                        aria-describedby="atualizaImagemMarca">
                </input-container>

                <input-container id="Imagem" :textoDeAjuda="'Logo ' + $store.state.item.nome">
                    <img v-if="$store.state.item.imagem" :src="'storage/' + $store.state.item.imagem"
                        :alt="'Logo ' + $store.state.item.nome" width="40" height="auto">
                </input-container>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button :disabled="botaoAtivo" @click="atualizarMarca($store.state.item.id)" type="button"
                    class="btn btn-danger">Atualizar</button>
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
            urlPaginacao: '',
            urlFiltro: '',
            nomeMarca: '',
            arquivoImagem: [],
            transacaoStatus: '',
            transacaoDetalhes: {},
            marcas: { data: [] },
            marcasLoading: false,
            salvarLoading: false,
            erroLoading: false,
            atualizaLoading: false,
            botaoAtivo: false,
            busca: { id: '', nome: '' },
        }
    },
    methods: {
        atualizarMarca(marcaId) {
            const url = this.urlBase + '/' + marcaId
            const config = this.getTokenConfig()

            let formData = new FormData()
            formData.append('_method', 'patch')
            formData.append('nome', this.nomeMarca)

            if (this.arquivoImagem[0]) {
                formData.append('imagem', this.arquivoImagem[0])
            }

            this.atualizaLoading = true

            axios.post(url, formData, config).then(res => {
                this.$store.state.item.status = 'success'
                this.$store.state.item.mensagem = 'Marca atualizada com sucesso!'

                this.botaoAtivo = true

                setTimeout(() => {
                    window.location.href = 'http://localhost:8000/marcas'
                }, 3000)

                this.atualizaLoading = false
            }).catch(err => {
                this.$store.state.item.status = 'danger'
                this.$store.state.item.mensagem = 'Erro ao atualizar Marca'

                if (err.data.errors) {
                    const primeiroErro = err.response.data.errors[Object.keys(err.response.data.errors)[0]][0]
                    this.transacaoDetalhes = {
                        mensagem: primeiroErro
                    }
                } else {
                    this.transacaoDetalhes = {
                        mensagem: err.response.data.message
                    }
                }

                this.atualizaLoading = false
            })
        },
        deletarMarca(marcaId) {
            const url = this.urlBase + '/' + marcaId
            const config = this.getTokenConfig()

            let formData = new FormData();
            formData.append('_method', 'delete')

            this.erroLoading = true

            axios.post(url, formData, config).then(res => { // Consuming REST_API by AXIOS
                this.$store.state.item.status = 'success'
                this.$store.state.item.mensagem = 'Marca deletada com sucesso!'

                this.botaoAtivo = true

                setTimeout(() => {
                    window.location.href = 'http://localhost:8000/marcas'
                }, 3000)

                this.erroLoading = false
            }).catch(err => {
                this.$store.state.item.status = 'danger'
                this.$store.state.item.mensagem = 'Erro ao deletar Marca'
                this.transacaoDetalhes = {
                    mensagem: err.response.data.erro
                }
                this.erroLoading = false
            })
        },
        pesquisar() {
            const filtro = Object.keys(this.busca)
                .filter(chave => this.busca[chave])
                .map(chave => `${chave}:like:${this.busca[chave]}`)
                .join(';')

            this.urlFiltro = filtro ? `&filtro=${filtro}` : ''

            this.carregarLista()
        },
        paginacao(link) {
            if (link.url) {
                this.urlPaginacao = link.url.split('?')[1]
                this.carregarLista()
            }
        },
        async carregarLista() { // Consuming REST_API by ASYNCHRONOUS
            this.marcasLoading = true
            const config = this.getTokenConfig()

            let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro

            try {
                const res = await fetch(url, config)
                const data = await res.json()
                this.marcas = data
            } catch (error) {
                console.error('Erro ao carregar lista:', error)
            } finally {
                this.marcasLoading = false
            }
        },
        salvar() {
            const config = this.getTokenConfig()

            let formData = new FormData()
            formData.append('nome', this.nomeMarca)
            formData.append('imagem', this.arquivoImagem[0])

            this.salvarLoading = true
            axios.post(this.urlBase, formData, config).then(res => { // Consuming REST_API by AXIOS
                this.$store.state.item.status = 'success'
                this.$store.state.item.mensagem = 'Marca cadastrada com sucesso!'

                this.transacaoDetalhes = {
                    mensagem: 'ID do registro: ' + res.data.id
                }

                this.botaoAtivo = true

                setTimeout(() => {
                    window.location.href = 'http://localhost:8000/marcas'
                }, 3000)
            }).catch(err => {
                this.transacaoStatus = 'erro'
                this.transacaoDetalhes = {
                    mensagem: err.data.errors ? err.data.errors[Object.keys(err.data.errors)[0]][0] : err.data.message
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
