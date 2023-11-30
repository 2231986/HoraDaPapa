<?php

namespace common\models;

use console\controllers\RbacController;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['email', 'required'],
            ['username', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token))
        {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token))
        {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Adiciona ou atualiza o Role do Cliente
     */
    public function saveRole($role)
    {
        $authManager = \Yii::$app->authManager;

        // Remove existing roles
        $authManager->revokeAll($this->id);

        // Add a new role
        $newRole = $authManager->getRole(is_string($role) ? $role : $role->name);
        return $authManager->assign($newRole, $this->id);
    }

    /**
     * Get the first User Role
     */
    public function getRole($id = null)
    {
        if ($id == null)
        {
            $id = $this->id;
        }

        $userRole = null;
        $arrayAuthRoleItems = Yii::$app->authManager->getRolesByUser($id);

        if (count($arrayAuthRoleItems) > 0)
        {
            return $userRole = array_values($arrayAuthRoleItems)[0];
        }

        return $userRole;
    }

    /**
     * Get all application Roles
     */
    public function getAllRoles()
    {
        $auth = Yii::$app->authManager;

        return $auth->getRoles();
    }

    /**
     * Get UserInfo
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::class, ['user_id' => 'id']);
    }

    public static function getUserClients()
    {
        $authManager = \Yii::$app->authManager;

        // Get user IDs assigned to the specific role
        $userIds = $authManager->getUserIdsByRole(RbacController::$RoleClient);

        // Fetch users based on user IDs
        return self::find()->where(['id' => $userIds])->all();
    }

    public static function getUserStaff()
    {
        $authManager = \Yii::$app->authManager;

        // Get user IDs assigned to the specified roles
        $userIds = [];
        $roleNames = [RbacController::$RoleAdmin, RbacController::$RoleCooker, RbacController::$RoleWaiter];
        foreach ($roleNames as $roleName)
        {
            $userIds = array_merge($userIds, $authManager->getUserIdsByRole($roleName));
        }

        // Remove duplicate user IDs
        $userIds = array_unique($userIds);

        // Fetch users based on user IDs
        return self::find()->where(['id' => $userIds])->all();
    }
}
