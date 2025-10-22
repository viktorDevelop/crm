<?php
namespace services\Comments;

use core\ApiController as ApiControllerAlias;
use core\Request;
use core\Responce;
use core\SimpleOrm;
use mysql_xdevapi\Exception;

class CommentsController extends ApiControllerAlias
{

    protected function find()
    {
        $id_post = $this->request->getParams('postId');
        $comments = new Comments();
        $comments->model->findAllBy(['post_id='=>$id_post]);
        $arRes = $comments->model->toArray();
        Responce::send([
          'status'=>true,
          'data'=>$arRes
       ],200,true);
    }


    protected function create()
    {
        $comment = new Comments();
        $comment->id = null;
        $comment->comment_text = $this->request->getPostData('comment_text');
        $comment->user_id = $this->request->getPostData('user_id');
        $comment->post_id = $this->request->getPostData('post_id');
        $comment->save();

        Responce::send([
            'status'=>true,
            'message'=>'create comments',
            'data'=>[]
        ],201,true);

    }

    protected function update()
    {
        $comment = new Comments();
        $comment->id = $this->request->getPostData('id') ?? 0;
        $comment->comment_text = $this->request->getPostData('comment_text');
        $comment->user_id = $this->request->getPostData('user_id');
        $comment->post_id = $this->request->getPostData('post_id');
        $comment->save();

        Responce::send([
            'status'=>true,
            'message'=>'create comments',
            'data'=>[]
        ],201,true);
    }

    protected function delete()
    {
        $comment = new Comments();
        $comment->model->delete(intval($this->request->getParams('id')));
        Responce::send([
            'status'=>true,
            'message'=>'comments deleted',
            'data'=>$this->request->getParams()
        ],200,true);
    }
}