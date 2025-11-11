<h2>страницы</h2>

<?$params = htmlspecialchars(json_encode([
    'endpoints'=>[
        "listRecord"=>'/api/page.list/find/',
        "oneRecord"=>'/api/page.list/find/',
        "save"=>'/api/page.list/save/'
    ]

]),ENT_QUOTES,'UTF-8');?>

<div id="app-page"></div>
<script id="app-page-list-setting"  type="module" src="/templates/admin/components/js/pageList/app.js"
        data-settings="<?//=$params?>">
</script>