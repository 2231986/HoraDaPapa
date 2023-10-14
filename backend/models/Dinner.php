<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dinner".
 *
 * @property int $id id da mesa
 * @property string $name nome da mesa
 * @property int $isClean estado da mesa
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
            [['isClean'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id da mesa',
            'name' => 'nome da mesa',
            'isClean' => 'estado da mesa',
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
