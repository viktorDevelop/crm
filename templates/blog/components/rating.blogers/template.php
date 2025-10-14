<?if($arData):?>
<h3> <?=$title;?></h3>
<ul class="posts">

    <?foreach ($arData as $k =>$items):?>
    <li>
        <article>
            <header>
                <h3><a href="#"><?=$items['title']?></a></h3>
                <span class="published"> likes <?=$items['likes']?> </span>
            </header>
            <a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
        </article>
    </li>
    <?endforeach;?>

</ul>

<?endif;?>