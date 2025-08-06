<?php
//echo '<pre>'; print_r($postData);
$dataJson = htmlspecialchars(json_encode($postData),ENT_QUOTES,'UTF-8');
?>
<div id="collection" v-cloak class="container" data-list='<?=$dataJson?>'>

   <div class="col-md-12">

       <div class="input-group mb-2">
           <button type="button" @click="clearSearch()" class="btn btn-outline-secondary" id="input-group-button-left">X</button>
           <input v-model="title"  type="text" class="form-control" placeholder="search title" aria-label="Username" aria-describedby="input-group-button-left">
       </div>

       <table class="table" v-if="showTableContent">
           <thead>

           <?foreach ($postData[0] as $key=>$val):?>
               <?$arKey[] = $key?>
               <th><?=$key?></th>
           <?endforeach;?>

           </thead>
           <?foreach ($postData as $k=> $item):?>
               <tr v-if="searchPosts.length == 0">
                   <?foreach ($arKey as $value):?>
                       <td><?=$item[$value]?></td>
                   <?endforeach;?>
               </tr>
           <?endforeach;?>
           <tr v-if="searchPosts.length > 0">
               <td v-for="item in (index,searchPosts)" :key="item.id">{{item.title}}</td>
           </tr>
       </table>
   </div>
</div>


<style>
    [v-cloak] {
        display: none;
    }
</style>

<script type="module" src="/template/views/table/js/list.js"></script>

