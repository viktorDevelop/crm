export default {
    data()
    {
        return {
            title:'',
            dataCollection:[],
            showTableContent:true,
            view:'table'
        };
    },
    mounted()
    {
        let dataCollection = document.getElementById('collection');
        let aDataCollection = dataCollection.getAttribute('data-list');
        let oDataCollection = JSON.parse(aDataCollection);
        this.dataCollection = oDataCollection;
    },
    computed:
    {
        searchPosts()
        {
            if (!this.title)
                return  [];
            let title = this.title.toLowerCase();
            return  this.dataCollection.filter(items => items.title.toLowerCase().includes(title))
        }
    },
    methods:
        {
            clearSearch()
            {
                this.title = "";
            }
        }
    
}