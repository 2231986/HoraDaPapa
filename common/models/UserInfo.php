<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $user_id id do user
 * @property string|null $nif número fiscal do cliente
 * @property string|null $nome nome do cliente
 * @property string|null $apelido último nome do cliente
 *
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @var mixed|null
     */
    public $surname;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['nif'], 'string', 'max' => 9],
            [['nome', 'apelido'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'id do user',
            'nif' => 'número fiscal do cliente',
            'nome' => 'nome do cliente',
            'apelido' => 'último nome do cliente',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
