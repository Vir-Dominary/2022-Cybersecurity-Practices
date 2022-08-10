FROM httpd:lasted
RUN apt update
RUN apt install -y apache2 && apt install -y apache2-utils
RUN apt clean
COPY ../php /usr/src/myapp
EXPOSE 80 CMD ["apache2ctl","-D","FOREGROUND"]