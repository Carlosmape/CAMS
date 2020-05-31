#!/bin/bash

# Install some dependencies
sudo apt install mysql-server
sudo apt install lighttpd
sudo apt install php
sudo apt install php-cgi
sudo apt install libmysqlclient
# Adding php support
sudo lighty-enable-mod fastcgi 
sudo lighty-enable-mod fastcgi-php
sudo chmod 755 /var/log/lighttpd
sudo chown www-data:www-data /var/log/lighttpd
# Clear upper console output. FIXME: Is it really good idea??
# clear

# Creating DataBase stuff
# TODO: move lines to correspondant .sh script
if(sudo mysqladmin create "CAMSDB") then
  echo "# CAMS Default database created 'CAMSDB'"
fi

# Copy needed files on correspondant sytem folder
if(sudo ./deploy.sh) then
  # Remind user how to fix some issue if it appears after CAMS deploy
  echo "# CAMS has been configured!!"
  echo "| There are a few steps to end installation"
  echo "| 1- Create a MySQL user (Do not use root as CAMS Database user!!)"
  echo "|    Use CLI/Host UI or MySQL GUI to do this, whatever you prefer e.g"
  echo "|    CREATE USER 'camsadmin'@'localhost' IDENTIFIED BY 'password';
  echo "| 2- Go to http://localhost/install configure your website and deploy"
  echo "|    MySQL Database structure"
  echo "# If you found some issue, please reboot your PC and try again. You can"
  echo "# report the Issue directly to GitHub repository:"
  echo "# with next link https://github.com/Carlosmape/CAMS/issues"

fi


# Remove configure file on production folder
sudo rm /var/www/html/configure.sh
