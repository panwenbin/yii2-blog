## 安装说明
1. 因为是Yii2项目，PHP要求5.4以上，具体见 [Yii2 Requirements](http://www.yiiframework.com/doc-2.0/guide-intro-yii.html#requirements-and-prerequisites)
2. 在项目根目录执行安装 `composer install --no-dev`
3. 配置数据库 在`common/config/main-local.php`
4. 在项目根目录运行数据库迁移 `php yii migrate`
5. 配置管理员邮箱 在`common/config/params-local.php`
6. 配置Web Server, 前端目录`frontend/web`, 后端目录`backend/web`，开启urlRewrite

## 使用说明
1. 在前端站点注册一个账号，邮箱使用配置的管理员邮箱
2. 从后端登录，管理日志
