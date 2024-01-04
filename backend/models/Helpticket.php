<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "help_ticket".
 *
 * @property int $id id do ticket
 * @property int $user_id id utilizador que fez ticket
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
            [['user_id', 'needHelp', 'description'], 'required'],
            [['needHelp'], 'in', 'range' => [0, 1]],
            [['user_id'], 'integer'],
            [['date_time'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id do ticket',
            'user_id' => 'id utilizador que fez ticket',
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
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getTodayTickets()
    {
        return self::find()
            ->where(['>=', 'date_time', date('Y-m-d 00:00:00')])
            ->andWhere(['<=', 'date_time', date('Y-m-d 23:59:59')])->all();
    }
}
