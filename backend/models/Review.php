<?php

namespace app\models;

use Yii;
use common\models\User;
use common\models\Plate;


/**
 * This is the model class for table "review".
 *
 * @property int $id id da review
 * @property int $user_id id do utilizador
 * @property int $plate_id id do prato
 * @property string $description descrição da review
 * @property int $value valor da review
 * @property string $date_time data
 *
 * @property Plate $plate
 * @property User $user
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'plate_id', 'description', 'value'], 'required'],
            [['user_id', 'plate_id'], 'integer'],
            [['date_time'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['plate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plate::class, 'targetAttribute' => ['plate_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['value'], 'integer', 'min' => 0, 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'user_id' => 'Cliente',
            'plate_id' => 'Prato',
            'description' => 'Descrição',
            'value' => 'Valor',
            'date_time' => 'Data',
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
