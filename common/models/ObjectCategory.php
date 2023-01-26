<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "object_category".
 *
 * @property int $id
 * @property string|null $seoName
 * @property string|null $name
 *
 * @property ObjectAttribute[] $objectAttributes
 * @property Object[] $objects
 */
class ObjectCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seoName', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seoName' => 'Seo Name',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ObjectAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAttributes()
    {
        return $this->hasMany(ObjectAttribute::class, ['categoryId' => 'id']);
    }

    /**
     * Gets query for [[Objects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Object::class, ['categoryId' => 'id']);
    }
}
