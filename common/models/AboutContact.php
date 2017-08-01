<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about_contact".
 *
 * @property integer $id
 * @property string $about
 * @property string $contact
 */
class AboutContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['about', 'contact'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'about' => 'О нас',
            'contact' => 'Контакты',
        ];
    }
}
