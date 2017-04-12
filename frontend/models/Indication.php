<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "indication".
 *
 * @property integer $id
 * @property integer $counter_id
 * @property string $created_at
 * @property integer $value
 */
class Indication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indication';
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
