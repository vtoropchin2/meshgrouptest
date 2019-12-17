import productApi from '../../api/product'

const productItem = {
    "id": 1,
    "name": "Product name",
    "description": "Product description",
    "photo": {
        "id": 1,
        "fileName": "proto file name"
    }
};

const state = {
    items: [productItem],
};

const mutations = {
    setProducts(state, products) {
        state.items = products
    },
};

const getters = {
    getProducts: state => {
        return state.items;
    }
};

const actions = {
    getProductsFromServer(context, categoryId) {
        context.commit('setProducts', {});
        productApi.getProducts(categoryId).then(products => {
            context.commit('setProducts', products)
        }).catch(error => {
            alert(error.message)
        });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
