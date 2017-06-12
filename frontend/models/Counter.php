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
 * @property integer $finish_value
 * @property integer $garden_id
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
            [['house_id', 'created_at', 'value', 'finish_value'], 'required'],
            [['house_id', 'value', 'finish_value'], 'integer'],
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
            'value' => 'Value',
            'finish_value' => 'Finish Value',
            'garden_id' => 'Garden ID',
        ];
    }
}
