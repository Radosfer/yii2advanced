<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $title
 * @property integer $garden_id
 * @property integer $spent
 * @property integer $last_indication
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'spent', 'last_indication'], 'required'],
            [['garden_id'], 'default', 'value' => Garden::getCurrentId()],
            [['spent', 'last_indication'], 'integer'],
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
            'title' => 'Title',
            'spent' => 'Spent',
            'last_indication' => 'Last Indication',
            'garden_id' => 'Garden ID',
        ];
    }
}
