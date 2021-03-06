<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\essence\Comment;

/**
 * CommentSearch represents the model behind the search form of `common\essence\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rejeser_id', 'film_id', 'actor_id', 'parent_id', 'created_by'], 'integer'],
            [['text'], 'safe'],
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
        $query = Comment::find();

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
            'rejeser_id' => $this->rejeser_id,
            'film_id' => $this->film_id,
            'actor_id' => $this->actor_id,
            'parent_id' => $this->parent_id,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
