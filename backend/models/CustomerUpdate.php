<?php

namespace app\models;

use yii\base\Model;
use common\Models\Customer;
use yii\helpers\VarDumper;

class CustomerUpdate extends Model
{
    public $customer_name;
    public $email;
    public $password;
    public $garden_id;

    private $_customer;
    /**
     * @inheritdoc
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function __construct(Customer $customer, $config = [])
    {
        $this->_customer = $customer;
        $this->customer_name = $customer->customer_name;
        $this->email = $customer->email;
        $this->garden_id = $customer->garden_id;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['customer_name', 'trim',],
            ['customer_name', 'required'],
          //  ['customer_name', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This customer_name has already been taken.'],
            ['customer_name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
        //    ['email', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'on' => [self::SCENARIO_CREATE]],
            ['password', 'string', 'min' => 6, 'on' => [self::SCENARIO_CREATE]],
            ['password', 'string', 'on' => [self::SCENARIO_UPDATE]],

            ['garden_id', 'required'],
            ['garden_id', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'garden_id' => 'Организация',
        ];
    }

    public function isNewRecord()
    {
        return $this->_customer->isNewRecord;
    }

    public function getCustomerId()
    {
        return $this->_customer->getId();
    }

    public function getCustomer_name()
    {
        return $this->_customer->customer_name;
    }

    /**
     * Signs customer up.
     *
     * @return Customer|null the saved model or null if saving fails
     */
    public function update()
    {

        if (!$this->validate()) {
            return null;
        } else {
            $customer = $this->_customer;
            $customer->customer_name = $this->customer_name;
            $customer->email = $this->email;
            $customer->garden_id = $this->garden_id;
            if ((!$this->password==null) || (!$this->password=='')) {
                $customer->setPassword($this->password);
                $customer->generateAuthKey();
            }
            return $customer->save() ? $customer : null;
        }
    }

}

