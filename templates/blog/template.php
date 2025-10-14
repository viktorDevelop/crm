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
        /**
         * @var $this  \core\View
         */

//        echo '<pre>';

        $this->includeContent($page,'blog',$component_page);

        ?>

    </div>


    <!-- Sidebar -->
    <section id="sidebar">

        <!-- Intro -->
        <section id="intro">
            <a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
            <header>
                <a href="/"> <h2>Blog</h2> </a>
                <p>Be popular with us</p>
            </header>
        </section>

        <?
            $this->includeComponentTemplate('popular.posts');
        ?>

        <!-- Posts List -->
        <section>

            <? $this->includeComponentTemplate('raiting.posts');?>

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