import Menu from './components/Menu.js'
export default {
    data() {
       return {
           project:[]
       }
    },

    mounted()
    {
        this.getPostsFetch();
    },

    methods:{
        async getPostsFetch()
        {
            let req = await fetch('/posts');
            let res = await req.json()
            if (res.result.success)
                this.project =  res.result.items;
            else
                this.message = res.error;
        }
    },

    computed:{


    },

    components: {
        Menu
    },

    template: `
        <div class="container">
        <Menu/>        
                                           
                <div class="col-md-12 d-flex ">                
                     <div v-for="item in project " class="col-md-4">{{item.title}}</div>
                </div>
        </div>
    `
}