<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <card-component textoCabecalho="Buscar Marcas">
                    <template v-slot:card-body>
                        <div class="d-flex justify-content-center p-4 gap-3">
                            <input-container id="inputId" titulo="Id" textoDeAjuda="Informe o ID da Marca.">
                                <input id="inputId" type="number" class="form-control" name="inputId"
                                    aria-describedby="idHelp" min="0">
                            </input-container>

                            <input-container id="inputNomeMarca" titulo="Marca" textoDeAjuda="Informe o Nome da Marca.">
                                <input id="inputNomeMarca" type="text" class="form-control" name="inputNomeMarca"
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
                        <div class="d-flex justify-content-center p-4 gap-3">
                            <table-component></table-component>
                        </div>
                    </template>

                    <template v-slot:card-footer>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-sm btn-primary ml-auto">Adicionar</button>
                        </div>
                    </template>
                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
import InputContainer from './InputContainer.vue'
export default {
    components: { InputContainer },

}
</script>
