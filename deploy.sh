##############################################################
# This file shall copy current folder files to /var/www/html
# Used during developing and production time. Needs super user
# priviledges to work properly
##############################################################

#!/bin/bash

if(sudo cp -r * /var/www/html/)then

	sudo chown -R www-data /var/www/html/*
	echo "# CAMS files copied to /var/www/html/"
	echo "# Reloading lighttpd ..."
	sudo service lighttpd stop && sudo service lighttpd start

else
	echo "# CAMS ERROR: could not copy CAMS files to /var/www/html/"
fi


