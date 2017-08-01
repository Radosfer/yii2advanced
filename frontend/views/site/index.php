<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\web\NotFoundHttpException;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">

        <?php

        if (!Yii::$app->user->isGuest)
        {
            $customer=Yii::$app->user->getIdentity();

            if (!$customer){
                throw new NotFoundHttpException('Customer not found');
            }

            if (!$customer->garden){
                throw new NotFoundHttpException('Garden not found');
            }

            // Если садоводство заблокировано то выводим сообщение
            if (!$customer->garden->status)
            {
                //   echo Html::script('alert("Ваше садоводство заблокировано. Пожалуйста внесите на счет садоводства ... грн.");', ['defer' => true]);
                /*      echo Alert::widget([
                          'options' => [
                              'class' => 'alert-danger'
                          ],
                          'body' => '<h2>Ваше садоводство заблокировано. Пожалуйста внесите на счет садоводства ... грн..</h2>'
                      ]); */

                Modal::begin([
                    'header' => '<h2>Пожалуйста внесите на счет организации '.$customer->garden->garden_name.' - '.(-1*$customer->garden->money).' грн.!</h2>',
                    'toggleButton' => [
                        'tag' => 'button',
                        'class' => 'btn-lg btn-block btn-danger',
                        'label' => 'Ваша организация '.$customer->garden->garden_name.' заблокирована!',
                    ]
                ]);

                echo 'Организация '.$customer->garden->garden_name.' заблокирована.';

                Modal::end();
            };
            echo Html::tag('h1', Html::encode(Yii::$app->user->identity->customer_name), ['class' => 'username']);
        }
        ?>

        <p class="lead">Добро пожаловать.</p>

        <?php if ($customer->garden->status) {?>
        <p><a class="btn btn-lg btn-success" href="http://vitalik/site/el">Управление организацией <?= $customer->garden->garden_name ?></a></p>
        <?php } ?>
    </div>

</div>
