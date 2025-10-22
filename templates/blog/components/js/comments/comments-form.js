export default {

    data(){
        return {
            commentText:''
        }
    },
    methods:{
        send()
        {
            let comment = {};
            comment.postId = 1;
            comment.userId = 1;
            comment.text = this.commentText;
            console.log(this.commentText)
            console.log(comment)
        }
    },
    template: `
          <section class="comments">
            <h3> Добавить</h3>
            <form @submit.prevent="send">
                <textarea v-model="commentText"></textarea><br>
                <input   type="submit" class="button big fit" value="Add Comment">
            </form>
        </section>
    `,
};