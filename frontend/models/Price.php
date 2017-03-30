<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property string $created_at
 * @property integer $value
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'value'], 'required'],
            [['created_at'], 'safe'],
            [['value'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'value' => 'Value',
        ];
    }

    public static function getCurrentPrice()
    {
        return Price::find()
            ->select('value')
            ->orderBy('id DESC')
            ->scalar();
    }
}
