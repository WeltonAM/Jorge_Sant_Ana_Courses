<template>
    <label :for="id" class="col-form-label text-md-end">{{ titulo }}</label>

    <slot></slot>

    <!-- <input :id="id" :type="tipo" class="form-control" :name="id" :aria-describedby="id"> -->

    <div class="form-text" :id="id">{{ textoDeAjuda }}</div>
</template>

<script>
export default {
    props: ['id', 'titulo', 'textoDeAjuda']
}
</script>
