<?php
//echo '<pre>';
//var_dump($sectionData);
?>
<div class="block-section">
    <?if ($sectionData):?>
        <?foreach ($sectionData as $k=>$items):?>
        <div class="block-section_items">
            <h2><?=$items['title']?> </h2>
            <a href="/category/<?=$items['alias']?>" >descript</a>
        </div>
        <?endforeach;?>

    <?endif;?>
</div>

<style>
    .block-section{
        display: flex; flex-wrap: wrap;
    }

    .block-section_items{
        max-width: 150px;
        margin-left: 15px;

    }

    .block-section_items > span{
        color: gray
    }
</style>