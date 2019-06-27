<?
require('configuration.lib');
require('core.lib');


	session_start();

	get_param($param);

	// データベース接続
	$dbcon = database_connect();


	// ---------------
	// データ保存
	// ---------------

	if($param['save'] == 1){
		$number_of_day = date("t", mktime(0, 0, 0, $param['month'], 1, $param['year']));
		for($i=1; $i<=$number_of_day; $i++){	
			insert_shift($param, $i);
		}
	}

	// ---------------
	// データ取得
	// ---------------

	$n = get_calendar($result);
	$on = array_column($result, 'kintai_on', 'kintai_day');
	$off = array_column($result, 'kintai_off', 'kintai_day');

	$num_of_holiday = get_holiday($holiday);
	$HOLIDAY = array();
	for($i=0; $i<$num_of_holiday; $i++) {
		$HOLIDAY += array($holiday[$i]['holiday_day'] => $holiday[$i]['holiday_name']);
	}

	// ---------------
	// 年と月の判別
	// ---------------

	if (empty($param['month'])) {
		$param['month'] = date("n");
		$param['year'] = date("Y");
	} else {
		if(isset($param['last'])){
			if($param['month']-1 == 0){
				$param['month'] = date("n", mktime(0, 0, 0, 12, 1, $param['year']-1));
				$param['year'] = date("Y", mktime(0, 0, 0, 12, 1, $param['year']-1));
			}else{
				$param['month'] = date("n", mktime(0, 0, 0, $param['month']-1, 1, $param['year']));
			}
		} elseif(isset($param['next'])){
			if($param['month']+1 == 13){
				$param['month'] = date("n", mktime(0, 0, 0, 1, 1, $param['year']+1));
				$param['year'] = date("Y", mktime(0, 0, 0, 1, 1, $param['year']+1));
			}else{
				$param['month'] = date("n", mktime(0, 0, 0, $param['month']+1, 1, $param['year']));
			}
		}
	}

	// ---------------
	// 交通費書き込み
	// ---------------

	if(isset($param['train_fee'])){
		insert_trainfee($param['train_fee'], $_SESSION['user_cd']);
	}

	// ---------------
	// 交通費取得
	// ---------------

	$train_fee_1 = get_trainfee($_SESSION['user_cd'])[0];

	// ---------------
	// 画面表示
	// ---------------

	header('Content-Type: text/html; charset=utf-8');
	include('temp/calendar_input.html');

	database_close();
	exit;
?>
