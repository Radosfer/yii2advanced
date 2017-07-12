<?php

namespace app\models;

use yii;
use yii\base\Model;
use common\Models\Customer;
use common\Models\Garden;
use common\models\CustomerAmmountHistory;
use yii\web\NotFoundHttpException;
class CustomerAddMoney extends Model
{
    public $money;

    private $_сustomerAmmountHistory;
    private $_customer;

    /**
     * @inheritdoc
     */

    public function __construct(Customer $customer, $config = [])
    {
        $this->_customer = $customer;
        $this->_сustomerAmmountHistory = new CustomerAmmountHistory();
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['money', 'required'],
            ['money', 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'garden_id' => 'Садоводчество',
            'money' => 'Денежный счет'
        ];
    }

    public function getCustomer_name()
    {
        return $this->_customer->customer_name;
    }

    public function getCustomerAmmountHistory()
    {
        return $this->_сustomerAmmountHistory;
    }

    public function addmoney()
    {
        if (!$this->validate()) {
            return null;
        } else {
            $customer = $this->_customer;

            if (!$customer){
            throw new NotFoundHttpException('Customer not found');
            }

            if (!$customer->garden){
            throw new NotFoundHttpException('Garden not found');
            }

            $this->_сustomerAmmountHistory->customer_id = $customer->id;
            $this->_сustomerAmmountHistory->admin = Yii::$app->user->identity->customer_name;
            $this->_сustomerAmmountHistory->garden_id = $customer->garden_id;
            //Денежный счет меняется в garden
            $customer->garden->money = $customer->garden->money+$this->money;

            $this->_сustomerAmmountHistory->operation_money = $this->money;
            $this->_сustomerAmmountHistory->operation_money>=0 ?  $this->_сustomerAmmountHistory->operation = CustomerAmmountHistory::REPLENISHMENT :  $this->_сustomerAmmountHistory->operation = CustomerAmmountHistory::PAY;

            if (!$this->_сustomerAmmountHistory->save()) return null;

            //Если были заблокированы, но счет стал >=0 равблокируем
            if ($customer->garden->status == Garden::STATUS_BLOCKED & $customer->garden->money>=0)
            {
                $customer->garden->status = Garden::STATUS_ACTIVE;
                Customer::updateAll(['status' => Customer::STATUS_ACTIVE], ['like', 'garden_id', $customer->garden_id]);
            }

            return $customer->garden->save() ? $customer : null;

        }
    }
}
