<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\User\User;

/**
 * UserSearch represents the model behind the search form about `shop\entities\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $status;
    public $dateFrom;
    public $dateTo;
    public $username;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'email'], 'safe'],
            [['dateFrom', 'dateTo'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(
                [
                    '>=',
                    'created_at',
                    $this->dateFrom ? strtotime($this->dateFrom . ' 00:00:00') : null
                ]
            )
            ->andFilterWhere(
                [
                    '<=',
                    'created_at',
                    $this->dateTo ? strtotime($this->dateTo . ' 23:59:59') : null
                ]
            );;

        return $dataProvider;
    }
}