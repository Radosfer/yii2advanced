<?php

namespace app\models;

use Yii;
use common\models\Garden;
/**
 * This is the model class for table "pay".
 *
 * @property integer $id
 * @property integer $house_id
 * @property string $created_at
 * @property integer $price_id
 * @property integer $amount
 * @property integer $garden_id
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
            'created_at' => 'Created At',
            'price_id' => 'Price ID',
            'amount' => 'Amount',
            'garden_id' => 'Garden ID',
        ];
    }
}
