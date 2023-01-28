<?php

namespace common\models;

use http\Url;
use Imagine\Image\Box;
use ermakk\changelog\models\ActiveRecord;
//use yarcode\eav\models\Attribute;
//use yarcode\eav\models\AttributeValue;
use yii\imagine\Image;
use Yii;
use yii\helpers\BaseInflector;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id Идентификтор
 * @property string $title Название
 * @property string $code Символьный код
 * @property string|null $artikul Артикул
 * @property string|null $text Описание
 * @property int|null $category_id Категория
 * @property int|null $type_id Тип
 *
 * @property ProductCategory $category
 * @property ProductPrice[] $productPrices
 * @property ProductReceipt[] $productReceipts
 * @property ProductReview[] $productReviews
 * @property ProductType $type
 */
class Product extends ActiveRecord
{
    /**
    * Параметр для поля формы загрузки изображений
    */
    public $file;
    /**
     * Параметр для организации массива записей связных изображений
     * @var array $image_list
     */
    public $image_list = [];
    /**
     * {@inheritdoc}
     */
//    const SCENARIO_CREATE_PRODUCT = 'create';
//    const SCENARIO_UPDATE_PRODUCT = 'update';
//
//    public function scenarios()
//    {
//        $scenarios = parent::scenarios();
//        $scenarios[self::SCENARIO_CREATE_PRODUCT] = ['file'];
//        $scenarios[self::SCENARIO_UPDATE_PRODUCT] = ['file'];
//        return $scenarios; // TODO: Change the autogenerated stub
//    }

    public static function tableName()
    {
        return 'product';
    }
//    public function load($data, $formName = null)
//    {
//        if(isset($data['Product'])) {
//            if($data['Product']['code'] == '') {
//                $data['Product']['code'] = BaseInflector::slug($data['Product']['title']);
//            }
//        }
//        return parent::load($data, $formName); // TODO: Change the autogenerated stub
//    }

public function beforeSave($insert)
{
    foreach($this->file as $index => $file) {
        $image = new File();
        $image->originalName = $file->name;
    //            $image->format = substr($file->name, strpos($file->name,'.')+1, strlen($file->name) - strpos($file->name,'.') - 1);
        $image->format = $file->type;
        $dir = Yii::getAlias('@frontend') . '/web/upload';
    //            if($insert) {
        if (FileHelper::createDirectory($dir . '/images/'. ($this->category_id ?: '0') . '/'. Yii::$app->user->id, '0777', true)) {
            $name = ($this->category_id ?: '0') . '/'. Yii::$app->user->id . '/' . time(). $index. rand(0, 100) . '.' . $file->extension;
//                        var_dump($name); die;
            $file->saveAs($dir . '/images/'. $name);
            if (FileHelper::createDirectory($dir . '/imgprev/'. ($this->category_id ?: '0') . '/' .  Yii::$app->user->id, '0777', true)) {

                $preview = Image::getImagine()->open($dir . '/images/' . $name);
                $preview->thumbnail(new Box(600, 400))
                    ->save($dir .'/imgprev/'. $name, ['quality' => 90]);
            }

            $image->hash = hash('ripemd160', $name);
            $image->path = $name;
            if($image->save()){
                $imids = $this->image_ids;
                $imids[] = $image->id;
                $this->image_ids = $imids;
//                $rel = new Relations(); /** @var Relations  $rel **/
//                $rel->to_id = $image->id;
//                $rel->relation_model = $image::className();
//                $rel->from_id = $this->id;
//                $rel->model = self::className();
//                if (!$rel->save()){
////                    $image->delete();
//                }
            }


            //file_put_contents($dir.$name, $file);
    //                    var_dump($dir.$this->images);
    //                    die;
        }
    //            } else {
    //                if (FileHelper::createDirectory($dir . '/upload/' . Yii::$app->user->getId(), '0777', true)) {
    ////                    unlink($dir.$this->images);
    //                    $file->saveAs($dir.$this->file);
    ////
    //                    if (FileHelper::createDirectory($dir . '/upload/imgprev/' . Yii::$app->user->getId(), '0777', true)) {
    //
    //                        $preview = Image::getImagine()->open($dir .$this->image);
    //                        $preview->thumbnail(new Box(600, 400))
    //                            ->save($dir .'/upload/imgprev' .$this->image , ['quality' => 90]);
    //
    //                    }
    //
    //
    //                }
    //            }
    }
    return parent::beforeSave($insert); // TODO: Change the autogenerated stub
}

