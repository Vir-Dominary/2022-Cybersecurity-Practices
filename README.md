当前存在的问题：php文件会因为目录错误无法显示，正在docker中查找目录，比对文件。

当前只能显示网站里的html文件
在demo里运行
```
docker-compose up -d
```

即可一键配置所需的环境，配置完成后访问127.0.0.1即可进入网站

关闭服务器请输入
```
docker-compose down
```