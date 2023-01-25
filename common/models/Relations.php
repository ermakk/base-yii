<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relations".
 *
 * @property int $id
 * @property string $model
 * @property int $from_id
 * @property int $to_id
 */
class Relations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'from_id', 'to_id'], 'required'],
            [['from_id', 'to_id'], 'integer'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'from_id' => 'From ID',
            'to_id' => 'To ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RelationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RelationsQuery(get_called_class());
    }
}
