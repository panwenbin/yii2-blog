<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace console\controllers;


use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Backup mysql database and send with mailer
 * @package console\controllers
 */
class BackupController extends Controller
{
    public function actionDb()
    {
        if ('admin@example.com' == Yii::$app->params['adminEmail']) {
            Console::stderr("Please set adminEmail in console/config/params-local.php first\r\n");
        }
        $mysql = Yii::$app->db;
        if (preg_match('/^mysql:(?<keyPairsString>.+)/', $mysql->dsn, $match)) {
            $keyPairs = explode(';', $match['keyPairsString']);
            $mysqlValues = [];
            foreach ($keyPairs as $keyPair) {
                if (strpos($keyPair, '=')) {
                    list($key, $value) = explode('=', $keyPair);
                    $mysqlValues[$key] = $value;
                }
            }
            if (isset($mysqlValues['host'], $mysqlValues['dbname'])) {
                $filename = $mysqlValues['dbname'] . '_' . date('YmdHis') . '.sql.gz';
                $outfile = Yii::getAlias('@runtime/') . $filename;
                $backupCmd = "mysqldump -h{$mysqlValues['host']} -u{$mysql->username} " . ($mysql->password ? " -p{$mysql->password}" : "") . " {$mysqlValues['dbname']} |gzip > {$outfile}";
                exec($backupCmd);
                if (!file_exists($outfile)) {
                    Console::stderr(date('Y-m-d H:i:s') . " Backup failed with cmd: {$backupCmd}\r\n");
                }
                $mailSent = Yii::$app->mailer->compose()
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject("Yii2Blog Backup: {$filename}")
                    ->setTextBody("Yii2Blog Backup: {$filename}")
                    ->attach($outfile)
                    ->send();
                Console::stdout(date('Y-m-d H:i:s') . " Mail sent: {$mailSent}\r\n");
            }
        }
    }
}