<template>
    <div :class="estilo" role="alert">
        {{ titulo }}
        <hr>
        <span v-if="detalhes && detalhes.data && detalhes.data.id">{{ 'ID do registro: ' + detalhes.data.id }}</span>
        <span v-else-if="detalhes && detalhes.data && detalhes.data.errors">{{ Object.values(detalhes.data.errors)[0][0]
            }}</span>
        <span v-else-if="detalhes && detalhes.data && detalhes.data.message">{{ detalhes.data.message }}</span>
    </div>
</template>

<script>
export default {
    props: ['tipo', 'titulo', 'detalhes'],
    computed: {
        estilo() {
            return `alert alert-${this.tipo}`
        }
    }
}
</script>
