export default {
    data(){
        return {
            comments:[],
            comment_text:''
        }
    },

    methods:{
        send()
        {
            fetch('/api/category/',{
                method: 'POST',
                body: JSON.stringify({
                    comment_text: this.comment_text
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                },
            })
                .then((response) => response.json())
                .then((json) => console.log(json));
        }
    },

    template:`
        <form @submit.prevent='send'>
                <input type="text" v-model="comment_text"  />
                <input type="submit" />
        </form>
    `
}