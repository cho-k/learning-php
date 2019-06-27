<?php
	// パラメータを取得します
	if (isset($_POST['hobbies']) && is_array($_POST['hobbies'])) {
    	$_POST["hobbies"] = implode(", ", $_POST["hobbies"]);
	}
	print_r($_POST);

	$fp=fopen("form_data.txt","a");
	foreach ($_POST as $a => $b){
		fputs($fp, $a."->".$b."\n");
	}
	fclose($fp);


	// データベースに接続します
	$server = "localhost";
	$username = "ユーザー名";
	$password = "パスワード";
	$mysql = mysql_connect($server, $username, $password);


	// 取得したパラメータをテーブルに保存します
	$db_selected = mysql_select_db('データベース名', $mysql);
	$insert = "INSERT INTO form_data (name, prefectures, sex, hobbies) VALUES ('$_POST[name]', '$_POST[prefectures]', '$_POST[sex]', '$_POST[hobbies]')";
	$result = mysql_query($insert);


	// データベースを切断します
	mysql_close($mysql);
?>
