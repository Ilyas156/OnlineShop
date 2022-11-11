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
    public $created_at;
    public $username;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'status', 'created_at'], 'integer'],
            [['username', 'email'], 'safe'],
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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}