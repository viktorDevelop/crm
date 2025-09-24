const {createApp,ref,onMounted} = Vue;

const  app = createApp({

    setup()
    {
        const data = ref([]);

        onMounted(() => {
            getData()
        });

        const getData = async () =>{
            const resp = await fetch('https://jsonplaceholder.typicode.com/posts');
            const res = await resp.json();

             data.value = res;
        };

        return {
            data,getData
        }
    }
});

app.mount('#app');