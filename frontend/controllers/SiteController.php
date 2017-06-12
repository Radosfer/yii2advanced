<?php
namespace frontend\controllers;

use app\models\Counter;
use app\models\Garden;
use app\models\GroupCounter;
use app\models\Indication;
use app\models\Pay;
use app\models\Street;
use app\models\Group;
use app\models\House;
use app\models\Man;
use app\models\Price;
use app\models\GroupTestimony;
use app\models\HouseHistory;
//use Codeception\Lib\Generator\Group;
use Symfony\Component\BrowserKit\History;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

//use frontend\models\Streets; // 123

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout', 'signup'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['signup'],
    //                     'allow' => true,
    //                     'roles' => ['?'],
    //                 ],
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        // ...set `$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is true.

        $actions = ['indication', 'pay', 'testimony', 'history', 'counter', 'group', 'group_testimony'];
        if (in_array($action->id, $actions)) {
            # code...
            $this->enableCsrfValidation = false;

            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
                Yii::$app->end();
            }
        }

//        if ($action->id === 'indication') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
//        if ($action->id === 'pay') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
//        if ($action->id === 'testimony') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
//        if ($action->id === 'history') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
//        if ($action->id === 'counter') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
//        if ($action->id === 'group') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
//        if ($action->id === 'group_testimony') {
//            # code...
//            $this->enableCsrfValidation = false;
//
//            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
//                Yii::$app->end();
//            }
//        }
        return parent::beforeAction($action);
    }

    public function actionGet_street()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Street::find()//todo проверка наличия записи
        ->where(['garden_id' => Garden::getCurrentId()])
            ->orderBy('title ASC')
            ->all();
    }

    public function actionGet_group()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Group::find()//todo проверка наличия записи
        ->where(['garden_id' => Garden::getCurrentId()])
            ->orderBy('title ASC')
            ->all();
    }

    public function actionMans()
    {
        //
    }

    public function actionPrice()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $price = Price::getCurrentPrice();
        return $price ? $price : ['error' => 'Установите стоимость киловата'];
    }

    public function actionCounter()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $houseId = Yii::$app->request->post('house_id');
        $created_at = Yii::$app->request->post('created_at');
        $value = Yii::$app->request->post('value');

        $house = House::findOne([
            'id' => $houseId,
            'garden_id' => Garden::getCurrentId(),
        ]);//todo проверка наличия записи
        $house->start_value = 0;
        $house->last_indication = $value;
        $house->save();

        $counter = new Counter();
        $counter->house_id = $houseId;
        $counter->created_at = $created_at;
        $counter->value = $value;
        $counter->garden_id = Garden::getCurrentId();
        $counter->finish_value = 0;
        $counter->save();

        return $house;
    }

    public function actionTestimony()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $group_id = Yii::$app->request->post('group_id');
        return Group::find()//todo проверка наличия записи
            ->where([
                'id' => $group_id,
                'garden_id' => Garden::getCurrentId()
                ])
            ->orderBy('id DESC')
            ->one();

    }

    public function actionHistory()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $house_id = Yii::$app->request->post('house_id');
        return HouseHistory::find()//todo проверка наличия записи
        ->where([
            'house_id' => $house_id,
            'garden_id' => Garden::getCurrentId(),
            ])
            ->orderBy('id DESC')
            ->all();
    }

    public function actionGroup() //addGroupCounter
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $value = Yii::$app->request->post('value');
        $groupId = Yii::$app->request->post('group_id');
        $created_at = Yii::$app->request->post('created_at');

        $groupcounter = new GroupCounter();
        $groupcounter->value = $value;
        $groupcounter->group_id = $groupId;
        $groupcounter->created_at = $created_at;
        $groupcounter->garden_id = Garden::getCurrentId();
        $groupcounter->save();

        $lastGroupCounterId = GroupCounter::find()
                                            ->select('id')
                                            ->where([
                                                'group_id' => $groupId,
                                                'garden_id' => Garden::getCurrentId()
                                                 ])
                                            ->orderBy('id DESC')
                                            ->scalar();

        $testimony = new GroupTestimony();
        $testimony->value = $value;
        $testimony->group_counter_id = $lastGroupCounterId;
        $testimony->created_at = $created_at;
        $testimony->garden_id = Garden::getCurrentId();
        $testimony->save();

        $group = Group::findOne([
            'id' => $groupId,
            'garden_id' => Garden::getCurrentId()
        ]);//todo проверка наличия записи
        $group->last_indication = $value;
        $group->save();

        return $group;


    }

    public function actionGroup_testimony()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $value = Yii::$app->request->post('value');
        $groupId = Yii::$app->request->post('group_id');
        $created_at = Yii::$app->request->post('created_at');

        $groupCounterId = GroupCounter::find()
            ->select('id')
            ->where([
                'group_id' => $groupId,
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
        if ($groupCounterId == null) {
            return ['error' => 'Отсутствует счетчик для данной группы! Введите стартовые показания нового счетчика, затем вводите текущие показания!'];
//            return ['error' => $groupCounterId];
        }
        $previousValue = GroupTestimony::find()
            ->select('value')
            ->where([
                'group_counter_id' => $groupCounterId,
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
//        if(!$previousValue && $previousValue != 0){
        if ($previousValue == null) {
            return ['error' => 'Отсутствуют предыдущие показания счетчика!'];
        }

        $testimony = new GroupTestimony();
        $testimony->value = $value;
        $testimony->group_counter_id = $groupCounterId;
        $testimony->created_at = $created_at;
        $testimony->garden_id = Garden::getCurrentId();
        $testimony->save();


        $group = Group::findOne([
            'id' => $groupId,
            'garden_id' => Garden::getCurrentId()
        ]);//todo проверка наличия записи
//        $group = Group::findOne(0);//todo проверка наличия записи
        if ($group == null) {
            return ['error' => 'Невозможно получить запись Group::findOne(' . $groupId . ')!'];
        }
        $spent = $group->spent;
        $group->spent = $spent + ($value - $previousValue);
        $group->last_indication = $value;
        $group->save();

        return $group;

    }


    public function actionIndication()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        $counterId = Yii::$app->request->post('counter_id');
        $value_new = Yii::$app->request->post('value');
        $created_at = Yii::$app->request->post('created_at');
        $houseId = Yii::$app->request->post('houseId');

        $price_value = Price::find()
            ->select('value')
            ->where([
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
        if (!$price_value) {
            return ['error' => 'Установите стоимость киловата'];
        }


        $counterId = Counter::find()
            ->select('id')
            ->where([
                'house_id' => $houseId,
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
        if ($counterId == null) {
            return ['error' => 'Невозможно получить $counterId из Counter!'];
        }
        $previous_indication = Indication::find()
            ->select('value')
            ->where([
                'counter_id' => $counterId,
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();

//            if($previous_indication == null){
//                return ['error' => 'Невозможно получить $previous_indication из Indication!'];
//            }

        if ($previous_indication > $value_new) {
            return ['error' => 'Новые показание меньше предыдущих!'];
        }

        $start_indication = Counter::find()
            ->select('value')
            ->where([
                'house_id' => $houseId,
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
        if ($start_indication == null) {
            return ['error' => 'Невозможно получить $start_indication из Counter!'];
        }

        $indication = new Indication();
        $indication->value = $value_new;
        $indication->counter_id = $counterId;
        $indication->created_at = $created_at;
        $indication->garden_id = Garden::getCurrentId();
        $indication->save();

//        $start_indication = Counter::find()->select('value')->where(['house_id' => $houseId])->orderBy('id DESC')->scalar();


        $house = House::findOne([
            'id' => $houseId,
            'garden_id' => Garden::getCurrentId()
        ]);//todo
        $money = $house->money;
        $spent = $house->spent;
        $last_indication = $house->last_indication;
        $start_or_not = $house->start_value;

        if ($start_or_not == 0) {
            $money = $money - (($value_new - $previous_indication - $start_indication) * $price_value);
            $start_or_not = 1;
        } else {
            $money = $money - (($value_new - $previous_indication) * $price_value);
        }

        $house->money = $money;
        $house->start_value = $start_or_not;
        $house->testimony = $money / $price_value;
        $house->last_indication = $value_new;
//        $house->spent = $value_new - $start_indication + $spent;
        $house->spent = $value_new - $last_indication + $spent;
        $house->save();
        $house = $house->attributes;
        $house['created_at'] = $created_at;

        $history = new HouseHistory();
        $history->house_id = $houseId;
        $history->date = $created_at;
        $history->pay = 0;
        $history->testimony = $value_new;
        $history->tariff = $price_value;
        $history->money = $money;
        $history->start_indication = $start_indication;
        $history->garden_id = Garden::getCurrentId();
        $history->save();

        return $house;

    }

    public function actionPay()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $house_id = Yii::$app->request->post('house_id');
        $created_at = Yii::$app->request->post('created_at');
        $price_id = Yii::$app->request->post('price_id');
        $amount = Yii::$app->request->post('amount');

        $price_value = Price::find()
            ->select('value')
            ->where([
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
        if ($price_value == null) {
            return ['error' => 'Невозможно получить $price_value из Price!'];
        }

        $start_indication = Counter::find()
            ->select('value')
            ->where([
                'house_id' => $house_id,
                'garden_id' => Garden::getCurrentId()
            ])
            ->orderBy('id DESC')
            ->scalar();
        if ($start_indication == null) {
            return ['error' => 'Невозможно получить $start_indication из Counter!'];
        }
        $pay = new Pay();
        $pay->house_id = $house_id;
        $pay->created_at = $created_at;
        $pay->price_id = $price_id;
        $pay->amount = $amount;
        $pay->garden_id = Garden::getCurrentId();
        $pay->save();

//        $price_value = Price::find()->select('value')->orderBy('id DESC')->scalar();
//
//        $start_indication = Counter::find()->select('value')->where(['house_id' => $house_id])->orderBy('id DESC')->scalar();

        $house = House::findOne([
            'id' => $house_id,
            'garden_id' => Garden::getCurrentId()
        ]);//todo
        $money_value = $house->money;
        $money_value = $money_value + $amount;
        $new_testimony = $money_value / $price_value;
        $house->testimony = $new_testimony;
        $house->money = $money_value;
        $house->save();

        $history = new HouseHistory();
        $history->house_id = $house_id;
        $history->date = $created_at;
        $history->pay = $amount;
        $history->testimony = 0;
        $history->tariff = $price_value;
        $history->money = $money_value;
        $history->start_indication = $start_indication;
        $history->garden_id = Garden::getCurrentId();
        $history->save();

        return $house->attributes;
    }


    public function actionGroups()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        //return Group::find()->asArray()->all();

//        return [
//            [
//                "id"=> 1,
//                "title"=> "1st Groups"
//            ],
//            [
//                "id"=> 2,
//                "title"=> "2st Groups"
//            ],
//            [
//                "id"=> 3,
//                "title"=> "3st Groups"
//            ],
//            [
//                "id"=> 4,
//                "title"=> "4st Groups"
//            ]
//        ];
    }

    public function actionHouse()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return House::find()//todo проверка наличия записи
            ->where(['garden_id' => Garden::getCurrentId()])
            ->orderBy('id DESC')
            ->all();
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
