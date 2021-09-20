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
##if(sudo mysqladmin create "CAMSDB") then
##  echo "# CAMS Default database created 'CAMSDB'"
##fi

# Copy needed files on correspondant sytem folder
if(sudo ./deploy.sh install) then
  # Remind user how to fix some issue if it appears after CAMS deploy
 tput setaf 2; echo "# CAMS has been configured and deployed!!"
 tput setaf 4; echo "| There are a few steps to end installation"
 tput setaf 4; echo "| 1- Create a MySQL user (Do not use root as CAMS Database user!!)"
 tput setaf 4; echo "|    Use CLI/Host UI or MySQL GUI to do this, whatever you prefer e.g"
 tput setaf 4; echo "|    > CREATE USER 'cams'@'localhost' IDENTIFIED BY 'password';"
 tput setaf 4; echo "| 2- Grant priviledges to recently created user. to the entire DATABASE"
 tput setaf 4; echo "|    Or create CAMS DDBB and grant priviledges just on it e.g"
 tput setaf 4; echo "|    > CREATE DATABASE cams;"
 tput setaf 4; echo "|    > GRANT ALL PRIVILEGES ON cams.* TO 'cams'@localhost IDENTIFIED BY 'password';"
 tput setaf 4; echo "| 3- Go to http://localhost/install configure your website and deploy"
 tput setaf 4; echo "|    MariaDB (or MySQL) Database structure. It will generate a Admin user and some"
 tput setaf 4; echo "|    sample content"
 tput setaf 2; echo "# If you found some issue, please reboot your PC and try again. You can"
 tput setaf 2; echo "# report the Issue directly to GitHub repository:"
 tput setaf 2; echo "# with next link https://github.com/Carlosmape/CAMS/issues"

fi

# Remove configure file on production folder
sudo rm /var/www/html/configure.sh
