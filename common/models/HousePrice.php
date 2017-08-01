<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\models\Garden;

/**
 * This is the model class for table "usersprice".
 *
 * @property integer $id
 * @property double $price
 * @property integer $created_at
 */
class HousePrice extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'houseprice';
    }

    public function behaviors()
    {
        return [
            'timestamp'  => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['price'], 'required'],
            [['garden_id'], 'integer'],
        ];
    }

    public function getGardenName()
    {
        $garden = $this->garden;
        return $garden ? $garden->garden_name : '';
    }

    public function getGarden()
    {
        return $this->hasOne(Garden::className(), ['id' => 'garden_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Цена за объект',
            'garden_id' => 'Организация',
            'created_at' => 'Создан',
        ];
    }
}
