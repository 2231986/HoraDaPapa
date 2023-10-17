<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "helpticket".
 *
 * @property int $id id do ticket
 * @property int $id_user id utilizador que fez ticket
 * @property int $status Estado da ajuda
 *
 * @property User $user
 */
class Helpticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'helpticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'status'], 'required'],
            [['id_user', 'status'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id do ticket',
            'id_user' => 'id utilizador que fez ticket',
            'status' => 'Estado da ajuda',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
