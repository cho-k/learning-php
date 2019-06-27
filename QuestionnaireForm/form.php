<html>
<head>
<title>アンケートフォーム</title>
</head>
<body>

<form action="/form_regist.php" method="post">
<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<td>名前</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>都道府県</td>
		<td>
			<select name="prefectures">
<?php		
			$prefectures = ['東京都', '神奈川県', '千葉県', '埼玉県', '群馬県'];
			foreach($prefectures as $pres){
?>
				<option><?php echo $pres ?></option>
<?php
			}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>性別</td>
		<td>
			<input type="radio" name="sex" value="男">男
			<input type="radio" name="sex" value="女">女
		</td>
	</tr>
	<tr>
		<td>趣味</td>
		<td>
<?php
			$hobbies = ['サッカー', '野球', 'テニス', 'ジョギング', '水泳', '自転車',
						'読書', '映画・ドラマ', 'ゲーム', '料理', 'ドライブ'];
			foreach($hobbies as $hobs){
?>
		  <input type="checkbox" name="hobbies[]" value="<?php echo $hobs ?>"><?php echo $hobs ?>
<?php
			}
?>
		</td>
	</tr>
</table>
<input type="submit" value="送信">
</form>

</body>
</html>
