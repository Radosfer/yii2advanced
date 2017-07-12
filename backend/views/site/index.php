<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Управление садоводчествами</h1>

        <p class="lead">Добро пожаловать.</p>


    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Управление пользователями</h2>

                <p>Возможны следующие операции:</p>
                <ul>
                    <li>
                        <p> Создание нового пользователя</p>
                    </li>
                    <li>
                        <p> Редактирование данных пользователей</p>
                    </li>
                    <li>
                        <p> Изменение статуса пользователя.</p>
                    </li>
                    <li>
                        <p> Пополнение счета садоводчества от имени пользователя.</p>
                    </li>
                    <li>
                        <p> Просмотр истории денежных операций пользователей.</p>
                    </li>
                </ul>

                    <p><a class="btn btn-default" href="/customer/index">Управление пользователями &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Управление садоводчествами</h2>

                <p>Возможны следующие операции:</p>
                <ul>
                    <li>
                        <p> Создание нового садоводчества</p>
                    </li>
                    <li>
                        <p> Блокирование садоводчества</p>
                    </li>
                </ul>

                <p><a class="btn btn-default" href="/garden/index">Управление садоводчествами &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Управление ценой оплаты</h2>

                <p>Возможны следующие операции:</p>
                <ul>
                    <li>
                        <p> Изменить цену оплаты за дом для садоводства</p>
                    </li>
                </ul>

                <p><a class="btn btn-default" href="/house-price/index">Управление ценой оплаты &raquo;</a></p>
            </div>

        </div>

    </div>
</div>
