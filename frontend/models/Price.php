<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property string $created_at
 * @property double $value
 * @property integer $garden_id
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
            [['value'], 'number'],
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
            'created_at' => 'Created At',
            'value' => 'Value',
            'garden_id' => 'Garden ID',
        ];
    }

    public static function getCurrentPrice()
    {
        return Price::find()
            ->select('id, value')
            ->where([
                'garden_id' => Garden::getCurrentId(),
            ])
            ->orderBy('id DESC')
            ->one();
    }
}
