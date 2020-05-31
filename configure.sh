#!/bin/bash

# Install some dependencies
sudo apt install mysql-server
sudo apt install lighttpd
sudo apt install php
sudo apt install php-cgi
# Adding php support
sudo lighty-enable-mod fastcgi 
sudo lighty-enable-mod fastcgi-php
sudo chmod 755 /var/log/lighttpd
sudo chown www-data:www-data /var/log/lighttpd
# Clear upper console output. FIXME: Is it really good idea??
# clear

# Copy needed files on correspondant sytem folder
if(sudo ./deploy.sh) then
  echo "#CAMS has been configured!. Go to http://yoursite.com/install to do final step"
fi

# Remove configure file on production folder
sudo rm /var/www/html/configure.sh
