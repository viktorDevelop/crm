import { createApp, ref } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';

import CommentForm from './comments-form.js';

const app = createApp({
    setup() {
        const title = ref('Менеджер задач на Vue 3 с ES Modules');

        return {
            CommentForm

        };
    }
});
app.component('comments-form', CommentForm);
app.mount('#comments');