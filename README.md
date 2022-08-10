# 即刻传图——信息安全综合实践

基于php的文件上传网站，存在文件上传漏洞

## 功能清单

|功能|简介|
|--|--|
|**身份认证系统**|用户名具有唯一性；使用密码和二级密码；限制登录的尝试次数|
|**密码保存系统**|二级密码（密码保护）存在多个选项，避免由密保问题带来的隐患；一级密码使用散列（hash）后储存， 提高安全性|
|**文件上传系统**|上传文件，可设定其可访问性；文件会在上传后会验证其文件类型；所有的输入都需要检验和修改，杜绝注入漏洞|

## 项目使用的关键技术

 + 基于<font size=3 color=yellow>php、nginx与mysql</font>搭建网站（BuiltIt），通过<font size=3 color=yellow>渗透测试</font>，找到网站存在的漏洞，并针对漏洞做出加固（FixIt）。去掉网站后端的<font size=3 color=yellow>白名单机制</font>，留下文件上传漏洞的缺口，模拟攻击过程并记录（BreakIt）；

 + 对用户的密码进行<font size=3 color=yellow>散列（hash）</font>后再储存，提高安全性；

 + <font color=red>拟实现和使用，但没能成功的技术：</font>~~利用docker完成环境的一键部署~~


## 快速上手体验

  非常遗憾，我们计划使用的docker部署最终以失败告终。我们先后尝试了四种不同的构建方式，但都因为各种各样的原因而存在缺陷。

  尽管不能成功复现web，我们仍然为这四种配置方式补充了docker-compose.yml，以期未来的某一天能弥补当时的遗憾。

  失去了docker环境的助力，我们选择了非官方的平台构建web网站。我们选择了'phpstudy'这一辅助工具进行搭建。若想复现这一应用环境，搜索并下载'phpstudy'即可。

## 演示

演示视频上传至aliyun，链接如下
[https://www.aliyundrive.com/s/28zb3HpY6TU](https://www.aliyundrive.com/s/28zb3HpY6TU)