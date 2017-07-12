<?php

namespace console\controllers;

use common\models\Garden;
use yii\console\Controller;
use yii;
use common\models\Customer;
use common\models\CustomerAmmountHistory;
use common\models\House;
use common\models\HousePrice;

/**
 * GardensController implements the CRUD actions for Gardens model.
 */
class PayController extends Controller
{

    public function actionIndex()
    {

        $gardens = Garden::findBySql('SELECT * FROM garden WHERE till_date<now()')->all();

        if (!$gardens) {
            return;
        }

        foreach ($gardens as $garden) {

            $house_count_customer = House::find()->where(['garden_id' => $garden->id])->count();
            $house_price_customer = HousePrice::find()->select('price')->where(['garden_id' => $garden->id])->orderBy(['id' => SORT_DESC])->scalar();

            $price = $house_count_customer * $house_price_customer;

            //Вычитаем из счета сумму за все дома садоводчества
            $customerAmmountHistory = new CustomerAmmountHistory();
            $customerAmmountHistory->customer_id = 0; // Пользователь - отсутствует будет отображаться в админке "-"
            $customerAmmountHistory->operation = CustomerAmmountHistory::PAY;
            $customerAmmountHistory->admin = 'Robot';
            $customerAmmountHistory->garden_id = $garden->id;
            $customerAmmountHistory->operation_money = $price;

            if (!$customerAmmountHistory->save()) {
                print_r($customerAmmountHistory->getErrors());
            }

            //Обновляем till_date на 1 месяц
            $till_date = new \DateTime($garden->till_date);
            $till_date->add(new \DateInterval('P1M'));
            $garden->till_date = Yii::$app->formatter->asDate($till_date);

            if ($garden->status == Garden::STATUS_ACTIVE & $garden->money < 0) {   //Блокируем если небыли заблокированы
                $garden->status = Garden::STATUS_BLOCKED;
                Customer::updateAll(['status' => Customer::STATUS_BLOCKED], ['like', 'garden_id', $garden->id]);
            }

            //Денежный счет меняется в garden
            $garden->money = $garden->money - $price;

            if (!$garden->save()) {
                print_r($garden->getErrors());
            }

        }

    }
}