<?php

namespace domain\entities;

use domain\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "shop_products".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $created_at
 * @property integer $publishing_at
 * @property string $code
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property string $meta_json
 * @property integer $status
 * @property integer $order
 * @property integer $main_photo_id
 * @property Meta $meta
 *
 * @property Photo[] $photos
 * @property Category $category
 *
 */
class Product extends ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;


    public $meta;
    const ACTIVE = 1;
    const UN_ACTIVE = 0;

    public static function create($category_id, $code, $name, $title, $description, $price,
                                   $meta, $order, $status = self::ACTIVE)
    {
        $product = new static();
        $product->category_id = $category_id;
        $product->created_at = time();
        $product->publishing_at = time();
        $product->code = $code;
        $product->name = $name;
        $product->title = $title;
        $product->description = $description;
        $product->price = $price;
        $product->meta = $meta;
        $product->order = $order;
        $product->status = $status;

        return $product;
    }

    public function edit($category_id, $created_at, $publishing_at, $code, $name, $title, $description, $price,
                         $meta,$order, $status = self::ACTIVE)
    {
        $this->category_id = $category_id;
        $this->created_at = $created_at;
        $this->publishing_at = $publishing_at;
        $this->code = $code;
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->meta = $meta;
        $this->order = $order;
        $this->status = $status;

    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public function isActive()
    {
        return $this->status === self::ACTIVE;
    }

    public function makeActive()
    {
        $this->status = self::ACTIVE;
    }

    public function makeUnActive()
    {
        $this->status = self::UN_ACTIVE;
    }

    public static function tableName()
    {
        return '{{%shop_products}}';
    }

    public function behaviors()
    {

        return [
            MetaBehavior::className(),
        ];
    }

    public function getMainPhoto()
    {
        return $this->hasOne(Photo::class, ['id' => 'main_photo_id']);
    }

    public function addPhoto(UploadedFile $file)
    {
//        $photos = $this->photos;
//        $photos[] = Photo::create($file);
//        $this->updatePhotos($photos);
        $photo = Photo::create($file, $this->id);
        $photo->save();
    }

    public function removePhoto($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                $photo_del = Photo::findOne($id);
                $photo_del->delete();
                $photo_del->save();
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    public function movePhotoUp($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($prev = $photos[$i - 1] ?? null) {
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $prev;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function movePhotoDown($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($next = $photos[$i + 1] ?? null) {
                    $photos[$i] = $next;
                    $photos[$i + 1] = $photo;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy('sort');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

}
