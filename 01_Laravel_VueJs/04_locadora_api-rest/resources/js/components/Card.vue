<template>
    <div class="card mb-3">
        <div class="card-header">{{ textoCabecalho }}</div>

        <div class="card-body">
            <slot name="card-body"></slot>
        </div>

        <div class="card-footer">
            <slot name="card-footer"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: ['textoCabecalho',]
}
</script>
