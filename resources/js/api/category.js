export default {
    /**
     * @param parentCategoryId
     * @returns {Q.Promise<any> | * | Promise<T | never>}
     */
    getCategories(parentCategoryId) {
        return axios.get('/api/categories', {
            params: {
                parentCategoryId: parentCategoryId
            }
        }).then(response => {
            return response.data.data;
        }).catch(error => {
            throw error;
        });
    },

    /**
     * @param categoryId
     * @returns {Q.Promise<any> | * | Promise<T | never>}
     */
    getAncestorsCategories(categoryId) {
        return axios.get('/api/categories/' + categoryId + '/ancestors', {
        }).then(response => {
            return response.data.data;
        }).catch(error => {
            throw error;
        });
    }
}
