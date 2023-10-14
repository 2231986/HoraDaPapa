<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id id do pedido
 * @property int $meal_id id da refeição
 * @property string $observation comentários extra
 * @property int $plate_id id do prato
 * @property int $isCooked estado do cozinheiro
 * @property int $isDelivered estado do garçon
 * @property int $user_id id do utilizador
 *
 * @property Meal $meal
 * @property Plate $plate
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meal_id', 'observation', 'plate_id', 'user_id'], 'required'],
            [['meal_id', 'plate_id', 'isCooked', 'isDelivered', 'user_id'], 'integer'],
            [['observation'], 'string', 'max' => 255],
            [['meal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meal::class, 'targetAttribute' => ['meal_id' => 'id']],
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
            'id' => 'id do pedido',
            'meal_id' => 'id da refeição',
            'observation' => 'comentários extra',
            'plate_id' => 'id do prato',
            'isCooked' => 'estado do cozinheiro',
            'isDelivered' => 'estado do garçon',
            'user_id' => 'id do utilizador',
        ];
    }

    /**
     * Gets query for [[Meal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeal()
    {
        return $this->hasOne(Meal::class, ['id' => 'meal_id']);
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
