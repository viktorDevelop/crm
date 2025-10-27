<section id="menu">

    <!-- Links -->
    <section>
        <ul class="links">
            <li>
                <a href="#">
                    <h3>Add Post</h3>
                </a>
            </li>
            <li>
                <a href="#"><h3>Log Out</h3></a>
            </li>
        </ul>
    </section>

</section>

<?php
//echo '<pre>';
//print_r($arData);
//print_r($setting_template);
$showComments = $setting_template->showComments ?? null;
$arData = $arData[0] ?? null;
?>
<!-- Main -->
<div id="main">

    <!-- Post -->
    <article class="post">
        <header>
            <div class="title">
                <h2><a href="#"> <?=$arData['title']?></a></h2>
                <p><?=$arData['description']?></p>
            </div>
            <div class="meta">
                <time class="published" datetime="2015-11-01">1 ноября 2015</time>
                <a href="#" class="author"><span class="name">Jane Doe</span>
                    <img src="images/avatar.jpg" alt="" /></a>
            </div>
        </header>
        <span class="image featured"><img src="images/pic01.jpg" alt="" /></span>
        <?=$arData['content']?>

        <footer>
            <ul class="stats">
                <li><a href="#">Edit</a></li>
                <li><a href="#" class="red">Delete</a></li>
                <li><a href="#" class="red">Blocked</a></li>
                <li><a href="#" class="icon fa-heart"><?=$arData['likes']?></a></li>
                <li><a href="#" class="icon fa-comment">128</a></li>
            </ul>
        </footer>
    </article>

    <?if($showComments):?>

    <!-- Comments -->
    <div class="post" id="comments">
        <comments-form @add-comment="addComment"></comments-form>
        <comments-list :comments="comments"></comments-list>
    </div>
    <?$params = htmlspecialchars(json_encode([
        'controller'=>'comments',
        'postId'=>$arData['id'],

    ]),ENT_QUOTES,'UTF-8');?>

    <script id="app-comments"  type="module" src="/templates/blog/components/js/comments/app-comments.js"
            data-settings="<?=$params?>">
    </script>
    <?endif;?>
</div>