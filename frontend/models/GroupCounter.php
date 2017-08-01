<?php

namespace app\models;

use common\models\Garden;
use Yii;

/**
 * This is the model class for table "group_counter".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $created_at
 * @property integer $value
 * @property integer $garden_id
 */
class GroupCounter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'created_at', 'value'], 'required'],
            [['group_id', 'value'], 'integer'],
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
            'group_id' => 'Group ID',
            'created_at' => 'Created At',
            'value' => 'Value',
            'garden_id' => 'Garden ID',
        ];
    }
}
