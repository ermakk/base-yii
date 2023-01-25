<?php

namespace common\models;

use common\models\ProductCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductCategorySearch represents the model behind the search form of `app\models\ProductCategory`.
 */
class ProductCategorySearch extends ProductCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['title', 'code', 'comment'], 'safe'],
//            [['parentName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $dataProvider->setSort([
//            'attributes' => [
//                'parentName' => [
//                    'asc' => ['parentName' => SORT_ASC],
//                    'desc' => ['parentName' => SORT_DESC],
//                    'label' => 'Родительская категория',
//                    'default' => SORT_ASC,
//                ]
//            ]
//        ]);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,

        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        if(isset($params["ProductCategorySearch"]["parent_id"]) && $params["ProductCategorySearch"]["parent_id"]){
            $query->andFilterWhere(['in', 'parent_id', ProductCategory::find()->select('id')->where('`title` LIKE "%'. $this->parentName .'%"')]);
        }
//        $query->joinWith(['parent' => function($q){
//            $q->where('`title` LIKE "%'. $this->parentName .'%"');
//        }]);


        return $dataProvider;
    }
}
