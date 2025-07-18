<!DOCTYPE html>
<html>
<head>
    <title><?=$title;?></title>
</head>
<body>

<?
/** @var $this \View  */


$this->include('partials/header'); ?>

<? $this->include('pages/'.$page); ?>

<? $this->include('partials/footer');?>

</body>
</html>