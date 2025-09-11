import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

import main from "./main.js";



const app = createApp(main);

app.mount('#timeline');
// createApp(main).mount('#timeline')