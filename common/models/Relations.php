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
 * @property string|null $relation_model Связная модель
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
            [['model', 'relation_model'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model' => Yii::t('app', 'Model'),
            'from_id' => Yii::t('app', 'From ID'),
            'to_id' => Yii::t('app', 'To ID'),
            'relation_model' => Yii::t('app', 'Связная модель'),
        ];
    }
}
