##############################################################
# This file shall copy current folder files to /var/www/html
# Used during developing and production time. Needs super user
# priviledges to work properly
##############################################################

#!/bin/bash

# Defines
deploymentFolder="/var/www/html"
filesCopied=false

CopyAndChangeOwn () {
	return $(sudo rsync -av -P . $deploymentFolder &&
	sudo chown -R www-data $deploymentFolder*)
}


# Check if parameter "install" is passed then copy all files
# if not, deploy all files less /install directory
echo "# CAMS copying files necessary files into system"
if [ "$1" = "install" ]; then
	filesCopied=$( CopyAndChangeOwn )
	echo "# Reloading lighttpd ..."
	sudo service lighttpd stop && sudo service lighttpd start
else
	filesCopied=$(sudo rsync -av -P . $deploymentFolder --exclude /install)
fi

# Shows user message
if [ "$filesCopied" != false ]; then
	echo "# CAMS files copied to $deploymentFolder"
else
	echo "# CAMS ERROR: could not copy CAMS files to $deploymentFolder"
fi
