<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id id do favorito
 * @property int $plate_id id do prato
 * @property string $date data
 * @property int $user_id id do utilizador
 *
 * @property Plate $plate
 * @property User $user
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plate_id', 'user_id'], 'required'],
            [['plate_id', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['plate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plate::class, 'targetAttribute' => ['plate_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id do favorito',
            'plate_id' => 'id do prato',
            'date' => 'data',
            'user_id' => 'id do utilizador',
        ];
    }

    /**
     * Gets query for [[Plate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlate()
    {
        return $this->hasOne(Plate::class, ['id' => 'plate_id']);
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
