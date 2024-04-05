<template>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th v-for="(t, chave) in titulos" :key="chave" scope="col">{{ t.titulo }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="obj in dados" :key="obj.id">
                <td v-for="(_, chave) in titulos" :key="chave">
                    <template v-if="chave === 'imagem'">
                        <img :src="'storage/' + obj[chave]" alt="Imagem" width="40" height="auto" />
                    </template>
                    <template v-else>
                        {{ obj[chave] }}
                    </template>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['dados', 'titulos']
};
</script>
