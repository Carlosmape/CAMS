#!/bin/bash
sudo apt-get install mysql-server*
sudo apt-get install lighttpd
#adding php support
sudo lighty-enable-mod fastcgi 
sudo lighty-enable-mod fastcgi-php
clear
if(sudo cp -r * /var/www/html/)then
	echo "#CAMS copied to /var/www/html/"
fi
if(sudo service lighttpd force-reload)then
	sudo chown -R www-data /var/www/html/*
	echo "#CAMS has been configured!. Go to http://yoursite.com/install to do final step"
fi
sudo rm /var/www/html/configure.sh
