<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dinner".
 *
 * @property int $id id da mesa
 * @property string $name nome da mesa
 * @property int $isClean estado da mesa
 * @property string $date_time date
 *
 * @property Meal[] $meals
 */
class Dinner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dinner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['isClean'], 'in', 'range' => [0, 1]],
            [['date_time'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identificador',
            'name' => 'Nome',
            'isClean' => 'Estado',
            'date_time' => 'Data',
        ];
    }

    /**
     * Gets query for [[Meals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeals()
    {
        return $this->hasMany(Meal::class, ['dinner_table_id' => 'id']);
    }
}
