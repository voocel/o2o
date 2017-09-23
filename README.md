# o2o多商家商城

## 主要功能
1. 主后台登录，商户后台登录
2. 主后台注册，商户后台注册
3. 商家入驻管理
4. 门店管理
5. 广告推荐位管理
6. 团购商品管理
7. 商品无限分类管理
8. 商品详情
9. 邮件通知功能

## 主要目录结构
```
application
extend
public
runtime
thinkphp
vendor
build.php
composer.json
think
```
## 安装步骤
```
git clone https://github.com/voocel/o2o.git
cd o2o
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
```

## 访问
>http://127.0.0.1  (首页)

>http://127.0.0.1/admin  (主后台)

>http://127.0.0.1/bis  (商户后台)