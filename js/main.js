data_list = ['person','bicycle','car','motorcycle','airplane','bus','train','truck','boat','traffic light','fire hydrant','street sign','stop sign','parking meter','bench','bird','cat','dog','horse','sheep','cow','elephant','bear','zebra','giraffe','hat','backpack','umbrella','shoe','eye glasses','handbag','tie','suitcase','frisbee','skis','snowboard','sports ball','kite','baseball bat','baseball glove','skateboard','surfboard','tennis racket','bottle','plate','wine glass','cup','fork','knife','spoon','bowl','banana','apple','sandwich','orange','broccoli','carrot','hot dog','pizza','donut','cake','chair','couch','potted plant','bed','mirror','dining table','window','desk','toilet','door','tv','laptop','mouse','remote','keyboard','cell','phone','microwave','oven','toaster','sink','refrigerator','blender','book','clock','vase','scissors','teddy bear','hair drier','toothbrush','hair brush']


$(function(){
	$('#send').click(function() {
		
		// 空の配列を用意
		var setlist = {}

		for (var i=0; i < data_list.length; i++) {

			threshold_num = "#threshold"+i;

			threshold = $(threshold_num).val();

			if (threshold != ''){
				// 値の入力があったものだけsetlistに追加していく
				setlist[data_list[i]] = {"probability": threshold};
				// console.log(setlist);
			};
		};

		var camera = 'rtsp://~';
		var fps = $('input[name="show_fps"]:checked').val();
		var rotation = $('select[name="rotation"]').val();
		var flag = $('input[name="flag_box"]:checked').val();


		var js_array = {
				setlist: setlist,
				camera_id: camera,
				show_fps: fps,
				rotation: rotation,
				flag_box: flag
			}

		var json_text = JSON.stringify(js_array);

		console.log(json_text)
		$.post('/config', json_text)

	})
})