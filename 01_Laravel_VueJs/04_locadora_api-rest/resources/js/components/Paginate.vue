<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <slot></slot>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['textoCabecalho',]
}
</script>
