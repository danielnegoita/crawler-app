FROM httpd:2.4

ENV APACHE_ROOT_DIR /usr/local/apache2

COPY ./apache/httpd-vhosts.conf ${APACHE_ROOT_DIR}/conf/extra/httpd-vhosts.conf
COPY ./apache/httpd.conf ${APACHE_ROOT_DIR}/conf/httpd.conf