#!/bin/sh
ln -s /vagrant/RandomFruit/public /var/www/RandomFruit
chmod -R a+rx /vagrant/RandomFruit
chmod -R a+rx /var/www/RandomFruit
cd /vagrant/RandomFruit
sh recompile.sh
cd -
