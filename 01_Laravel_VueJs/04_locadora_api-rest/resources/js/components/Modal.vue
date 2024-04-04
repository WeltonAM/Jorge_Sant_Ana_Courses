<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ modalTitulo }}</h5>
                </div>

                <div class="modal-body">
                    <slot name="conteudo"></slot>
                </div>

                <div class="modal-footer">
                    <slot name="rodape"></slot>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: ['modalId', 'modalTitulo', 'textoDeAjuda']
}
</script>
