<?php

namespace yeesoft\seo\models;

use yeesoft\models\OwnerAccess;
use yeesoft\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yeesoft\db\ActiveRecord;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $author
 * @property string $keywords
 * @property string $description
 * @property integer $index
 * @property integer $follow
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Seo extends ActiveRecord implements OwnerAccess
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo}}';
    }

    public function init()
    {
        parent::init();

        if ($this->isNewRecord && $this->className() == 'yeesoft\seo\models\Seo') {
            $this->index = 1;
            $this->follow = 1;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['keywords', 'description'], 'string'],
            [['index', 'follow', 'created_by', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['url', 'title'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 127],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yee', 'ID'),
            'url' => Yii::t('yee', 'Url'),
            'title' => Yii::t('yee', 'Title'),
            'author' => Yii::t('yee', 'Author'),
            'keywords' => Yii::t('yee/seo', 'Keywords'),
            'description' => Yii::t('yee', 'Description'),
            'index' => Yii::t('yee/seo', 'Index'),
            'follow' => Yii::t('yee/seo', 'Follow'),
            'created_by' => Yii::t('yee', 'Created By'),
            'created_at' => Yii::t('yee', 'Created'),
            'updated_at' => Yii::t('yee', 'Updated'),
            'updated_by' => Yii::t('yee', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullSeoAccess';
    }

    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }

    public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }
}