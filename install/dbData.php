<?php 
function CreateDefAdminUser($connection){
	return mysqli_query($connection,
"INSERT INTO USERS (`USER`,`MAIL`,`PASSWORD`, `TYPE`)
VALUES ('admin','example@mail.com','e3afed0047b08059d0fada10f400c1e5','0');");
}

function CreateSampleArticle($connection){
	return mysqli_query($connection,
"INSERT INTO ARTICLES (`TITLE`, `TYPE`, `CATEGORIES`, `DATE`, `CONTENT`, `IMAGEHEADER`)
VALUES ('Lorem ipsum dolor','1','0','".date("Y-m-d")."','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.','http://www.highreshdwallpapers.com/wp-content/uploads/2012/10/Lorem-Ipsum-Wallpaper.jpg');");
}
?>
