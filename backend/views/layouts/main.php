<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная страница',  'url' => ['/site/index']]
        ];
    if (!Yii::$app->user->isGuest){
        $menuItems = [
            ['label' => 'Главная страница',  'url' => ['/site/index']],
            ['label' => 'Редактирование', 'items' => [['label' => 'Пользователи', 'url' => ['/customer/index']],
                                                      ['label' => 'Организации', 'url' => ['/garden/index']],
                                                      ['label' => 'Цена оплаты объекта', 'url' => ['/house-price/index']],
                                                      ['label' => 'Настроить "Описание"', 'url' => ['/site/about']],
                                                      ['label' => 'Настроить "Контакты"', 'url' => ['/site/contact']],],

            ],
                     ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->customer_name . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';

    }
    else
    {
        $menuItems[] = ['label' => 'Идентификация', 'url' => ['/site/login']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
