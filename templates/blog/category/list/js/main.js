export default {
    data(){
        return {
            category:[]
        }
    },
    methods:{
       async getCategory()
      {
        const res = await fetch('/api/users/?page=1');
        this.category =  res.json();

      }
    },
    mounted()
    {
        this.getCategory();
        let settings = document.getElementById('categorylist');

        console.log(settings.getAttribute('data-settings'))
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