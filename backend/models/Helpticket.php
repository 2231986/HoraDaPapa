<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "help_ticket".
 *
 * @property int $id id do ticket
 * @property int $id_user id utilizador que fez ticket
 * @property int $needHelp estado da ajuda
 * @property string $description descrição do pedido de ajuda
 * @property string $date_time data
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
        return 'help_ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'needHelp', 'description'], 'required'],
            [['id_user', 'needHelp'], 'integer'],
            [['date_time'], 'safe'],
            [['description'], 'string', 'max' => 255],
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
            'needHelp' => 'estado da ajuda',
            'description' => 'descrição do pedido de ajuda',
            'date_time' => 'data',
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

    public function getTodayTickets()
    {
        return self::find()
            ->where(['>=', 'date_time', date('Y-m-d 00:00:00')])
            ->andWhere(['<=', 'date_time', date('Y-m-d 23:59:59')])->all();
    }
}
