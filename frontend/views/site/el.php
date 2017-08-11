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
<script type=text/javascript src=/static/js/manifest.4965b9113ccbba60899b.js></script>
<script type=text/javascript src=/static/js/vendor.af57a394cfa75dcc8fc4.js></script>
<script type=text/javascript src=/static/js/app.f8ce5232a58e298418f6.js></script>

</body>
</html>