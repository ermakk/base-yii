<?php

namespace ermakk\changelog\models;

use common\models\User;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%likes}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $row_id
 * @property string $model
 *
 * @property User $user
 */
class Changelog extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date']
                ],
                'value' => function ($event) {
                    return time();
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ermakk_history_change}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'row_id', 'model'], 'required'],
            [['user_id', 'row_id', 'date'], 'integer'],
            [['statusRead'], 'boolean'],
            [['fields'], 'string'],
            [['model', 'action',  'comment'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ermakk-changelog', 'ID'),
            'user_id' => Yii::t('ermakk-changelog', 'User ID'),
            'row_id' => Yii::t('ermakk-changelog', 'Row ID'),
            'model' => Yii::t('ermakk-changelog', 'Model'),
            'action' => Yii::t('ermakk-changelog', 'Action'),
            'fields' => Yii::t('ermakk-changelog', 'filds'),
            'date' => Yii::t('ermakk-changelog', 'Data change'),
            'comment' => Yii::t('ermakk-changelog', 'Comment'),
            'statusRead' => Yii::t('ermakk-changelog', 'Status read'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRow()
    {
        return $this->hasOne($this->model, ['id' => 'row_id']);
    }

    public function getTitle()
    {
        return Yii::t('ermakk-changelog', 'User'). ' '.Html::a(Yii::$app->user->identity->username, [Yii::$app->getModule('changelog')->user['url'], 'id' => $this->user_id]).' '.Yii::t('ermakk-changelog', $this->action).' '.$this->model.' - id='.$this->row_id;

    }
}
