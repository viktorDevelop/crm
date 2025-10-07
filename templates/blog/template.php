<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="<?=TEMPLATE_PATH?>assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="<?=TEMPLATE_PATH?>assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="<?=TEMPLATE_PATH?>assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="<?=TEMPLATE_PATH?>assets/css/ie8.css" /><![endif]-->

    <title><?=$title?></title>
</head>
<body>



<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <header id="header">
        <h1><a href="#">Blog</a></h1>
        <nav class="main">
            <ul>
                <li class="menu">
                    <a class="fa-user" href="#menu">Menu</a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Menu -->
    <section id="menu">

        <!-- Actions -->
        <section>
            <ul class="actions vertical">
                <li><h3>Login</h3></li>
                <li>
                    <form action="?" method="post">
                        <input type="text" name="neme" placeholder="Username"><br>
                        <input type="password" name="neme" placeholder="Password"><br>
                        <input type="submit" class="button big fit" value="Log In">
                    </form>
                </li>

                <li><h3>Registration</h3></li>
                <li>
                    <form action="?" method="post">
                        <input type="text" name="neme" placeholder="Username"><br>
                        <input type="password" name="neme" placeholder="Password"><br>
                        <input type="file" name="file"><br><br>
                        <input type="submit" class="button big fit" value="Sign up">
                    </form>
                </li>
            </ul>
        </section>

    </section>

    <!-- Main -->
    <div id="main">

        <?
        ob_start();
        $path =  $_SERVER['DOCUMENT_ROOT'].'/templates/blog/pages/'.$page.'.php';
        include $path;
        $content = ob_get_contents();
        ob_clean();
        echo $content;
        ?>

    </div>


    <!-- Sidebar -->
    <section id="sidebar">

        <!-- Intro -->
        <section id="intro">
            <a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
            <header>
                <h2>Blog</h2>
                <p>Be popular with us</p>
            </header>
        </section>

        <!-- Mini Posts -->
        <section>
            <h3>Popular posts</h3>
            <div class="mini-posts">

                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="#">Vitae sed condimentum</a></h3>
                        <time class="published" datetime="2015-10-20">1 Ноября 2015</time>
                        <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
                </article>

                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="#">Rutrum neque accumsan</a></h3>
                        <time class="published" datetime="2015-10-19">1 Ноября 2015</time>
                        <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>
                </article>

                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="#">Odio congue mattis</a></h3>
                        <time class="published" datetime="2015-10-18">1 Ноября 2015</time>
                        <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>
                </article>

                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="#">Enim nisl veroeros</a></h3>
                        <time class="published" datetime="2015-10-17">1 Ноября 2015</time>
                        <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
                </article>

            </div>
        </section>

        <!-- Posts List -->
        <section>

            <h3>Rating bloggers</h3>

            <ul class="posts">
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Lorem ipsum fermentum ut nisl vitae</a></h3>
                            <span class="published">30 likes in 10 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Convallis maximus nisl mattis nunc id lorem</a></h3>
                            <span class="published">30 likes in 10 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Euismod amet placerat vivamus porttitor</a></h3>
                            <span class="published">20 likes in 5 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic10.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Magna enim accumsan tortor cursus ultricies</a></h3>
                            <span class="published">10 likes in 15 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic11.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Congue ullam corper lorem ipsum dolor</a></h3>
                            <span class="published">1 likes in 1 post</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic12.jpg" alt="" /></a>
                    </article>
                </li>
            </ul>
        </section>

        <!-- Footer -->
        <section id="footer">
            <p class="copyright">&copy; Blog. Design: <a href="http://html5up.net">HTML5 UP</a>.</p>
        </section>

    </section>

</div>



<!-- Scripts -->
<script src="<?=TEMPLATE_PATH?>assets/js/jquery.min.js"></script>
<script src="<?=TEMPLATE_PATH?>assets/js/skel.min.js"></script>
<script src="<?=TEMPLATE_PATH?>assets/js/util.js"></script>
<!--[if lte IE 8]><script src="<?=TEMPLATE_PATH?>assets/js/ie/respond.min.js"></script><![endif]-->
<script src="<?=TEMPLATE_PATH?>assets/js/main.js"></script>


</body>
</html>