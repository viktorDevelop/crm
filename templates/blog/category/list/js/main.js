export default {
    data(){
        return {
            category:[]
        }
    },
    methods:{
       async getCategory()
      {
        const res = await fetch('/category/');
        this.category =  res.json();

      }
    },
    mounted()
    {
        this.getCategory();
        console.log(this.category)
    },
    template:`
         <div>
            <div class="table-head"> 
                <div> <button @click="getPostsFetch">setting</button> </div>           
                <div>id</div>
                <div>name</div>
                <div>preview</div>
                <div>images</div>
                 
            </div>
        </div>
    `
}