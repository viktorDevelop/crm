import { createApp } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

import comments from "./comments.js";
import items from "./items.js";

createApp(comments,items).mount('#comments')