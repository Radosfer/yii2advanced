<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>Electra</title>
    <link rel=stylesheet href=https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel=stylesheet>
    <link href=/static/sweetalert/dist/sweetalert.css rel=stylesheet>
    <link href=/static/css/app.5c86ca4670da28b509d2d367ab4897b2.css rel=stylesheet>
</head>
<body>
<div class=container>
    <div id=app></div>
</div>
<script>
    var AUTH_USER = "<?= Yii::$app->user->identity->auth_key;?>";
    var baseUrl = '';
    var currency = ' грн';
</script>
<script src=https://code.jquery.com/jquery-3.2.1.min.js></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js></script>
<script src=/static/sweetalert/dist/sweetalert-dev.js></script>
<script type=text/javascript src=/static/js/manifest.d05e58f889cc3502a17c.js></script>
<script type=text/javascript src=/static/js/vendor.f1eaf850adb53035032d.js></script>
<script type=text/javascript src=/static/js/app.5b73a3b8801add03626b.js></script>
</body>
</html>