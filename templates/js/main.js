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
        },

        checkedPost(id)
        {

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
        <div class="container d-flex flex-wrap">   
            <div class="col-md-4">
                
            </div>
            <div class="col-md-8">
            
                  <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>заголовок</th>
                      <th>описание</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for = "item in project" :id="item.id">
                      <th scope="row"> <input type="checkbox" @checked="" > </th>
                      <td>{{item.title}}</td>
                      <td>Otto</td>
                    </tr>                     
                  </tbody>
                </table>
            </div>                                                                  
        </div>
    `
}
