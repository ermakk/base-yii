<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id Идентификатор
 * @property string|null $originalName Оригинальное имя файла
 * @property string|null $hash Хеш сумма
 * @property string|null $path Путь до файла
 * @property string|null $format Расширение файла
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class File extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['originalName', 'hash', 'path', 'format'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Идентификатор'),
            'originalName' => Yii::t('app', 'Оригинальное имя файла'),
            'hash' => Yii::t('app', 'Хеш сумма'),
            'path' => Yii::t('app', 'Путь до файла'),
            'format' => Yii::t('app', 'Расширение файла'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ]
        ];
        return parent::behaviors(); // TODO: Change the autogenerated stub
    }
}
