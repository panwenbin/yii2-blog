## 安装说明
0. 因为是Yii2项目，PHP要求5.4以上，具体见 [Yii2 Requirements](http://www.yiiframework.com/doc-2.0/guide-intro-yii.html#requirements-and-prerequisites)
1. 在项目根目录执行安装 `composer install`
2. 配置数据库 在`common/config/main-local.php`
3. 在项目根目录运行数据库迁移 `php yii migrate`