<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Relations]].
 *
 * @see Relations
 */
class RelationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Relations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Relations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
