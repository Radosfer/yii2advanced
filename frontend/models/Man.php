<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "man".
 *
 * @property integer $id
 * @property string $fio
 * @property string $phone
 */
class Man extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'man';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'phone'], 'required'],
            [['phone'], 'string'],
            [['fio'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'phone' => 'Phone',
        ];
    }
}
