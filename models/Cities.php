<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string|null $name
 * @property float $lat
 * @property float $long
 *
 * @property Tasks[] $tasks
 * @property Users[] $users
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lat', 'long'], 'required'],
            [['lat', 'long'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lat' => 'Lat',
            'long' => 'Long',
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TasksQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['city_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CitiesQuery(get_called_class());
    }
}
