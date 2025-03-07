<?php
namespace crm\Post\Entity;
use crm\core\Entity;
use crm\core\Model;

/**
 *  @property int $id
 *  @property int $category_id
 *  @property int $title
 */
class PostEntity extends Model
{
    protected static $table = 'posts';
     protected static $field = [
        'id'=>'integer',
        'title'=>'string',
        'description'=>'string',
        'alias'=>'string',
        'category_id'=>'integer',
        'content'=>'string',
        'comment_id'=>'integer',
        'user_id'=>'integer'

    ];

    protected static $required = [
            'id',
            'category_id',
            'user_id'
    ];



}