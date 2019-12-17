<template>
    <div>
        <div>
            <router-view :key="$route.fullPath" name="breadcrumb"></router-view>
        </div>
        <div class="row">
            <div class="col-3">
                <router-view :key="$route.fullPath" name="categoriesMenu"></router-view>
            </div>
            <div class="col-9">
                <router-view :key="$route.fullPath" name="products"></router-view>
                <router-view :key="$route.fullPath" name="description"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppComponent"
    }
</script>

<style scoped>

</style>
