<?php

namespace common\models;

use common\models\Customer;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "customer_ammount_history".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $operation
 * @property string $admin
 * @property double $operation_money
 * @property integer $created_at
 * @property integer $garden_id
 */
class CustomerAmmountHistory extends \yii\db\ActiveRecord
{
    const PAY = 0;
    const REPLENISHMENT = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_ammount_history';
    }

    public function behaviors()
    {
        return [
            'timestamp'  => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ]
        ];
    }

    public function getOperationName()
    {
        return ArrayHelper::getValue(self::getOperationArray(), $this->operation);
    }

    public static function getOperationArray()
    {
        return [
            self::PAY => 'Оплата',
            self::REPLENISHMENT => 'Пополнение',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'operation', 'admin', 'operation_money'], 'required'],
            [['customer_id', 'operation', 'garden_id'], 'integer'],
            [['operation_money'], 'number'],
            [['admin'], 'string', 'max' => 50],
        ];
    }

    public function getCustomerName()
    {
        $customer = $this->customer;
        return $customer ? $customer->customer_name : '';
    }

    public function getGardenName()
    {
        $garden = $this->garden;
        return $garden ? $garden->garden_name : '';
    }


    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getGarden()
    {
        return $this->hasOne(Garden::className(), ['id' => 'garden_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Пользователь',
            'garden_id' => 'Садоводчество',
            'operation' => 'Операция',
            'admin' => 'Имя администратора',
            'operation_money' => 'Деньги операции',
            'created_at' => 'Дата проведения операции',
        ];
    }
}

