import formEdite from './formEdite.js';
export default {
    data(){
        return {
            category:[]
        }
    },
    methods:{
        async getCategory()
        {
            // const res = await fetch('/api/category/');
            // this.category =  await res.json();
        },
        showEdite()
        {
            // const myModal = new bootstrap.Modal(document.getElementById('modalEditeCategory'),{})
            // myModal.show();
        }

    },
    component:{formEdite},
    mounted()
    {
        this.getCategory();

    },
    template:`
        <div>
        
         <formEdite/>           
        </div>
        
    `
}