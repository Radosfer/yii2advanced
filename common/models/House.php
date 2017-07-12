<?php

namespace common\models;

use Yii;
use common\models\Garden;
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
 * @property integer $last_indication
 * @property integer $spent
 * @property integer $garden_id
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
            [['street_id', 'group_id', 'title', 'fio', 'phone', 'money', 'testimony', 'start_value', 'last_indication', 'spent'], 'required'],
            [['street_id', 'group_id', 'testimony', 'start_value', 'last_indication', 'spent'], 'integer'],
            [['money'], 'number'],
            [['title', 'fio', 'phone'], 'string', 'max' => 255],
            [['garden_id'], 'default', 'value' => Garden::getCurrentId()],
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
            'street_id' => 'Street ID',
            'group_id' => 'Group ID',
            'title' => 'Title',
            'fio' => 'Fio',
            'phone' => 'Phone',
            'money' => 'Money',
            'testimony' => 'Testimony',
            'start_value' => 'Start Value',
            'last_indication' => 'Last Indication',
            'spent' => 'Spent',
            'garden_id' => 'Garden ID',
        ];
    }
}
