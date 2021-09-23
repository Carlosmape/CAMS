<?php
/*
 * @AUTHOR Carlos Gregorio Martín Pérez <camape@gmail.com>
 * */
require_once "../includes/class/connection.php";
require_once "../includes/config.php";
require_once "../includes/sqlfunctions.php";
require_once "../includes/class/log.php";

if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
	$_SESSION['connection']->keepalive(); //refresh connection timeout
	$database = new Sqlconnection;//connect to database in order to extract users info
	Log::Add($database, new Exception());
	if (isset($database)){
		$records = $database->getLastLogs(); ?>
		<h1 class="page-header">Log</h1>
			<div class="table-responsive">
				<table class="table table-striped">	
					<thead>
						<tr>
							<th>Level</th>
							<th>Message</th>	
							<th>File</th>
							<th>Line</th>
							<th>Process</th>
							<th>Session value</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php while($row = mysqli_fetch_array($records)) { ?>
						<tr>
							<td id="rowLevel<?php echo $row['ID'];?>"><?php echo $row['LEVEL'];?></td>
							<td id="rowMessage<?php echo $row['ID'];?>"><?php echo $row['MESSAGE'];?></td>
							<td id="rowFile<?php echo $row['ID'];?>"><?php echo $row['FILE'];?></td>
							<td id="rowLine<?php echo $row['ID'];?>"><?php echo $row['LINE'];?></td>
							<td id="rowProcess<?php echo $row['ID'];?>"><?php echo $row['PROCESS'];?></td>
							<td id="rowSessionValue<?php echo $row['ID'];?>"><?php echo $row['SESSION_VALUE'];?></td>
							<td id="rowDate<?php echo $row['ID'];?>"><?php echo $row['DATE'];?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div id="pager"></div>
			</div>
<?php }else{
echo "Error CAMS could not connect to your DATABASE";
		}
}
?>
