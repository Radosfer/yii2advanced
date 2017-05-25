<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property integer $id
 * @property integer $house_id
 * @property string $created_at
 * @property integer $value
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'created_at', 'value'], 'required'],
            [['house_id', 'value'], 'integer'],
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
            'value' => 'Value',
        ];
    }
}
