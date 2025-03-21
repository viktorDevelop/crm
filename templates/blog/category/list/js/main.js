export default {
    data(){
        return {

        }
    },
    methods:{
       async getCategory()
      {
        const res = await fetch('/category/');

      }
    },
    mounted()
    {

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