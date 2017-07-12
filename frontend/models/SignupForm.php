<?php
namespace app\models;

use yii\base\Model;
use common\models\Customer;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $customer_name;
    public $email;
    public $password;
    public $garden_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['customer_name', 'trim'],
            ['customer_name', 'required'],
            ['customer_name', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This customername has already been taken.'],
            ['customer_name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['garden_id', 'required'],
            ['garden_id', 'integer'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return Customer|null the saved model or null if saving fails
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'garden_id' => 'Садоводчество',
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $customer = new Customer();
        $customer->customer_name = $this->customer_name;
        $customer->email = $this->email;
        $customer->garden_id = $this->garden_id;
        $customer->setPassword($this->password);
        $customer->generateAuthKey();
        
        return $customer->save() ? $customer : null;
    }
}
