<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Управление организациями</h1>

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
                        <p> Пополнение счета организации от имени пользователя.</p>
                    </li>
                    <li>
                        <p> Просмотр истории денежных операций пользователей.</p>
                    </li>
                </ul>

                    <p><a class="btn btn-success" href="/customer/index">Управление пользователями &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Управление организациями</h2>

                <p>Возможны следующие операции:</p>
                <ul>
                    <li>
                        <p> Создание новой организации</p>
                    </li>
                    <li>
                        <p> Блокирование организации</p>
                    </li>
                    <li>
                        <p> Изменить цену оплаты за объект для организации</p>
                    </li>
                </ul>

                <p><a class="btn btn-success" href="/garden/index">Управление организациями &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Настройка текста страниц "Описание" и "Контакты"</h2>

                <p>Возможны следующие операции:</p>
                <ul>
                    <li>
                        <p> Настройка текста страницы "Описание"</p>
                    </li>
                    <li>
                        <p> Настройка текста страницы "Контакты"</p>
                    </li>
                </ul>

                <p><a class="btn btn-success" href="/site/about">Настроить "Описание" &raquo;</a></p>
                <p><a class="btn btn-success" href="/site/contact">Настроить "Контакты" &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
