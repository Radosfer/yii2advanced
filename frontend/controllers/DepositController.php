<?php
/**
 * Created by PhpStorm.
 * User: talik
 * Date: 20.07.17
 * Time: 19:58
 */
namespace frontend\controllers;

//use app\models\Deposit;

use yii\rest\ActiveController;

class DepositController extends ActiveController
{
    public $modelClass = 'app\models\Deposit';
}
