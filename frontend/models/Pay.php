<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pay".
 *
 * @property integer $id
 * @property integer $house_id
 * @property string $created_at
 * @property integer $price_id
 * @property integer $amount
 */
class Pay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'created_at', 'price_id', 'amount'], 'required'],
            [['house_id', 'price_id', 'amount'], 'integer'],
            [['created_at'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'price_id' => 'Price ID',
            'amount' => 'Amount',
        ];
    }
}
