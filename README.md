## 安装说明
1. 因为是Yii2项目，PHP要求5.4以上，具体见 [Yii2 Requirements](http://www.yiiframework.com/doc-2.0/guide-intro-yii.html#requirements-and-prerequisites)
2. composer.lock文件是基于PHP7.0的，如果PHP版本低于7.0，可以删除composer.lock再安装
3. 在项目根目录执行安装 `composer install --no-dev`
4. 在项目根目录执行初始化 `php init`，然后选1.production
5. 配置数据库 在`common/config/main-local.php`
6. 在项目根目录运行数据库迁移 `php yii migrate`
7. 配置管理员邮箱 在`common/config/params-local.php`
8. 配置Web Server, 前端目录`frontend/web`, 后端目录`backend/web`，开启urlRewrite

## 使用说明
1. 在前端站点注册一个账号，邮箱使用配置的管理员邮箱
2. 从后端登录，管理日志
