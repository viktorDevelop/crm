export default {
    data(){
        return {
            category:[],
            showFormAdd:false
        }
    },
    methods:{
        async getCategory()
        {
            const res = await fetch('/api/category/?page=1');
            const cat = await  res.json();
            this.category = cat.data

        },
        actionShowFormAdd()
        {
            this.showFormAdd = !this.showFormAdd
        }
    },
    computed:{
        backTitle()
        {
            if (!this.showFormAdd)
                return "добавить"

            if (this.showFormAdd)
                return "скрыть"
        }
    },
    mounted()
    {
        this.getCategory();

    }
}