# 2022年信息安全综合时间小组作业仓库

## 题目信息：

* 题目名称： File Upload
* 预估难度： 简单

## 题目描述：

```
注册自己的账号后，通过上传木马文件找到flag
```

## 题目考点：

```
1. 木马上传
2. 修改上传路径
```

## 思路简述：

## 题目环境：

```
docker：
    <1>. nginx 1.9.2
    <2>. mysql 5.7
```

## 题目制作过程：

1. 搭建并加固自己搭建的网站
2. 选定所要利用的漏洞——文件上传漏洞
3. 根据文件上传漏洞的需要，取消保护网站的白名单机制
4. 将网站封装至docker，一遍部署和使用

## 题目writeup：

详见[WriteUp.md](BreakIt/WriteUp.md)

## 小组分工

* padresvater——BreakIt&FixIt&修复部分开发bug——个人技术总结详见[padresvater的总结技术报告](./技术总结合集/padresvater/padresvater.md)

