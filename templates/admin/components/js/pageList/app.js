import { createApp, ref,reactive,onMounted } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';
import CommentForm from "./";
// import PageList from "./page-list.js";

const  app = createApp({

    data()
    {

    },
    mounted()
    {
        console.log('test')
    },
    template:`
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
        </tr>
        </tbody>
    </table>
    
    `

});

// app.component('comments-form', CommentForm);
// app.component('page-list', PageList);
app.mount('#app-page.list');