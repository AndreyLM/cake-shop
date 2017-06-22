<?php

namespace domain\searches;

use domain\entities\Product;

use domain\helpers\ProductHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ProductSearch extends Model
{
//    public static function create($category_id, $code, $name,
//          $title, $description, $price,
//                                  $meta, $order, $status = self::ACTIVE)
    public $id;
    public $category_id;
    public $code;
    public $name;
    public $title;
    public $price;
    public $status;
    public $created_at;



    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'code'], 'integer'],
            [['title', 'name', 'price'], 'safe'],
//            [['created_at', 'publishing_at'], 'date'],
        ];
    }

    public function search(array $params)
    {
        $query = Product::find()->with('category');//->leftJoin('category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'code'=> $this->code
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    public function statusList(): array
    {
        return ProductHelper::statusList();
    }
}