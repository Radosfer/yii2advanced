<?php
namespace app\models;

use Yii;
use yii\base\Model;
use common\models\Customer;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_customer;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // customername and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getCustomer();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect customer_name or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided customername and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $isLogin = Yii::$app->user->login($this->getCustomer(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            if ($isLogin) {
                /** @var Customer $user */
                $user = Yii::$app->user->identity;
                $user->generateAuthKey();
                $user->save(true, ['auth_key']);
            }
            return $isLogin;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[customername]]
     *
     * @return Customer|null
     */

    protected function getCustomer()
    {
        if ($this->_customer === null) {
            $this->_customer = Customer::findByEmail($this->email);
        }

        return $this->_customer;
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
}
