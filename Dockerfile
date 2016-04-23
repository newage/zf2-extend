FROM ubuntu:14.04
ENV DEBIAN_FRONTEND noninteractive
# locale add
RUN locale-gen ru_RU.UTF-8 && dpkg-reconfigure locales

# packeges and repo add
RUN apt-get install -y software-properties-common
RUN add-apt-repository -y ppa:ondrej/php5-5.6
RUN apt-get update -y
RUN apt-get install -y --force-yes supervisor git mc apache2 libapache2-mod-php5 mysql-server php5-mysql php5-intl php5-json php5-curl php5-gd && \
    echo "ServerName zf2-extend" >> /etc/apache2/apache2.conf

# Add image configuration and scripts
ADD docker/start-apache2.sh /start-apache2.sh
ADD docker/start-mysqld.sh /start-mysqld.sh
ADD docker/run.sh /run.sh
RUN chmod 755 /*.sh
ADD docker/my.cnf /etc/mysql/conf.d/my.cnf
ADD docker/supervisord-apache2.conf /etc/supervisor/conf.d/supervisord-apache2.conf
ADD docker/supervisord-mysqld.conf /etc/supervisor/conf.d/supervisord-mysqld.conf

# config to enable virtualhost
ADD docker/apache_default /etc/apache2/sites-available/000-default.conf
# apache2 rewrite module enable
RUN a2enmod rewrite

# the mysql user add
RUN /usr/sbin/mysqld & \
    sleep 5s &&\
    echo "GRANT ALL ON *.* TO admin@'%' IDENTIFIED BY '123456' WITH GRANT OPTION; FLUSH PRIVILEGES" | mysql

RUN /usr/sbin/mysqld & \
    sleep 5s &&\
    echo "CREATE DATABASE zf2extend;" | mysql;

# directory join
VOLUME ["/var/www", "/etc/mysql", "/var/lib/mysql"]
# ports join
EXPOSE 80 3306
CMD ["/run.sh"]