<?php
/*
 * @AUTOR Carlos Gregorio Martín Pérez
 * */
require_once "../includes/connection.php";
require_once "../includes/config.php";
require_once "../includes/sqlfunctions.php";
 
	if (isset($_SESSION['connection']) && !$_SESSION['connection']->timeout() && $_SESSION['connection']->isAdmin()) { //if you are connected
		$_SESSION['connection']->keepalive(); //refresh connection timeout
		$database = new Sqlconnection;//connect to database in order to extract users info
		if (isset($database)){
			$records = $database->getAllRecords();
			//will show records info
			//first open table head and body putting as columns as you need
			echo '<h1 class="page-header">Log</h1>
			<div class="table-responsive">
				<table class="table table-striped">	
					<thead>
						<tr>
							<th>Autor</th>
							<th>Action</th>
							<th>Context</th>
							<th>Reciber</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>';
						while($row = mysqli_fetch_array($records)) { ?>
							<tr>
								<td id="rowAutor<?php echo $row['ID'];?>"><?php echo $row['AUTOR'];?></td>
								<td id="rowAction<?php echo $row['ID'];?>"><?php echo $row['ACTION'];?></td>
								<td id="rowContext<?php echo $row['ID'];?>"><?php echo $row['RECIBERCONTEXT'];?></td>
								<td id="rowReciber<?php echo $row['ID'];?>"><?php echo $row['RECIBER'];?></td>
								<td id="rowDate<?php echo $row['ID'];?>"><?php echo $row['DATE'];?></td>
							</tr>
						<?php }
						echo '
					</tbody>
				</table>
				<div id="pager"></div>
			</div>';
		}else{
		  echo "Error CAMS could not connect to your DATABASE";
		}
	}
?>
