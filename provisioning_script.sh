#!/bin/bash

apt-get update

echo 'mysql-server mysql-server/root_password password root' | debconf-set-selections 
echo 'mysql-server mysql-server/root_password_again password root'| debconf-set-selections 

apt-get -y install php5 mysql-client mysql-server apache2 libapache2-mod-php5  php5-mcrypt git

chown -R vagrant:vagrant /var/www
chmod -R a+X /var/www

echo 'User vagrant' >>/etc/apache2/httpd.conf
echo 'Group vagrant' >>/etc/apache2/httpd.conf
echo 'Listen 8888' >>/etc/apache2/httpd.conf
sed -i 's/www-data/vagrant/' /etc/apache2/envvars

#Install composer
OLDPATH=`pwd`
cd /usr/bin
wget https://getcomposer.org/installer -O composer-installer
php composer-installer
rm composer-installer
mv composer.phar composer
chmod a+x composer
cd $OLDPATH



chmod -R 664 /var/www

ln -s /vagrant/RandomFruit/public /var/www/RandomFruit
chmod -R a+rX /vagrant/RandomFruit
chmod -R a+rX /var/www
cd /vagrant/RandomFruit
composer dump-autoload
compsoser install
chmod 777 app/storage
cd -

rm -rf /var/lock/apache2
service apache2 restart
