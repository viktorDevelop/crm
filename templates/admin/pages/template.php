<?php
//echo '<pre>';
//print_r($data['0']['title']);
?>

<div style="display: flex; flex-wrap: wrap; flex-direction: column">

    <?foreach ($data as $k => $items):?>
    <div>
        <a href="/"><?=$items['title'];?></a>
    </div>
    <?endforeach?>
</div>
