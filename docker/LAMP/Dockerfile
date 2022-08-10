FROM s1riu5/lamp:7.2
COPY www.sql /docker-entrypoint-initdb.d/
COPY www/ /var/www/html
RUN chmod -R 777 /var/www/html