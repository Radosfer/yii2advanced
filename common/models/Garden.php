<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii;
use yii\web\NotFoundHttpException;
/**
 * This is the model class for table "gardens".
 *
 * @property integer $id
 * @property string $gardenname
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property double $money
 * @property string $till_date
 */
class Garden extends \yii\db\ActiveRecord
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'garden';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Заблокировано',
            self::STATUS_ACTIVE => 'Активно',
        ];
    }

    public function rules()
    {
        return [
            [['garden_name'], 'string', 'max' => 255],
            [['garden_name'], 'unique'],
            [['garden_name'], 'required'],

            [['money'], 'number'],

            [['till_date'], 'string'],
            [['till_date'], 'required'],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
        ];
    }

    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['garden_id' => 'id']);
    }

    public function getHouses()
    {
        return $this->hasMany(House::className(), ['garden_id' => 'id']);
    }

    public function getHousePrices()
    {
        return $this->hasMany(HousePrice::className(), ['garden_id' => 'id']);
    }

    /**
     * @return int
     * @throws NotFoundHttpException
     */
    public static function getCurrentId()
    {
    //    yii\helpers\VarDumper::dump(Yii::$app->request->get('token'),10,1);die();
        if (Yii::$app->request->get('token') == '') {
            throw new NotFoundHttpException('Invalid token');
        }

        /** @var Customer $customer */
        $customer = Customer::findOne([
            'auth_key' => Yii::$app->request->get('token'),
        ]);

        if (!$customer){
            throw new NotFoundHttpException('Customer not found');
        }

        if (!$customer->garden){
            throw new NotFoundHttpException('Garden not found');
        }

        if (!$customer->garden->status){
            throw new NotFoundHttpException('Need to pay');
        }
        return $customer->garden_id;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'garden_name' => 'Название Садоводчества',
            'status' => 'Статус',
            'money' => 'Денежный счет',
            'till_date' => 'Активен до:',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }
}
