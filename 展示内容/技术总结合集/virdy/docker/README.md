##### 注：共计三种docker配置方式，其中nginx和apapche已部署好自动配置。LAMP未完成自动部署。

<u>_________________________________________</u>
## ngxin&&apache：

进入对应文件夹后输入
```
sudo docker-compose -d
```
即可一键配置

<u>_________________________________________</u>
## LAMP：

进入文件夹后输入
```
sudo docker build -t demo:v3 .
sudo docker run -d --name test -p 9000:80 demo:v3
sudo docker ps
```