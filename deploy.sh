##############################################################
# This file shall copy current folder files to /var/www/html
# Used during developing and production time. Needs super user
# priviledges to work properly
##############################################################

#!/bin/bash

if(sudo cp -r * /var/www/html/)then
	echo "# CAMS files copied to /var/www/html/"
fi
if(sudo service lighttpd stop && sudo service lighttpd start) then
	sudo chown -R www-data /var/www/html/*
fi

