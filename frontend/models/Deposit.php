<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deposit".
 *
 * @property integer $id
 * @property integer $house_id
 * @property double $amount
 * @property string $purpose
 * @property string $date
 * @property integer $garden_id
 */
class Deposit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deposit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'amount', 'purpose', 'date'], 'required'],
            [['house_id', 'garden_id'], 'integer'],
            [['amount'], 'number'],
            [['purpose'], 'string'],
            [['date'], 'string', 'max' => 255],
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
            'amount' => 'Amount',
            'purpose' => 'Purpose',
            'date' => 'Date',
            'garden_id' => 'Garden ID',
        ];
    }
}
