<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProductReview]].
 *
 * @see ProductReview
 */
class ProductReviewQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductReview[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductReview|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
