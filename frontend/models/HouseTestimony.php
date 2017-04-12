<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house_testimony".
 *
 * @property integer $id
 * @property integer $counter_id
 * @property string $created_at
 * @property integer $value
 */
class HouseTestimony extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house_testimony';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['counter_id', 'created_at', 'value'], 'required'],
            [['counter_id', 'value'], 'integer'],
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
            'counter_id' => 'Counter ID',
            'created_at' => 'Created At',
            'value' => 'Value',
        ];
    }
}