    public function beforeValidate()
    {
        if ($this->code == '') {
            $this->code = BaseInflector::slug($this->title);
        }

        $this->file = UploadedFile::getInstances($this, 'file');
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function getImageList($fullSize = true){
        //получаем список ссылок на изображения данной модели
        $images = [];
        foreach ($this->image_ids as $image_id){
            $file =  File::find()->where(['id' => $image_id])->one();
            $images[] =  ['key' => $file->id, 'path' => '/upload'. ($fullSize ? '/images/' : '/imgprev/.') .  $file->path];
        }
        return $images;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['category_id', 'type_id'], 'integer'],
            [['title', 'code', 'artikul', 'text', 'code'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::class, 'targetAttribute' => ['type_id' => 'id']],
            [['image_ids'], 'each', 'rule' => ['integer']],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, bmp, gif', 'maxFiles' => 10],
//            [['color'], 'string', 'max' => 255], // Attribute field
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификтор',
            'title' => 'Название',
            'code' => 'Символьный код',
            'artikul' => 'Артикул',
            'text' => 'Описание',
            'category_id' => 'Категория',
            'type_id' => 'Тип',
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => \yarcode\eav\EavBehavior::className(),
                'valueClass' => ObjectAttributeValue::className(),
            ],
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'image_ids' => [
                        'images',
                        'viaTableValues' => [
                            'model' => self::className(),
                            'relation_model' => File::className(),
                        ],
                        'customDeleteCondition' => [
                            'model' => self::className(),
                            'relation_model' => File::className(),
                        ]
                    ]
                ],
            ],
        ];
    }

    public function getImages(){//, 'relation_model' => self::className(), 'model' => File::className()
        return $this->hasMany(File::className(), ['id' => 'to_id'])
            ->viaTable(Relations::tableName(), ['from_id' => 'id'], function ($query){
                $query->andWhere([
                    'model' => self::className(),
                    'relation_model' => File::className()
                ]);
                return $query;
            });
    }



    /**
     * @return yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
//        $query = ObjectAttribute::find()->where(['categoryId' => $this->category_id]);
        $query = $this->hasMany(ObjectAttribute::className(), ['categoryId' => 'parentCategoryList']);
//        var_dump($query); die;
        $query->multiple = true;
        return $query;
    }



    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }

    /**
     * Функция возвращает массив идентификаторов категорий от текущей до родительской
     *
     * @return int[]|null[]
     */
    public function getParentCategoryList(){
        $parent_category = $this->category->hasOne(ProductCategory::class, ['id' => 'parent_id'])->one(); /** @var ProductCategory $parent_category **/
        $res = [$this->category_id];
        while ($parent_category !== null){
            $res[] = $parent_category->id;
            $parent_category = $parent_category->parent;
        }
//        var_dump($res); die;
        return $res;
    }


    /**
     * Проверяет является ли идентифкатор категории наследственным
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|ProductCategoryQuery
     */
    public function checkCategory($category_id)
    {
        return $this->hasOne(ProductCategory::class, ['in', 'id', $this->getParentCategoryList()]);
    }

    /**
     * Gets query for [[ProductPrices]].
     *
     * @return \yii\db\ActiveQuery|ProductPriceQuery
     */
    public function getProductPrices()
    {
        return $this->hasMany(ProductPrice::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductReceipts]].
     *
     * @return \yii\db\ActiveQuery|ProductReceiptQuery
     */
    public function getProductReceipts()
    {
        return $this->hasMany(ProductReceipt::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductReviews]].
     *
     * @return \yii\db\ActiveQuery|ProductReviewQuery
     */
    public function getProductReviews()
    {
        return $this->hasMany(ProductReview::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::class, ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }


}
