<?php
namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);



        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

    
        // $mailIt = Yii::$app->mailer->compose();
        // $mailIt->setFrom([Yii::$app->General->GetSettings('support_email') => Yii::$app->General->GetSettings('site_name')]);
        // $mailIt->setTo($this->email);
        // $mailIt->setSubject('Password reset for ' . Yii::$app->General->GetSettings('site_name'));
        // $body = Yii::$app->view->renderFile('@app/mail/passwordResetToken-html.php',['user' => $user]); 
        // $mailIt->setHtmlBody($body);
        // return $mailIt->send();

        return Yii::$app
            ->mailer
            ->compose(
                // ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['html' => 'password_reset_token_html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->General->GetSettings('support_email') => Yii::$app->General->GetSettings('site_name') . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->General->GetSettings('site_name'))
            ->send();
    }
}
