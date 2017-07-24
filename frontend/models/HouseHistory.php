<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $house_id
 * @property string $date
 * @property double $pay
 * @property integer $testimony
 * @property double $tariff
 * @property double $money
 * @property integer $start_indication
 * @property integer $garden_id
 */
class HouseHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'date', 'pay', 'testimony', 'tariff', 'money', 'start_indication'], 'required'],
            [['house_id', 'testimony', 'start_indication'], 'integer'],
            [['tariff', 'pay', 'money'], 'number'],
            [['date'], 'string', 'max' => 255],
            [['garden_id'], 'default', 'value' => Garden::getCurrentId()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'house_id' => 'House ID',
            'date' => 'Date',
            'pay' => 'Pay',
            'testimony' => 'Testimony',
            'tariff' => 'Tariff',
            'money' => 'Money',
            'start_indication' => 'Start Indication',
            'garden_id' => 'Garden ID',
        ];
    }
}