<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_testimony".
 *
 * @property integer $id
 * @property integer $group_counter_id
 * @property string $created_at
 * @property integer $value
 */
class Testimony extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_testimony';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_counter_id', 'created_at', 'value'], 'required'],
            [['group_counter_id', 'value'], 'integer'],
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
            'group_counter_id' => 'Group Counter ID',
            'created_at' => 'Created At',
            'value' => 'Value',
        ];
    }

    public static function getCurrentTestimony()
    {
        return Testimony::find()
            ->select('id, value')
            ->orderBy('id DESC')
            ->one();
    }

}
