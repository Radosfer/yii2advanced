<?php
namespace app\models;

use Yii;
use yii\base\Model;
use common\models\Customer;
/**
 * Login form
 */
class AdminLoginForm extends Model
{
    public $customer_name;
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
            [['customer_name', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'customer_name' => 'Имя администратора',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
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
            $customer = $this->getCustomer();
            if (!$customer || !$customer->validatePassword($this->password)) {
                $this->addError('password', 'Неверное имя пользователя или пароль.');
            } elseif ($customer && $customer->status == Customer::STATUS_BLOCKED) {
                $this->addError('customer_name', 'Ваш аккаунт заблокирован.');
            } elseif ($customer && $customer->status == Customer::STATUS_WAIT) {
                $this->addError('customer_name', 'Ваш аккаунт не подтвежден.');
            }
        }
    }

    /**
     * Logs in a customer using the provided customer_name and password.
     *
     * @return bool whether the customer is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getCustomer(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds customer by [[customer_name]]
     *
     * @return Customer|null
     */
    protected function getCustomer()
    {
        if ($this->_customer === null) {
            $this->_customer = Admin::findByCustomerName($this->customer_name);
        }

        return $this->_customer;
    }
}
