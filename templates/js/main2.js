export default {
    data() {
        return {
            count: 0 ,
            posts:[],
            arFilterPosts:[],
            detail:[],
            showDetail:false,
            category:[],
            curentCategory:0
        }
    },

    mounted()
    {
        this.getPostsFetch()
        this.getCategoryFetch()
    },

    methods:{
        async getPostsFetch()
        {
           let req = await fetch('/api/posts.php');
           let res = await req.json()
            this.posts =  JSON.parse(JSON.stringify(res))
            this.arFilterPosts = JSON.parse(JSON.stringify(res))


        },
        async getCategoryFetch()
        {
            let req = await  fetch('/api/category.php')
            let res = await  req.json()
            this.category = JSON.parse(JSON.stringify(res))
        },
        show(id)
        {
            let post = JSON.parse(JSON.stringify(this.posts))
            let detail = post.filter((item)=>item.id == id)
            if (detail.length > 0){
                this.detail = detail
                this.showDetail = true
            }
        },
        filterPosts(idCat)
        {
            this.showDetail = false
            this.curentCategory = idCat
            let posts = this.jsonToArray(this.posts)
            let res = posts.filter(item => item.id_category == idCat)
            this.arFilterPosts = this.jsonToArray(res);
        },

        cleanFilter()
        {
            this.showDetail = false
            this.curentCategory = 0
            this.arFilterPosts = this.posts

        },

        jsonToArray(val)
        {
            return JSON.parse(JSON.stringify(val))
        }
    },

    computed:{
      getDetail()
      {
          return  this.detail[0].content
      },
        getFilterPosts()
        {
            return this.arFilterPosts;
        },
        getCurentCategory()
        {
            return this.curentCategory
        }

    },
    template: `
         <div class="container mt-2 d-flex"> 
            <div class="col-md-3">
            <li  
                         @click="cleanFilter"
                         :class="(getCurentCategory == 0) ? 'bg-primary' : ''"
                         class="list-group-item"> все </li>
               <ul class="list-group">
                
                    <li  v-for="item in category"
                         @click="filterPosts(item.id)"
                         :class="(item.id == getCurentCategory) ? 'bg-primary' :''  "
                         class="list-group-item"> {{item.title}}</li>
                </ul>
            </div>
             
             <div class="col-md-9 d-flex flex-wrap">
                 <div class="col-md-4 "  v-for="item in getFilterPosts ">
                 <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"> {{item.title}}</h4>
                        <p class="card-text">
                          {{item.preview}}
                        </p>
                        <a  @click="show(item.id)" class="btn btn-primary"> read </a>
                      </div>
                    </div>
                 </div>
                 <p v-if="getFilterPosts.length == 0"> нет постов, поищите в другой категории </p>
            </div>
        </div>
        
        <div class="container mt-5" v-if="showDetail"> 
        
             <div class="col-md-12 d-flex">
                 {{getDetail}}
            </div>
        </div>
    `
}