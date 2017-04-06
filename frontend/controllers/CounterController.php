<?php
namespace frontend\controllers;

use yii\rest\ActiveController;

class CounterController extends ActiveController
{
    public $modelClass = 'app\models\Counter';
}
