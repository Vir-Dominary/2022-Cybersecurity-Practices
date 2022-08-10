

### 个人实验任务

- 使用`Docker`配置安装`php+mysql+Nginx`基础实验环境。

- 编写`Docker`测试参考文档，帮助小组成员安装基础环境。

###  个人工作简介

- 我的主要任务是基础的`lnmp`环境的配置
  - 通过学习`Docker`的相关知识，学会了`Dockerfile`的基本语法，编写`Dockerfile`来配置基础的实验环境。
  - 学习使用`docker-compose`来创建和启动基础的`lnmp`实验环境，编写了`docker-compose.yml`。
  - 编写[docker参考文档](https://github.com/Vir-Dominary/2022-Cybersecurity-Practices/blob/docker-byzfd/docker%20%E7%A4%BA%E4%BE%8B%E5%8F%82%E8%80%83%E6%96%87%E6%A1%A3.md),同时帮助小组成员安装好基础环境。


### 编写的源码

- **Dockerfile** 

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

  

- **docker-compose.yml**

```
version: "3"

services:
    nginx:    
     build: ./www/nginx
     container_name: nginx-container  
     ports: 
      - "80:80"   
     volumes:
      - ./www/nginx:/var/www/html
      
    mysql:    
     build: ./www/mysql
     container_name: mysql-container  
     volumes:  
      - ./www/mysql/data:/var/lib/mysql
      - ./www/mysql/init:/docker-entrypoint-initdb.d/
     ports: 
      - "3306:3306"
     environment:  
      MYSQL_ROOT_PASSWORD: 123456  
      MYSQL_USER: root1
      MYSQL_PASSWORD: 123456
      MYSQL_DATABASE: www
      
    php:    
     build: ./www/nginx/php/
     container_name: php-container  
     ports:
      - "9000:9000"  
     #links:  
     # - mysql  
     volumes:  
      - ./www/nginx/php/php.ini:/usr/local/etc/php.ini
      - ./www/nginx/php:/usr/share/nginx/html
      - ./www/nginx/php:/etc/php
```

### 遇到的问题

- `Nginx`配置文件目录出错，`php`文件无法正常使用。

### 参考资料

- [docker-compose简介](https://www.runoob.com/docker/docker-compose.html)

- [docker教程](https://www.bilibili.com/video/BV1uS4y1J7hm?spm_id_from=333.999.0.0)
- [docker配置lnmp环境](https://blog.csdn.net/robin_cai/article/details/124121832)
