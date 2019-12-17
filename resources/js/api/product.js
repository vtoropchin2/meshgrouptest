export default {
    /**
     * @param categoryId
     * @returns {Q.Promise<any> | * | Promise<T | never>}
     */
    getProducts(categoryId) {
        return axios.get('/api/categories/' + categoryId + '/products', {
        }).then(response => {
            return response.data.data;
        }).catch(error => {
            throw error;
        });
    }
}
