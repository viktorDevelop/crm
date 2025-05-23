<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue 3 + Vue Router CDN Example</title>
    <!-- Подключаем Vue 3 через CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Подключаем Vue Router через CDN -->
    <script src="https://unpkg.com/vue-router@4"></script>
    <title>sdfsdf</title>
</head>
<body>
<div id="app">
    <h1>Vue 3 Composition API + Vue Router</h1>
    <nav>
        <router-link to="/">Home</router-link> |
        <router-link to="/about">About</router-link>
    </nav>
    <router-view></router-view>
</div>

<script>
    // Деструктурируем необходимые функции из Vue
    const { createApp, ref, onMounted } = Vue;
    const { createRouter, createWebHashHistory } = VueRouter;

    // Определяем компоненты для маршрутов
    const Home = {
        template: '<div>Home Page <input type="button" value="sdfasf"> </div>',
        setup() {
            onMounted(() => {
                console.log('Home component mounted');
            });

            const count = ref(0);

            return {

                count
            };
        }
    };

    const About = {
        template: '<div>About Page</div>',
        setup() {
            const message = ref('Hello from About page!');

            return {
                message
            };
        }
    };

    // Создаем маршрутизатор с хэш-навигацией
    const router = createRouter({
        history: createWebHashHistory(),
        routes: [
            { path: '/', component: Home },
            { path: '/about', component: About }
        ]
    });

    // Создаем приложение Vue
    const app = createApp({
        setup() {
            const appTitle = ref('Vue 3 Router Example');

            return {
                appTitle
            };
        }
    });

    // Подключаем роутер к приложению
    app.use(router);

    // Монтируем приложение
    app.mount('#app');
</script>
</body>
</html>