<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('dashboard.css') ?>
    <link
        href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
        rel="stylesheet">
</head>
<body class="home">

<?= $this->element('header') ?>

<?php
if ($hasData){
    // TODO: UIを綺麗にする
    var_dump($data);
} else {
    echo "<h2>There is no track backs.</h2><";
}
?>

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
