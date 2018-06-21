<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Blogger;

/**
 * BloggerSearch represents the model behind the search form of `common\models\Blogger`.
 */
class BloggerSearch extends Blogger
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'index_url', 'post_regexp', 'title_regexp', 'content_regexp'], 'safe'],
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
        $query = Blogger::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'index_url', $this->index_url])
            ->andFilterWhere(['like', 'post_regexp', $this->post_regexp])
            ->andFilterWhere(['like', 'title_regexp', $this->title_regexp])
            ->andFilterWhere(['like', 'content_regexp', $this->content_regexp]);

        return $dataProvider;
    }
}
