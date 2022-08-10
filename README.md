# 信息安全综合实践

## 个人贡献

1. FixIt：对网站进行渗透测试，找出漏洞并对漏洞加固

2. Docker部署：对网站进行封装，快速搭建环境

3. 编写小组的Readme文档

## 工作细节

### 一. 寻找、修复漏洞

更多细节请访问：[漏洞的发现与加固](penetration%20test/README.md)

渗透测试的主要对象是[OWASP Top Ten](https://www.aliyundrive.com/s/28zb3HpY6TU)网站所罗列的十大常见漏洞。
检测使用黑盒、白盒两种测试方式，以求测试的准确性。

对十大漏洞先后进行了三次测试和修复：

 + 漏洞检测

    - 7月22日的检测结果为，存在以下漏洞：
      ![7.22](penetration%20test\img\7.22%E6%BC%8F%E6%B4%9E.jpg)

    - 8月4日的检测结果为，存在以下漏洞：
   ![8.4](penetration%20test\img\8.4%E6%BC%8F%E6%B4%9E.jpg)

    - 8月8日的检测结果为，存在以下漏洞
   ![8.8](penetration%20test\img\8.8%E6%BC%8F%E6%B4%9E.jpg)

 + 漏洞修复

   累计修复了5个高危漏洞

    - 加密失败

      存在问题：用户密码的保存机制单薄，安全性低

      修复方法：将密码哈希加密后储存
    
    - sql注入漏洞

      存在问题: 在各php文件的源码中都能看到，username、password等字段未经处理就输入到后端。而用户的输入往往是不安全的

      修复方法：对所有的输入字段进行过滤，加上mysql_real_escape_string()这一函数，消除转义等可能引起风险的输入。
    
    - 设计逻辑上的漏洞

      存在问题： 初版网站在记录用户的二级密码/密码保护所用的问题是：‘你喜爱的演员是’。由于“演员”职业的特殊性，这个问题的答案范围小，往往就是部分备受关注的明显，因此存在攻击者利用的空间

      修复方法：将二级密码问题增加到三个，一定程度上降低被攻击的发现

    - 配置项的漏洞

      存在问题：默认账户（admin）未修改，服务器未禁用目录列表，服务器允许返回详细的报错信息。

      修复方法：在服务区端修改管理员账户，并禁用目录和返回报错

    - 身份验证失效
      
      存在问题： 缺少多因素身份认证；登录错误后可再次尝试，且没有次数限制，存在被爆破的可能；在 URL 中公开会话标识符

      修复方式： 限制登录尝试次数，禁用了标识符的显示

 + 补充说明

    实际上，即使到了最后时刻，也仍然存在着一些未修复漏洞，以下是不作修复的原因：
    
    - 文件上传
    
      该漏洞是BreakIt的突破口，因此不作修复，并删除白名单功能，防止漏洞无法利用

    - 无保障机制
      
      网站没有检测与监控措施，也没有远程日志或者警报。在被攻击时不能实时防御。

      但我们认为，在这个网站中，实时监控的功能并非必需。而监控功能的实现又较为复杂，因此未对其进行加固。

    - Server-Side Request Forgery (SSRF)

      网络架构未分段，攻击者可以映射内部网络。

      尽管这是一个高危漏洞，但我们的网站结构过于简单，以至于无法分段或做出其他加固措施。


二、Docker构建

更多细节请访问：[docker](docker/README.md)

先后尝试了三种不同的方法构建Docker环境，遗憾的是都失败了。因此这一部分的大多数内容都可放进<font color= pink>'遇到的问题'</font>这一部分。

## 遇到的问题

一.  连接nginx与mysql时，遇到了mysqli系列函数的调用错误

二.  加固sql注入漏洞时遇到mysqli_real_escape_string()使用错误

三.  nginx、apache等服务器共同存在的系列问题
    
  + 1.php文件不能正常显示

  + 2.mysqli函数读取错误

  + 3.文件位置异常

  + 4.无访问权限

## 解决方法

注：解决方法与问题一一对应

一.  mysqli函数是mysql的更新版本，修复了许多mysql函数可能存在的漏洞。mysql函数中可能保有的函数默认值，许多都在mysqli中取消了。然而部分教程却未对这两个系列函数作区分，因此，mysqli函数使用mysql方法，显然会出现错误。最常见的错误就是函数调用需要的参数，mysqli一般比mysql多一些。在使用时，需要先查明参数再调用

二.  mysqli_real_escape_string()遇到的问题和<font color=yellow>"问题一"</font>是一致的，不再赘述

三.  服务器遇到的问题很多，甚至有一些我至今没能想清楚原因

   + 至今未找到合理的解决方法。我在各大网络论坛上讨教过这个问题，主流的说法是：nginx服务器没有访问对应文件夹的权限、php文件没有挂载到容器的入口处等，但按照解法一一处理，也没能解决问题。因此我没能得到答案

   + mysqli的系列函数读取错误——区分与<font color=yellow>"问题一"</font>，是读取错误而不是调用错误。在一些版本的php中，不支持mysqli函数，需要手动更新并重新配置文件

   + 文件位置异常有可能是conf.d文件中的root配置不正确，导致文件找不到；也可能是文件挂载到容器内的目录有误。

   + 一般我们认为，docker内的访问都是root权限，不应该存在权限问题。但如果nginx.conf（或者是apache2.conf）中给出根（root）的位置并非需要访问的文件夹的父文件夹，就会出现权限不足的报错——尽管它可能并非真正的权限问题