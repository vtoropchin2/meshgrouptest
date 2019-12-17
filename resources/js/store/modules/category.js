import categoryApi from '../../api/category'

const categoryItem = {
    id: 1,
    name: 'default category',
};

const ancestorItem = {
    id: 1,
    name: 'default ancestor',
};

const state = {
    items: [categoryItem],
    ancestors: [ancestorItem],
};

const mutations = {
    setCategories(state, categories) {
        state.items = categories
    },
    AncestorsCategories(state, ancestorItem) {
        state.ancestors = ancestorItem
    }
};

const getters = {
    getCategories: state => {
        return state.items;
    }
};

const actions = {
    getCategoriesFromServer(context, parentCategoryId) {
        context.commit('setCategories', {});
        categoryApi.getCategories(parentCategoryId).then(categories => {
            context.commit('setCategories', categories)
        }).catch(error => {
            alert(error.message)
        });
    },
    getAncestorsCategoriesFromServer(context, categoryId) {
        context.commit('AncestorsCategories', {});
        if (categoryId) {
            context.commit('AncestorsCategories', {});
            categoryApi.getAncestorsCategories(categoryId).then(ancestors => {
                context.commit('AncestorsCategories', ancestors)
            }).catch(error => {
                alert(error.message)
            });
        }
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
