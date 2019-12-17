<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" v-bind:class="{active: isActive(undefined)}">
                <router-link :to="{name: 'root-category'}" v-if="!isActive(undefined)">Root</router-link>
                <span v-if="isActive(undefined)">Root</span>
            </li>
            <li v-for="ancestor in ancestors" class="breadcrumb-item" v-bind:class="{active: isActive(ancestor.id)}">
                <span v-if="isActive(ancestor.id)">{{ ancestor.name }}</span>
                <router-link v-else :to="{name: 'category', params:{categoryId: ancestor.id}}">{{ ancestor.name }}</router-link>
            </li>
        </ol>
    </nav>
</template>

<script>
    import {mapState, mapActions} from 'vuex'

    export default {
        name: "BreadcrumbComponent",
        props: [
            'categoryId'
        ],
        computed: mapState({
            ancestors: state => state.category.ancestors
        }),
        methods: {
            isActive(categoryId) {
                return this.categoryId == categoryId;
            },
        },
        created() {
            this.$store.dispatch('category/getAncestorsCategoriesFromServer', this.categoryId)
        },
    }
</script>

<style scoped>

</style>
