FROM --platform=linux/x86_64 centos:7

# document_root を設定(project_root以下のパスを設定、先頭に / 無しで)
ENV DOCUMENT_ROOT=public

# httpd install
RUN yum update -y && \
    yum install -y https://repo.ius.io/ius-release-el7.rpm && \
    yum -y install httpd24u

RUN yum install -y vim zip unzip git epel-release && \
    yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
    yum-config-manager --enable remi-php74 && \
    yum update -y && \
    yum install -y php && \
    yum install -y php-gd \
    php-xml \
    php-PDO \
    php-pdo_mysql \
    php-pdo_pgsql \
    php-mbstring \
    php-xdebug \
    php-wddx \
    php-mysqlnd \
    php-zip \
    php-intl \
    php-redis \
    php-ldap


# curl update
RUN rpm -Uvh http://www.city-fan.org/ftp/contrib/yum-repo/rhel7/x86_64/city-fan.org-release-2-2.rhel7.noarch.rpm
RUN yum -y install libcurl libcurl-devel --enablerepo=city-fan.org
#  curl --http2-prior-knowledge  -v localhost  でh2での通信が確認できた。


# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    mv ./composer.phar /usr/local/bin/composer && \
    rm ./composer-setup.php

# install nodejs14
RUN curl -sL https://rpm.nodesource.com/setup_14.x | bash - && \
    yum install -y nodejs && \
    npm -g install yarn


COPY ./apache/httpd.conf /etc/httpd/conf/httpd.conf
COPY ./apache/userdir.conf /etc/httpd/conf.d/userdir.conf
COPY ./apache/http2.conf /etc/httpd/conf.d/http2.conf
COPY ./php/php.ini /etc/php.ini

CMD ["/usr/sbin/httpd","-DFOREGROUND"]
