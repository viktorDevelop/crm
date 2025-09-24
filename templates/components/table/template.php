<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .btn { padding: 10px 20px; margin: 5px; }
    </style>
    <title>Document</title>
</head>
<body>
<?php

?>

<div id="app" class="container" data-config="" >
    <div class="col-md-12">
       <div class="mb-2">
           <input type="text" v-model="search" class="form-control">
           {{data}}
       </div>
        <table class="table">
            <thead class="thead-dark">
            <tr>

            </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </div>

</div>
<?php

//echo '<pre>';
//print_r($fields);
?>

<script   src="/templates/components/table/js/App.js"></script>
</body>
</html>