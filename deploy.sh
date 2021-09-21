##############################################################
# This file shall copy current folder files to /var/www/html
# Used during developing and production time. Needs super user
# priviledges to work properly
##############################################################

#!/bin/bash

# Defines
deploymentFolder="/var/www/html"
filesCopied=false

# Check if parameter "install" is passed then copy all files
# if not, deploy all files less /install directory
tput setaf 2; echo "# CAMS copying files necessary files into system"
if [ $# -ge 1 ] && [ "$1" != "install" ]; then
	
	tput setaf 4; echo "This is a script to deploy CAMS into your system."
	tput setaf 4; echo "Use 'install' param to deploy installation script too. (Site configuration will be override)."
	exit 1;

# Deploy process depending on options
elif [ "$1" = "install" ]; then
	filesCopied=$(sudo rsync -av -P . $deploymentFolder)
else
	filesCopied=$(sudo rsync -av -P . $deploymentFolder --exclude /install --exclude /cams/includes/config.php)
fi

# Shows results to user and do last steps
if [ "$filesCopied" != false ]; then

	tput setaf 2; echo "# CAMS files copied to $deploymentFolder"
	sudo chown -R www-data $deploymentFolder*
	#tput setaf 2; echo "# Reloading lighttpd ..."
	#sudo service lighttpd stop && sudo service lighttpd start
	tput setaf 2; echo "# CAMS Properly deployed! "
	exit 0

else

	tput setaf 1; echo "# CAMS ERROR: could not copy CAMS files to $deploymentFolder"
	exit 1

fi
