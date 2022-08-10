### 需要准备的环境

- [Docker](https://docs.docker.com/get-docker/)

- kali Linux

  #### 镜像中安装的环境

* nginx 1.9.2
* mysql 5.7
* php 7.4
* compose 2.0

### 安装操作

```shell
$ git clone https://github.com/Vir-Dominary/2022-Cybersecurity-Practices.git
$ cd 2022-Cybersecurity-Practices
$ docker-compose up -d

Starting 2022-cybersecurity-practices_mysql_1 ... done
Starting 2022-cybersecurity-practices_php_1   ... done
Creating composer                             ... done
Starting 2022-cybersecurity-practices_nginx_1 ... done


```

### 测试

```shell
#测试
$ docker ps 
CONTAINER ID   IMAGE                              COMMAND                  CREATED          STATUS          PORTS                                                                      NAMES
97764cc07cd5   nginx:1.19.2-alpine                "/docker-entrypoint.…"   13 minutes ago   Up 55 seconds   0.0.0.0:80->80/tcp, :::80->80/tcp, 0.0.0.0:443->443/tcp, :::443->443/tcp   2022-cybersecurity-practices_nginx_1
3b6e868c375c   mysql:5.7                          "docker-entrypoint.s…"   14 minutes ago   Up 56 seconds   0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp                       2022-cybersecurity-practices_mysql_1
b9aed84693e1   2022-cybersecurity-practices_php   "docker-php-entrypoi…"   14 minutes ago   Up 56 seconds   0.0.0.0:9000->9000/tcp, :::9000->9000/tcp                                  2022-cybersecurity-practices_php_1
#注：mysql默认用户名 root的密码为 root，同时添加用户名 user，密码为 user123456。
#测试是否可以正常连接 nginx 容器：
$ curl 127.0.0.1
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <title>即刻传图</title>
        <link rel="stylesheet" type="text/css" href="source/css/firefox/index.css"> <!--此链接留用css-->
    </head>
    <body>
        <div id="login_head">
            <p  id="login_title">欢迎来到即刻传图！</p>
        </div>    
            <div class="login">
                <div id="login_left">
                    <p style="margin-top:200px;margin-right:0;" class="form_text">分享身边美逝</p>
                </div>
                <div id="login_right">
                    <h1 class="form_title">请登录</h1> <!--登录、注册-->
                    <form action="php/login_check.php" method="post" id="login_form">
                        <p class="form_text">用户名</p> 
                        <input type="text" name="username" class="form_input" placeholder="请输入用户名"><br>
                        <p class="form_text">密码</p>
                        <input type="password" class="form_input" name="password" placeholder="********"><br>
                        <div id="button">
                            <button class="button_primary" type="submit">登录</button>
                        </div>
                        <div id="register_link">
                            <p>没有账号？<a href="register.html">注册新账号</a></p>
                            <a href="reset.html">忘记密码？</a>
                        </div>
                        
                    </form>
                </div>
            </div>
    </body>
</html>
```

### Dockerfile

```dockerfile
FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        zlib1g-dev libzip-dev \ 
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libmemcached-dev \
        zlib1g-dev \
        libcurl4-openssl-dev \
        libxml2-dev \
        --no-install-recommends && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install -j$(nproc) \
        gettext mysqli pdo_mysql zip \
        bcmath opcache sockets soap \
    && docker-php-ext-configure gd  --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

CMD ["php-fpm", "-F"]

```



