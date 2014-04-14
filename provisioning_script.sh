#!/bin/bash

apt-get update

## Set default values for mysql/phpmyadmin install. Otherwise, the installer boots a GUI.

echo 'mysql-server mysql-server/root_password password root' | debconf-set-selections 
echo 'mysql-server mysql-server/root_password_again password root'| debconf-set-selections
echo 'phpmyadmin phpmyadmin/dbconfig-install boolean true' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/app-password-confirm password Durian' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/admin-pass password root' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/app-pass password Durian' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections 

## Install the dependencies

apt-get -y install php5 mysql-client mysql-server apache2 libapache2-mod-php5  php5-mcrypt git phpmyadmin

## vagrant user needs to own the web directory
chown -R vagrant:vagrant /var/www

## Let's everyone access the web directory
chmod -R a+X /var/www

## Define the apache user and group. Set default port to 8888
echo 'User vagrant' >>/etc/apache2/httpd.conf
echo 'Group vagrant' >>/etc/apache2/httpd.conf
echo 'Listen 8888' >>/etc/apache2/httpd.conf

## Change the main apache user in the envvars config to vagrant
sed -i 's/www-data/vagrant/' /etc/apache2/envvars

#Install composer
OLDPATH=`pwd`
cd /usr/bin

### Download the composer installer
wget https://getcomposer.org/installer -O composer-installer

### Run installer
php composer-installer

### delete installer
rm composer-installer

### Rename composer command  
mv composer.phar composer

### Make it executable
chmod a+x composer
cd $OLDPATH

# More permissions nonsense
chmod -R 664 /var/www

## Create a shortcut in the /var/www directory to the RandomFruit public folder
ln -s /vagrant/RandomFruit/public /var/www/RandomFruit
chmod -R a+rX /vagrant/RandomFruit
chmod -R a+rX /var/www

## Compile the RF project
cd /vagrant/RandomFruit
composer dump-autoload
composer install
chmod 777 app/storage
cd -

# some phpmyadmin stuff
echo '#Include phpmyadmin config' >>/etc/apache2/apache2.conf
echo 'Include /etc/phpmyadmin/apache.conf' >>/etc/apache2/apache2.conf

# Set AllowOverride to All in apache config to allow url rewriting
sudo perl -i -pe 's/(\s*?AllowOverride\s*?)None/$1All/g' /etc/apache2/sites-available/default
sudo a2enmod rewrite
rm -rf /var/lock/apache2
service apache2 restart

## Database setup
mysql -u root --password='root' -e 'CREATE DATABASE RandomFruit;'
mysql -u root --password='root' -e 'CREATE DATABASE RandomFruitTest;'
mysql -u root --password='root' -e "CREATE USER 'RandomFruit'@'localhost' IDENTIFIED BY 'Durian'; flush privileges;"
mysql -u root --password='root' -e "GRANT ALL PRIVILEGES ON *.* TO 'RandomFruit'@'localhost'; flush privileges;"

# Create symbolic link to directory in home folder for easy access
ln -s /vagrant/RandomFruit /home/vagrant/RandomFruit
chown /vagrant /home/vagrant/RandomFruit 
chmod a+rX /home/vagrant/RandomFruit

# Set up the tables and seed them.
cd /vagrant/RandomFruit
php artisan migrate:reset
php artisan migrate
php artisan db:seed
composer -vvv update
