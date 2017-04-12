<?php
namespace frontend\controllers;

use app\models\Indication;
use app\models\Pay;
use app\models\Street;
use app\models\Group;
use app\models\House;
use app\models\Man;
use app\models\Price;
//use Codeception\Lib\Generator\Group;
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
        if ($action->id === 'indication') {
            # code...
            $this->enableCsrfValidation = false;

            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
                Yii::$app->end();
            }
        }
        if ($action->id === 'pay') {
            # code...
            $this->enableCsrfValidation = false;

            if (Yii::$app->getRequest()->getMethod() == 'OPTIONS') {
                Yii::$app->end();
            }
        }
        return parent::beforeAction($action);
    }

    public function actionStreets()
    {

//         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

//        return Street::find()->asArray()->all();

//        return [
//  [
//    "id"=> 1,
//    "title"=> "1st Avenue"
//  ],
//  [
//    "id"=> 2,
//    "title"=> "2st Avenue"
//  ],
//  [
//    "id"=> 3,
//    "title"=> "3st Avenue"
//  ],
//  [
//    "id"=> 4,
//    "title"=> "4st Avenue"
//  ]
//];


    }

    public function actionMans()
    {
        //
    }

    public function actionPrice()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Price::getCurrentPrice();
    }

    public function actionIndication()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $counterId = Yii::$app->request->post('counter_id');
        $value_new = Yii::$app->request->post('value');
        $created_at = Yii::$app->request->post('created_at');
        $houseId = Yii::$app->request->post('houseId');

        $indication = new Indication();
        $indication->value = $value_new;
        $indication->counter_id = $counterId;
        $indication->created_at = $created_at;
        $indication->save();
//        if (!$indication->save()){
//            return ['success' => false, 'errors' => $indication->errors];
//        }
//        return ['success' => true, 'data' => $houseId];

        $house = House::findOne($houseId);
        $value = $house->testimony;
        $value = $value_new - $value;
        $house->testimony = $value;
        $house->save();

    }

    public function actionPay()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $house_id = Yii::$app->request->post('house_id');
        $created_at = Yii::$app->request->post('created_at');
        $price_id = Yii::$app->request->post('price_id');
        $amount = Yii::$app->request->post('amount');

        $pay = new Pay();
        $pay->house_id = $house_id;
        $pay->created_at = $created_at;
        $pay->price_id = $price_id;
        $pay->amount = $amount;
        $pay->save();

        $price_value = Price::find()->select('value')->orderBy('id DESC')->scalar();
//        return ['success' => true, 'data' => $house_id];
        $money = $amount / $price_value;

        $house = House::findOne($house_id);
        $testimony = $house->testimony;
        $new_testimony = $testimony - $money;
        $house->testimony = $new_testimony;
        $house->save();

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

    public function actionHouses()
    {
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

//        return House::find()->asArray()->all();

//        return [
//            [
//                "id"=>  1,
//                "street_id"=>  1,
//                "group_id"=>  1,
//                "title"=>  1
//            ],
//            [
//                "id"=>  2,
//                "street_id"=>  2,
//                "group_id"=>  1,
//                "title"=>  2
//            ],
//            [
//                "id"=>  3,
//                "street_id"=>  3,
//                "group_id"=>  1,
//                "title"=>  3
//            ],
//            [
//                "id"=>  4,
//                "street_id"=>  2,
//                "group_id"=>  3,
//                "title"=>  4
//            ],
//            [
//                "id"=>  5,
//                "street_id"=>  4,
//                "group_id"=>  3,
//                "title"=>  5
//            ],
//            [
//                "id"=>  6,
//                "street_id"=>  3,
//                "group_id"=>  3,
//                "title"=>  6
//            ],
//            [
//                "id"=>  7,
//                "street_id"=>  4,
//                "group_id"=>  1,
//                "title"=>  7
//            ]
//        ];
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
