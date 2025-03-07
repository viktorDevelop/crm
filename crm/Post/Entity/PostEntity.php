<?php
namespace crm\Post\Entity;
use crm\core\Entity;
/**
 *  @property int $id
 *  @property int $category_id
 *  @property int $title
 */
class PostEntity extends Entity
{

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