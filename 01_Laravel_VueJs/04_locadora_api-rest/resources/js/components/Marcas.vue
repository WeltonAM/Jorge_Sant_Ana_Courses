<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <card-component textoCabecalho="Buscar Marcas">
                    <template v-slot:card-body>
                        <div class="px-4">
                            <input-container id="inputId" titulo="Id" textoDeAjuda="Informe o ID da Marca">
                                <input id="inputId" type="number" class="form-control w-100" name="inputId"
                                    aria-describedby="idHelp" min="0">
                            </input-container>

                            <input-container id="inputNomeMarca" titulo="Marca" textoDeAjuda="Informe o Nome da Marca">
                                <input id="inputNomeMarca" type="text" class="form-control w-100" name="inputNomeMarca"
                                    aria-describedby="inputNomeMarca">
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
                            <table-component></table-component>
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
            <template v-slot:conteudo>
                <input-container id="novoNome" titulo="Marca" textoDeAjuda="Informe o Nome da Marca">
                    <input id="novoNome" type="text" class="form-control" name="novoNome" aria-describedby="novoNome">
                </input-container>

                <input-container id="novaImagemMarca" titulo="Imagem" textoDeAjuda="Adicionar Imagem da Marca">
                    <input id="novaImagemMarca" type="file" class="form-control-file mt-4" name="novaImagemMarca"
                        aria-describedby="novaImagemMarca">
                </input-container>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import InputContainer from './InputContainer.vue'
import Modal from './Modal.vue'

export default {
    components: { InputContainer, Modal },

}
</script>
