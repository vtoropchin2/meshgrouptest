<template>
    <ul class="nav flex-column">
        <li class="nav-item" v-for="category in categories">
            <router-link :to="{name: 'category', params: {categoryId: category.id}}" class="nav-link">
                {{ category.name }}
            </router-link>
        </li>
    </ul>
</template>

<script>
    import {mapState, mapActions} from 'vuex'

    export default {
        name: "Category",

        props: [
            'categoryId'
        ],
        computed: mapState({
            categories: state => state.category.items
        }),
        created() {
            this.$store.dispatch('category/getCategoriesFromServer', this.categoryId)
        },
    }
</script>

<style scoped>

</style>
