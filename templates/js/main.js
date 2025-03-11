import Menu from './components/Menu.js'
import postList from './components/postList.js'
export default {
    data() {
       return {
           project:[],
           detail:false,
           list:true
       }
    },

    mounted()
    {
        this.getPostsFetch();
    },

    methods:{
        async getPostsFetch()
        {
            let req = await fetch('http://localhost/posts/');
            let res = await req.json();
            this.project =  res.posts;
            console.log(res.posts)
        }
    },

    computed:{

        view(){

        }

    },

    components: {
        Menu,postList
    },

    template: `
        <div class="container">                                                                     
                  <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>заголовок</th>
                      <th>описание</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for = "item in project">
                      <th scope="row">1</th>
                      <td>{{item.title}}</td>
                      <td>Otto</td>
                    </tr>                     
                  </tbody>
                </table>
        </div>
    `
}
