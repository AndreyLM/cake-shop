<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.06.17
 * Time: 1:37
 */

namespace domain\searches;



use domain\entities\Menu;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MenuSearch extends Model
{
    public $id;
    public $name;
    public $type;
    public $related_id;

    public function rules()
    {
        return [
            [['id', 'type', 'related_id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'name' => 'Название',
            'type' => 'Тип',
            'related_id' => 'ИД связи'
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params)
    {
        $query = Menu::find()->andWhere(['>', 'depth', 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['lft' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'related_id' => $this->related_id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}