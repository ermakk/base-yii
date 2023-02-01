<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    private $params = null;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type_id', 'price'], 'integer'],
            [['title', 'code', 'artikul', 'text'], 'safe'],
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
        $query = Product::find()->joinWith('productPrices');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'price' => [
                    'asc' => [ProductPrice::tableName().'.value' => SORT_ASC],
                    'desc' => [ProductPrice::tableName().'.value' => SORT_DESC],
                    'label' => 'Стоимость',
                    'default' => SORT_ASC,
                ]
            ]
        ]);

        $this->load($params);
        $this->params = $params;

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'artikul', $this->artikul])
            ->andFilterWhere(['like', 'text', $this->text]);

        if(isset($params["price_max"])){
            $query->joinWith(['productPrices' => function($q){
                $q->where(['<=', ProductPrice::tableName().'.value', $this->params["price_max"]]);
            }]);
        }
        if(isset($params["price_min"])){
            $query->joinWith(['productPrices' => function($q){
                $q->where(['>=', ProductPrice::tableName().'.value', $this->params["price_min"]]);
            }]);
        }


        return $dataProvider;
    }
}
