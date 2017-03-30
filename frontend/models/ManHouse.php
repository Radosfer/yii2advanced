<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "man_house".
 *
 * @property integer $id
 * @property integer $man_id
 * @property integer $house_id
 */
class ManHouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'man_house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['man_id', 'house_id'], 'required'],
            [['man_id', 'house_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'man_id' => 'Man ID',
            'house_id' => 'House ID',
        ];
    }
}
