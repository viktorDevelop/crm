import { createApp, ref,reactive,onMounted,component } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';
import PageForm from './page-form.js';
import PageList from './page-list.js';
import PageSingle from './page-single.js';
// import CommentsList from './comments-list.js';

const app = createApp({
    setup() {

        const comments = ref([]);
        const settings = ref({});


        // Получение настроек из data-атрибута
        // const getSettings = () => {
        //     const scriptElement = document.getElementById('app-comments')
        //     try {
        //         return JSON.parse(scriptElement.dataset.settings)
        //     } catch (e) {
        //         console.error('Error parsing settings:', e)
        //         return {}
        //     }
        // }
        //
        // const  getComments = async () =>
        // {
        //     const config = getSettings()
        //
        //     const res = await fetch('/api/comments/'+config.postId)
        //     const response = await res.json();
        //     if (response.status)
        //     {
        //         comments.value = response.data;
        //     }
        //
        // };
        //
        // const addCommentFetch = async (com) =>{
        //     const res = await fetch('/api/comments/1',{
        //         "method":"POST",
        //         body:JSON.stringify(com)
        //     })
        //     const response = await res.json();
        //
        //     console.log(response)
        //
        // };
        // const addComment = (commentText) => {
        //     const config = getSettings();
        //
        //
        //     comments.value.push({
        //         postId:config.postId,
        //         comment_text:commentText,
        //         userId:1
        //     })
        //
        //     addCommentFetch({
        //         post_id:config.postId,
        //         comment_text:commentText,
        //         user_id:1
        //     });
        //     // console.log(comments.value);
        //     // console.log(com);
        // };
        onMounted(() => {
            console.log('mounted')
        });
        return {
            // CommentForm,comments,settings,addComment

        };
    }
});
app.component('page-form', PageForm);
app.component('page-list', PageList);
app.component('page-single', PageSingle);
app.mount('#admin_app_page');