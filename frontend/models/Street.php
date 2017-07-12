<?php

namespace app\models;

use Yii;
use common\models\Garden;
/**
 * This is the model class for table "streets".
 *
 * @property integer $id
 * @property integer $garden_id
 * @property string $title
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['garden_id'], 'default', 'value' => Garden::getCurrentId()],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Avenue',
            'garden_id' => 'Garden ID',
        ];
    }
}
