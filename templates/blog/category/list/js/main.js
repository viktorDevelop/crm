export default {
    data(){
        return {
            category:[],
            urls:{},
            view:''
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
        let aSetting = settings.getAttribute('data-settings');
        let oSetting = JSON.parse(aSetting);

        this.urls = oSetting.route
        this.view = oSetting.view
        console.log(oSetting.route)
    },
    template:`
         <div>
            <div class="table-head"> 
                <div> <button @click="getPostsFetch">setting</button> </div>           
                <div>id</div>
                <div>name</div>
                <div>preview</div>
                <div>images</div>
                  {{view}}
            </div>
        </div>
    `
}