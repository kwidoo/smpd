<?php

// composer dependencies
require_once 'vendor/autoload.php';
// configuration
$config = require('config.php');

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

define('SCOPES', implode(' ', array(Google_Service_Sheets::SPREADSHEETS)));
date_default_timezone_set('Europe/Riga');
$client = new Google_Client();
$client->setApplicationName('Spreadsheet');
$client->setClientId($config['client_id']);
$client->setAuthConfig($config['key_file_path']);
$client->setScopes(SCOPES);
$service = new Google_Service_Sheets($client);

// editable part
$fileId = $config['fileId'];

$lang = 'lat';
$range = $config['categories'];
$response = $service->spreadsheets_values->get($fileId, $range);
?>
<html>
<style>
.ol_price_pos{
	display: block;
}
.ol-strip0 {
	background-color: #e5efd6;
}
.ol_title_row {
	float: left;
	display : block;
	width: 100%;
	line-height: 24px;
	background-color: #63A830;
	border: 2px solid #63A830;
	font-size: 20px;
	text-align: center;
}
.ol_title_row p {
	padding: 0 0 0 0;
	margin:0;
	color: white;
}
.ol_single_row_name {
	display: inline-block; 
	float: left; 
	width:80%; 
	border-top: none;
}
.ol_single_row_name p {
	padding-left: 20px;
	margin:0;

}
.ol_single_row_price {
	display: inline-block; 
	float:left; 
	width:20%; 
	border-left: none;
	border-top: none;
	text-align: center;
	font-size: 1.2rem;
}
.ol_button_p, .ol_button_p a {
	height : 40px;
	line-height: 40px;
	margin-bottom : 10px;
	background-color: #63A830;
	border-radius: 10px 10px;
	color : white;
	text-decoration: none;
	font-size: 20px;
}
.ol_button_p:hover{
	cursor: pointer;
}
</style>
<body>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
<?php
	
$r = round(sizeof($response->values)/2,0,PHP_ROUND_HALF_ODD);
for ($i=1; $i< sizeof($response->values);$i++){
		if ($i == 1 || $i == $r) {
		?>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding: 0 10px 0 0; text-align: center;">
		<?php } ?>
			<div id="ol-<?php echo $i; ?>" class="ol_button_p">
		<?php
			if ($lang == 'rus') echo $response->values[$i][1];
			if ($lang == 'lat') echo $response->values[$i][2];
		?></div>
		<?php
		if ($i == $r-1 || $i == sizeof($response->values)) {
		?>
		</div>
		<?php } 
	   
}


// create array of categories 
for ($i=1;$i < sizeof($response->values);$i++){
	$categories[] = $response->values[$i][0];
}
?>
</div>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="padding: 0;">
<?php
	
// read 
for ($k=0;$k < sizeof($categories);$k++){
//for ($k=0;$k < 4;$k++){
	$range = $categories[$k].'!'.$config['values'];   
	$response = $service->spreadsheets_values->get($fileId, $range);

// здесь надо проверять order
	?>
	<div id="ol-<?php echo $k+1; ?>-1" class="ol_price_pos">
	<?php
	for ($i=1;$i < sizeof($response->values);$i++){
		// print category here
		if ($response->values[$i][0] == 'elemCat'){
			?><div class="ol_title_row"><p><?php
			if ($lang == 'rus') echo $response->values[$i][3];
			if ($lang == 'lat') echo $response->values[$i][4];
			?></p></div><?php
		}
		// print price pos here
		if ($response->values[$i][0] == 'elemPrice'){
			?><div class="ol_single_row<?php if ($i % 2 == 0) echo " ol-strip0"; ?>">
				<div id="name_22<?php echo $i; ?>" class="ol_single_row_name"><p><?php
			if ($lang == 'rus') echo $response->values[$i][3];
			if ($lang == 'lat') echo $response->values[$i][4];
			?>
				</p>
				</div> 	
				<div id="price_22<?php echo $i; ?>" class="ol_single_row_price"><strong><?php
				if ($response->values[$i][5] > 0) echo '€ '.$response->values[$i][5];
				else {
					if ($lang == 'rus') {
						$from = 'от '; $to = 'до ';
					}
					if ($lang == 'lat') {
						$from = 'no '; $to = 'līdz ';
					}
					if ($response->values[$i][6] > 0) echo $from.'€ '.$response->values[$i][6].' ';
					if ($response->values[$i][7] > 0) echo $to.'€ '.$response->values[$i][7];
				}
				?>
					</strong>
					</div>
				</div>
		<?php
		}
	}
	?>	</div>
	<?php
}
?>
</div>
</body>
</html>
<?php
