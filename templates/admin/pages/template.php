<?php
//echo '<pre>';
//print_r($data['0']['title']);
?>

<div class="container">

<h1>Новая страница</h1>

    <div class="tab">
        <div class="tab-item"> редактор </div>
        <div class="tab-active"> компонеты </div>
        <div class="tab-active"> параметры </div>
    </div>

    <div class="tab-content">
        <component :is="frmEditors"></component>
    </div>
    <form action="" class="form-control">
        <input class="form-control" type="text" placeholder="название страницы">
        <lable class="lable" > ключевые слова </lable>
        <textarea class="form-control" cols="30" rows="10"></textarea>
        <lable class="lable" > описание страницы </lable>
        <textarea class="form-control" cols="30" rows="10"></textarea>
        <lable class="lable" > компоненты  </lable>
         <div class="form-group d-flex" >
              <select class="form-control">
                  <option value="catalog"> каталог </option>
                  <option value="posts-list"> список постов </option>
              </select>
             <button class="btn ">+</button>
             <button class="btn "> ** </button>
         </div>
        <lable class="lable" > Обработчик  </lable>
        <div class="form-group d-flex" >
            <select class="form-control">
                <option value="standart_route"> стандартная страница </option>
                <option value="custom_route"> кастомный </option>
            </select>
        </div>
    </form>
</div>
