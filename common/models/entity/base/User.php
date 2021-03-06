<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\entity\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property string $oauth_client
 * @property string $oauth_client_user_id
 * @property string $email
 * @property integer $status
 * @property integer $logged_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\entity\UserProfile $userProfile
 * @property string $aliasModel
 */
abstract class User extends \yii\db\ActiveRecord
{




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_key', 'access_token', 'password_hash', 'email'], 'required'],
            [['status', 'logged_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['access_token'], 'string', 'max' => 40],
            [['password_hash', 'oauth_client', 'oauth_client_user_id', 'email'], 'string', 'max' => 255],
            [['attachments'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'username' => Yii::t('models', 'Username'),
            'auth_key' => Yii::t('models', 'Auth Key'),
            'access_token' => Yii::t('models', 'Access Token'),
            'password_hash' => Yii::t('models', 'Password Hash'),
            'oauth_client' => Yii::t('models', 'Oauth Client'),
            'oauth_client_user_id' => Yii::t('models', 'Oauth Client User ID'),
            'email' => Yii::t('models', 'Email'),
            'status' => Yii::t('models', 'Status'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
            'logged_at' => Yii::t('models', 'Logged At'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(\common\models\entity\UserProfile::className(), ['user_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \common\models\entity\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\entity\query\UserQuery(get_called_class());
    }


}
