<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property int $proxy_id
 * @property int $email_id
 * @property string $username
 * @property string $password
 *
 * @property Email $email
 * @property Proxy $proxy
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proxy_id', 'email_id'], 'integer'],
            [['password'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email_id'], 'exist', 'skipOnError' => true, 'targetClass' => Email::className(), 'targetAttribute' => ['email_id' => 'id']],
            [['proxy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proxy::className(), 'targetAttribute' => ['proxy_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proxy_id' => 'Proxy ID',
            'email_id' => 'Email ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmail()
    {
        return $this->hasOne(Email::className(), ['id' => 'email_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProxy()
    {
        return $this->hasOne(Proxy::className(), ['id' => 'proxy_id']);
    }
    public function getProxyGuzzleFormat()
    {
        $p = Proxy::find()->where(['id' => $this->proxy_id])->one();

        return "http://".$p->password."@".$p->ip.":".$p->port;
    }
}
