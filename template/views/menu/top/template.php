<?php if($data):?>
<ul>
    <?foreach ($data as $k=>$item):?>
    <li>
        <a href="/category/<?=$item['alias']?>"><?=$item['title']?></a>
    </li>
    <?endforeach;?>
</ul>
<?php endif;?>