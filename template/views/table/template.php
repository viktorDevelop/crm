<?php
//$postData = [['id' => 2, 'title' => 'rs']]; // Пример данных
//$data = json_encode($postData); // Преобразуем в JSON
?>


<div id="collectionListViewTable"  class="container">

    <input type="text" class="form-control" placeholder="search" >
    <table class="table"">
    <thead>

            <?foreach ($postData as $key=>$val):?>
                <th><?=$key?></th>
            <?endforeach;?>

    </thead>
        <tr >
            <?foreach ($postData as $item):?>
                <td><?=$item?></td>
            <?endforeach;?>
        </tr>

    </table>
</div>

<script type="module" src="/template/views/table/js/main.js"></script>

