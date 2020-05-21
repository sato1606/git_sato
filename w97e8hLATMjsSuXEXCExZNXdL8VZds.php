<?php session_start();

$data_list = array('person','bicycle','car','motorcycle','airplane','bus','train','truck','boat','traffic light','fire hydrant','street sign','stop sign','parking meter','bench','bird','cat','dog','horse','sheep','cow','elephant','bear','zebra','giraffe','hat','backpack','umbrella','shoe','eye glasses','handbag','tie','suitcase','frisbee','skis','snowboard','sports ball','kite','baseball bat','baseball glove','skateboard','surfboard','tennis racket','bottle','plate','wine glass','cup','fork','knife','spoon','bowl','banana','apple','sandwich','orange','broccoli','carrot','hot dog','pizza','donut','cake','chair','couch','potted plant','bed','mirror','dining table','window','desk','toilet','door','tv','laptop','mouse','remote','keyboard','cell','phone','microwave','oven','toaster','sink','refrigerator','blender','book','clock','vase','scissors','teddy bear','hair drier','toothbrush','hair brush');


if(!empty($_POST['send'])){

	$set_url = $_SERVER["REQUEST_URI"];
	$threshold_list = $_POST['threshold'];
	// $camera_id = $POST[''];
	$camera_id = "rtsp://~";
	$show_fps = $_POST['show_fps'];
	$rotation = $_POST['rotation'];
	$flag_box = $_POST['flag_box'];


	// 空の配列を用意
	$setlist = array();
	for($i = 0; $i < count($threshold_list) - 1; $i++) {
		// 値が入力されているものだけ出力
		if(!empty($threshold_list[$i])){
			$setlist = array_merge($setlist, array($data_list[$i] => array("probability" => $threshold_list[$i])));
		};
	};

	$setlist_array = array("setlist" => $setlist);
	$camera_array = array("camera_id" => $camera_id);
	$fps_aray = array("show_fps" => $show_fps);
	$rotation_array = array("rotation" => $rotation);
	$flag_array = array("flag_box" => $flag_box);

	// 配列の結合
	$hoge = array_merge($setlist_array, $camera_array, $fps_aray, $rotation_array, $flag_array);


	// 連想配列($array)をJSONに変換(エンコード)する
	$json = json_encode($hoge, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	// JSON_PRETTY_PRINT：自動的に改行とインデントをつけるためのメソッド
	// JSON_UNESCAPED_UNICODE：ユニコード・エスケープ
	// JSON_UNESCAPED_SLASHES：スラッシュ・エスケープ

	file_put_contents("config.json" , $json);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>camera_test</title>

	<!-- BootstrapのCSS読み込み -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- BootstrapのJS読み込み -->
    <script src="./js/bootstrap.min.js"></script>
	<!-- アイコン読み込み -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<!-- ヘッダー読み込み -->
    <link href="./css/luxbar.min.css" rel="stylesheet">
	<!-- フェードイン -->
    <script type="text/javascript" src="./js/fadeinicon.js"></script>

	<link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<body>
	<!-- <header id="luxbar" class="luxbar-fixed">
	    <input type="checkbox" class="luxbar-checkbox" id="luxbar-checkbox"/>
	    <div class="luxbar-menu luxbar-menu-right luxbar-menu-material-cyan">
	        <ul class="luxbar-navigation">
	            <li class="luxbar-header">
	                <a href="#" class="luxbar-brand">Trimy（仮）</a>
	                <label class="luxbar-hamburger luxbar-hamburger-doublespin" id="luxbar-hamburger" for="luxbar-checkbox"><span></span></label>
	            </li>
	            <li class="luxbar-item"><a href="#">Item 1</a></li>
	            <li class="luxbar-item"><a href="#">Item 2</a></li>
	            <li class="luxbar-item"><a href="#">Item 3</a></li>
	            <li class="luxbar-item"><a href="#">Item 4</a></li>
	        </ul>
	    </div>
	</header> -->

	<main>
		<div class="container-fluid">
        	<div class="row">
            	<div class="col-lg-4">
            		<form action="w97e8hLATMjsSuXEXCExZNXdL8VZds.php" method="post" id="setform">
            		<!-- <form action="camera.php" method="get" id="setform"> -->
            			<div class="setting-list">
            				<?php
            					for($i = 0; $i < count($data_list) - 1; $i++) {
            						echo(
            							'<div class="mysettings">
	            							<div class="col-lg-4"><p>'.$data_list[$i].'</p></div>
	            							<div class="col-lg-4"><input type="number" name="threshold[]" step="0.01" min="0" max="1"></div>
	            						</div>'
            						);

            					}
            				?>
	            		</div>

	            		
	            		

	            		<div class="rotation-list">
	            			<h5>回転の角度</h5>
	            			<p>カメラの回転の角度を設定します</p>
	            			<select name="rotation">
								<option value="m180">-180</option>
								<option value="m90">-90</option>
								<option value="0" selected>0</option>
								<option value="p90">90</option>
								<option value="p180">180</option>
							</select>
	            		</div>


	            		<div class="fps-list">
	            			<h5>FPS表示の有無</h5>
	            			<p>動画中にFPSを表示するかどうかを選択します</p>
	            			<input type="radio" name="show_fps" value="true" checked>アリ
							<input type="radio" name="show_fps" value="false">ナシ
	            		</div>

	            		<div class="fps-list">
	            			<h5>バウンディングボックス表示の有無</h5>
	            			<p>動画中にバウンディングボックスを表示するかどうかを選択します</p>
	            			<input type="radio" name="flag_box" value="true" checked>アリ
							<input type="radio" name="flag_box" value="false">ナシ
	            		</div>

	            		<!-- <div class="threshold-list">
	            			<h5>確信度の設定</h5>
	            			<p>
	            				物体を検知する際、どの程度の確信度で検知するかを設定します
	            			</p>
	            			<select name="threshold">
								<option value="60">60%</option>
								<option value="65">65%</option>
								<option value="70">70%</option>
								<option value="75">75%</option>
								<option value="80" selected>80%</option>
								<option value="85">85%</option>
								<option value="90">90%</option>
								<option value="95">95%</option>
							</select>
	            		</div>
 -->

	            		<input type="submit" value="送信" name="send">
	            	</form>
            	</div>

            	<div class="col-lg-8">
            		<div class="movie-space">
            			<?php echo htmlspecialchars($json, ENT_QUOTES, 'UTF-8'); ?>

						
            			
            		</div>
            	</div>
        	</div>
    	</div>
	</main>

	<footer></footer>
</body>
</html>