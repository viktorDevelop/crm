export default {
    props:{
        comments:{
            type:Array
        }
    },

    template: `
    <div>       
        <article class="comment" v-for = "item in comments" :key="item.id">
            <div class="comment-autor">
                <a href="#"><img src="/templates/blog/images/avatar.jpg"></a>
                <a href="#">User</a>
            </div>
            <p>{{item.comment_text}}</p>
        </article>
    </div>              
    `
}