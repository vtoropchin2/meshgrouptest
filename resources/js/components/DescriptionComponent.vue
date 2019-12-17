<template>
    <div>
        <h1>Пример SPA приложения</h1>
        <p>Исходный код - <a href="https://github.com/vtoropchin2/meshgrouptest"target="_blank">github.com</a></p>
        <p>За основу было взято <a href="https://drive.google.com/file/d/1aNUVg6hj9JzSv8VcIs7aqkbsMkJuRJmW/view" target="_blank">тестовое задание</a>.</p>

        <hr>

        <h3>Бэкенд:</h3>
        <ul class="list-unstyled">
            <li>Php 7.1</li>
            <li>Laravel 6.6</li>
            <li>REST API:</li>
        </ul>

        <h3>Фронтенд:</h3>
        <ul class="list-unstyled">
            <li>Vue.js</li>
            <li>Axios</li>
            <li>Vuex</li>
            <li>Bootstrap 4.4</li>
        </ul>

        <hr>

        <h3>Реализованы REST API</h3>
        <h5>Работа с категориями</h5>
        <p><code>POST api/categories</code></p>
        <p><code>GET api/categories/{categoryId}</code></p>
        <p><code>GET api/categories/{categoryId}/ancestors</code></p>
        <p><code>GET api/categories</code></p>
        <p><code>PUT api/categories/{categoryId}</code></p>
        <p><code>DELETE api/categories/{categoryId}</code></p>

        <h5>Работа с товарами</h5>
        <p><code>POST api/products</code></p>
        <p><code>POST api/products/{productId}/add-photo</code></p>
        <p><code>GET categories/{categoryId}}/products</code></p>
        <p><code>PUT api/products/{productId}</code></p>
        <p><code>DELETE api/products/{productId}</code></p>
        <p><code>POST api/products/{productId}}/move</code></p>

        <h5>Работа с фотографиями товаров</h5>
        <p><code>POST api/photos</code></p>
        <p><code>POST api/photos/{photoId}</code></p>
        <p><code>DELETE api/photos/{photoId}</code></p>

        <hr>

        <h3>Если Вы хотите развернуть приложение</h3>
        <p>Отредактируйте файл <code>.env</code>. Необходимо прописать параметры подключения к базе данных. Затем выполните команды <code>php artisan migrate</code>, <code>npm run watch</code>.</p>
    </div>
</template>

<script>
    export default {
        name: "DescriptionComponent"
    }
</script>

<style scoped>

</style>
