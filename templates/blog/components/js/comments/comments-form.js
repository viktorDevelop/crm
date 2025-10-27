export default {
    emits: ['add-comment'],
    data(){
        return {
            commentText:null
        }
    },
    methods:{
        send()
        {
            if(!this.commentText)
                return ;
            this.$emit('add-comment',this.commentText)
        }
    },
    template: `
          <section class="comments">
            <h3> Добавить</h3>
            <form @submit.prevent="send">
                <textarea v-model="commentText"></textarea><br>
                <input  type="submit" class="button big fit" value="Add Comment">
            </form>
        </section>
    `,
};