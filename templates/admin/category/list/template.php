<div class="container" id="categorylist">
    <div class="col-md-12">
        <div class="card" v-for="item in category">
            <div class="title">{{item.title}}</div>
        </div>
        <div class="panel">
            <button @click="actionShowFormAdd" class="btn btn-danger">{{backTitle}}</button>
        </div>
        <form   v-if="showFormAdd">
            <input type="text" class="form-control" placeholder="title">
        </form>
    </div>
</div>

<script type="module" src="/templates/admin/category/list/js/category.list.js"></script>