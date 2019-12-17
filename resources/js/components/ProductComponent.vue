<template>
    <div>
        <div class="card mb-3" v-for="product in products">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img :src="product.photo.fileName" class="card-img rounded-0" :alt="product.name">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex'

    export default {
        name: "ProductComponent",

        props: [
            'categoryId'
        ],
        computed: mapState({
            products: state => state.product.items
        }),
        created() {
            this.$store.dispatch('product/getProductsFromServer', this.categoryId)
        },
    }
</script>

<style scoped>

</style>
