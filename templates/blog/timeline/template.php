<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>asdf</title>
</head>
<body>

<?
//$postData = $PostListData['PostListData'];
//$dataJson = htmlspecialchars(json_encode($postData),ENT_QUOTES,'UTF-8');
?>

<div id="timeline" class="d-flex wrap"  v-cloak>
    <FormTask></FormTask>
    <div class="timeline-display">
        <div class="timeline-task" v-for="item in tasks">
            <div class="task-title">{{item.title}}</div>
            <div class="task-desc"></div>
            <div class="task-date"></div>
            <div class="task-timer"></div>
            <div class="time"></div>
            <button>пуск</button>
            <button>стоп</button>
        </div>


    </div>



</div>

<style>
    body{
        margin: 0;
        padding: 0;
    }
    [v-cloak] {
        display: none;
    }
    .wrap{
        margin: 0 auto;
        max-width: 1260px;
    }
    .timeline-display{
        display: flex;
        flex-direction: column;
        min-height: 100vh;

    }
    .timeline-task{
        border: 1px solid aquamarine;
        min-height: 80px;
        margin-bottom: 20px;
    }
</style>


<script type="module" src="http://localhost/templates/blog/timeline/js/timeline.js"></script>


</body>
</html>