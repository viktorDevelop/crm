<!-- Mini Posts -->

<?if($arData):?>
<section>
    <h3>Popular posts</h3>
    <?foreach ($arData as $k=>$item):?>
    <div class="mini-posts">
        <!-- Mini Post -->

        <article class="mini-post">
            <header>
                <h3><a href="#"> <?=$item['title']?> </a></h3>
                <time class="published" datetime="2015-10-20">1 Ноября 2015</time>
                <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
            </header>
            <a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
        </article>

    </div>
    <?endforeach;?>
</section>
<?php endif?>