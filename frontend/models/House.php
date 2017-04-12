<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property integer $id
 * @property integer $street_id
 * @property integer $group_id
 * @property string $title
 * @property string $fio
 * @property string $phone
 * @property double $money
 * @property integer $testimony
 * @property integer $start_value
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['street_id', 'group_id', 'title', 'fio', 'phone', 'money', 'testimony', 'start_value'], 'required'],
            [['street_id', 'group_id', 'testimony', 'start_value'], 'integer'],
            [['money'], 'number'],
            [['title', 'fio', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street_id' => 'Street ID',
            'group_id' => 'Group ID',
            'title' => 'Title',
            'fio' => 'Fio',
            'phone' => 'Phone',
            'money' => 'Money',
            'testimony' => 'Testimony',
            'start_value' => 'Start Value',
        ];
    }
}
