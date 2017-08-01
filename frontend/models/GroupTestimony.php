<?php

namespace app\models;

use common\models\Garden;
use Yii;

/**
 * This is the model class for table "group_testimony".
 *
 * @property integer $id
 * @property integer $group_counter_id
 * @property string $created_at
 * @property integer $value
 * @property integer $garden_id
 */
class GroupTestimony extends \yii\db\ActiveRecord
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
            'group_counter_id' => 'Group Counter ID',
            'created_at' => 'Created At',
            'value' => 'Value',
            'garden_id' => 'Garden ID',
        ];
    }
}
