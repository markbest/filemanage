# laravel_manage
基于laravel 5.3开发的轻量级的文件管理系统（还在完善当中）

# 系统组件
- [hieu-le/active](https://github.com/letrunghieu/active)
- [dingo/api](https://github.com/dingo/api)
- [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)

# 系统特色
- 简单的图片管理、相册管理
- 简单的文件管理、文件夹管理
- 图片和文件的批量上传
- 可以使用API接口远程管理文件

# 安装使用
- 从[github](https://github.com/markbest/laravel_manage)上下载源代码
- 执行composer install
- 配置env数据库信息
- 安装数据库：php artisan migrate

# Demo
- http://manage.mark-here.com/  admin@admin.com  123456

# API调用
- 获取$token  :  authenticate
- 获取相册列表 : api/albumsList?token=$token
- 获取相册详情 : api/albumInfo/id?token=$token
- 获取图片列表 : api/picturesList?token=$token
- 获取图片详情 : api/pictureInfo/id?token=$token
- 获取文件夹列表 : api/foldersList?token=$token
- 获取文件夹详情 : api/folderInfo/id?token=$token
- 获取文件列表 : api/filesList?token=$token
- 获取文件详情 : api/fileInfo/id?token=$token