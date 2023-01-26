<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace yarcode\eav;

use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class EavBehavior
 * @package yarcode\eav
 *
 * @mixin ActiveRecord
 * @property DynamicModel $eavModel;
 * @property ActiveRecord $owner
 */
class EavBehavior extends Behavior
{
    /** @var array */
    public $valueClass;
    /** @var string */
    public $relationName = 'eavAttributes';

    protected $dynamicModel;

    public function init()
    {
        assert(isset($this->valueClass));
    }

    /**
     * @return DynamicModel
     */
    public function getEavModel()
    {
        if (!$this->dynamicModel instanceof DynamicModel) {
            $this->dynamicModel = DynamicModel::create([
                'entityModel' => $this->owner,
                'valueClass' => $this->valueClass,
                'behavior' => $this,
            ]);
        }
        return $this->dynamicModel;
    }
}