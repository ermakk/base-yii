<?php

namespace common\models;

use ermakk\changelog\models\ActiveRecord;
use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $type Тип данных
 * @property string $name Имя поля
 * @property string $value Значение
 */
class Settings extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип данных',
            'name' => 'Имя поля',
            'value' => 'Значение',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingsQuery(get_called_class());
    }

    public static function getValue($field){
        $res = self::find()->select('value')->where(['name' => $field])->one();
        return $res['value'];
    }
}
