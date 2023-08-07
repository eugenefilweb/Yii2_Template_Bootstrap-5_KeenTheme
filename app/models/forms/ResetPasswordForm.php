<?php
namespace app\models\forms;

use yii\base\InvalidArgumentException;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use Yii;
use app\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new NotFoundHttpException('Password reset token cannot be blank.');
            // throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new NotFoundHttpException('Wrong password reset token or is expired.');
            // throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            // ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();
        $user->generateAccessToken();
        $user->save(false);

        return Yii::$app
            ->mailer
            ->compose(
                [
                    'html' => 'password_reset_success_html', 
                    // 'text' => 'password_reset_success_text'
                ],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->General->GetSettings('support_email') => Yii::$app->General->GetSettings('site_name') . ' robot'])
            ->setTo($user->email)
            ->setSubject('Password reset success for ' . Yii::$app->General->GetSettings('site_name'))
            ->send();
    }
}
