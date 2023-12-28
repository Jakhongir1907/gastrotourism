<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class UserUpdateForm extends Model
{
    public $username;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password'], 'safe'],
            // rememberMe must be a boolean value
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function save()
    {
        if (!empty($this->password)) {
            $user = User::findByUsername('admin');
            if ($user->updateAttributes(['password_hash' => \Yii::$app->security->generatePasswordHash($this->password)])) {
                return true;
            }
        }
        
        return false;
    }
}
