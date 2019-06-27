<?
require('lib/configuration.lib');
require('lib/core.lib');


	session_start();

	get_param($param);

	// データベース接続
	$dbcon = database_connect();


	// ---------------
	// データ取得
	// ---------------

	$num_of_holiday = get_holiday($holiday);
	$HOLIDAY = array();
	for($i=0; $i<$num_of_holiday; $i++) {
		$HOLIDAY += array($holiday[$i]['holiday_day'] => $holiday[$i]['holiday_name']);
	}
  

	// ---------------
	// 画面表示
	// ---------------

	header('Content-Type: text/html; charset=utf-8');
	include('temp/calendar_confirm.html');

	database_close();
	exit;
?>
