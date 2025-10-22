<?php
namespace services\Comments;

use core\Request;
use core\Responce;

class CommentsService
{
    private array $errors = [];

    public function validate(Request $request,Comments $comments)
    {
        $comments = json_decode(json_encode($comment));

    }

    public function save(Request $request)
    {

        $comment = new Comments();
        $comment->id = null;
        $comment->comment_text = $this->request->getPostData('comment_text');
        $comment->user_id = $this->request->getPostData('user_id');
        $comment->post_id = $this->request->getPostData('post_id');
        $this->validate($request,$comment);
        $comment->save();

        Responce::send([
            'status'=>true,
            'message'=>'create comments',
            'data'=>[]
        ],201,true);
    }


}