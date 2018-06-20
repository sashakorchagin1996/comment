<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use app\components\SaveException;
use app\components\ValidationException;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Account;
use app\models\Proxy;
use app\models\Email;
use app\models\UploadForm;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionAdd()
    {
        $fp = fopen("account.txt", "r"); 
            if ($fp) 
                {
                    while (!feof($fp))
                        {
                            $transaction = Yii::$app->db->beginTransaction();
                            $mytext = fgets($fp, 999);
                            $e = explode(":", $mytext);
                            $email = new Email();
                            $email->username = $e[6];
                            $email->password = $e[7];
                            if (!$email->validate())
                                 throw new ValidationException('email');
                            if(!$email->save())
                                 throw new SaveException('email');
                            $proxy = new Proxy();
                            $proxy->ip = $e[2];
                            $proxy->port = $e[3];
                            $proxy->password = $e[4].":".$e[5];
                            if (!$proxy->validate())
                                 throw new ValidationException('proxy');
                            if(!$proxy->save())
                                 throw new SaveException('proxy');
                            $account = new Account();
                            $account->proxy_id = $proxy->id;
                            $account->email_id = $email->id;
                            $account->username = $e[0];
                            $account->password = $e[1];
                            if (!$account->validate())
                                 throw new ValidationException('account');
                            if (!$account->save())
                                 throw new SaveException('account');
                             $transaction->commit();
                         }
                         
                }
            else echo "Ошибка при открытии файла";
                fclose($fp); 
    }
    public function actionPost()
    {
        $debug = true;
        $truncatedDebug = false;
        $instagram = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        $account = Account::find()->where(['id' => 11])->one();
        $instagram->setProxy($account->getProxyGuzzleFormat());
        try {
            $instagram->login($account->username, $account->password);
            $timelineFeed = $instagram->timeline->getTimelineFeed();
            // Получили список постов из новостной ленты
            $items = $timelineFeed->getFeedItems();
            $media_id = $items[0]->getMediaOrAd()->getId();
            $instagram->media->comment($media_id,"что делаешь?");
            $link = $items[0]->getMediaOrAd()->getItemUrl();
            echo $link;
            } catch (InstagramException $e) {
                print_r($e->getMessage());
            }

    }
}
