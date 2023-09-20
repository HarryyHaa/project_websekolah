$(document).ready(function(){


	$("input[type='radio']").click(function(){
		var selectedValue = $("input[name='answer']:checked").val();
		if (selectedValue) {
			var id = $('#ID').val();
			var answer = selectedValue;
			var jasonData = {
				ID : id,
				answer : answer
			};

			$("#progress").show();
			$.ajax({
				url: baseUrl + 'student/quiz/save_ajax_answer',
				type : "post",
				data :  jasonData,
				success: function(result) {

					setTimeout(function(){
						$("#progress").hide();
					},random_number());
					// console.log(jasonData)
				},
				error : function (err) {
					// console.log(err)
				}
			})
			var quiz_number = $("#quiz_number").text();
			$("#number_option_"+quiz_number).removeClass("grey").addClass("green");
		}
	});

	$("#doubtful").click(function(){
		if ($('#doubtful').val() == '0')
		{
			var status = 'on';
		}else{
			var status = 'NULL';
		}

		var id = $('#ID').val();
		var quiz_number = $("#quiz_number").text();
		var jasonData = {
			ID : id,
			doubtful : status
		};

		$("#progress").show();
		setTimeout(function(){
			$.ajax({
				url : baseUrl + 'student/quiz/set_doubtful',
				type : "post",
				data : jasonData,
				success : function (result){
					var newValue = JSON.parse(result);
				// console.log(newValue.doubtful)
				$("#doubtful").val(newValue.doubtful);
				if (newValue.doubtful == 0) {
					$("#number_option_"+quiz_number).removeClass("orange").addClass("green");
				}else{
					$("#number_option_"+quiz_number).removeClass("green").addClass("orange");
				}
				$("#progress").hide();
			},
			error : function (err) {
				// console.log(err)
			},
		})
		},random_number());
	});

	$(".next").click(function(){

		var jasonData = {
			classroom : $("#classroom_ID").val(),
			number 	: $("#quiz_number").text(),
			type 	: 'next'
		}

		$("#selectedA, #selectedB, #selectedC, #selectedD, #selectedE").removeAttr('checked').prop('checked', false);		
		$("#progress").show();
		$('.navigation-btn').prop('disabled', true);

		setTimeout(function(){
			$.ajax({
				url : baseUrl + 'student/quiz/next_number',
				type : "post",
				data : jasonData,
				success : function (result) {
					var newValue = JSON.parse(result);

					if (newValue.status != '1') {
						window.location.replace(baseUrl+'student/quiz/forced_stop/'+newValue.classroomId);
					}else{

						$("#ID").val(newValue.encodedId)
						$("#quiz_number").text(newValue.number);
						$("#question").html(newValue.question);
						$("#answer1").html(newValue.answer1);
						$("#answer2").html(newValue.answer2);
						$("#answer3").html(newValue.answer3);
						$("#answer4").html(newValue.answer4);
						$("#answer5").html(newValue.answer5);
						$("img").addClass(" responsive-img");
						if (newValue.answer != '') {
							$("#selected"+newValue.answer).attr('checked', 'checked').prop('checked', true);
						}
						if (newValue.is_doubtful == null) {
							$("#doubtful").prop('checked', false);
						}else{
							$("#doubtful").prop('checked', true);
						}

						if (newValue.quiz_type == '2') {
							$(".question_choice").hide();
							$("#answer_essay").show();
							$("#answer").val(newValue.answer_essay);

						}else{
							$(".question_choice").show();
							$("#answer_essay").hide();
						}

						if (newValue.audio == 'available') {
							$('#audio').show();
							$('#audio_core').attr('src', newValue.audio_core);
						}else{
							$('#audio').hide();
						}

						$("#progress").hide();
						$('.navigation-btn').prop("disabled", false);

						$.getScript(baseUrl + 'aila_cbt/vendor/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image');

					// console.log(newValue);
				}
			},
			error : function (err) {
				// console.log(err)
			},
		});
		},random_number());
	});

	$("#prev").click(function(){

		var jasonData = {
			classroom : $("#classroom_ID").val(),
			number 	: $("#quiz_number").text(),
			type 	: 'prev'
		}

		$("#selectedA, #selectedB, #selectedC, #selectedD, #selectedE").removeAttr('checked').prop('checked', false);		
		$("#progress").show();
		$('.navigation-btn').prop('disabled', true);

		setTimeout(function(){
			$.ajax({
				url : baseUrl + 'student/quiz/next_number',
				type : "post",
				data : jasonData,
				success : function (result) {
					var newValue = JSON.parse(result);

					if (newValue.status != '1') {
						window.location.replace(baseUrl+'student/quiz/forced_stop/'+newValue.classroomId);
					}else{

						$("#ID").val(newValue.encodedId)
						$("#quiz_number").text(newValue.number);
						$("#question").html(newValue.question);
						$("#answer1").html(newValue.answer1);
						$("#answer2").html(newValue.answer2);
						$("#answer3").html(newValue.answer3);
						$("#answer4").html(newValue.answer4);
						$("#answer5").html(newValue.answer5);
						$("img").addClass(" responsive-img");
						if (newValue.answer != '') {
							$("#selected"+newValue.answer).attr('checked', 'checked').prop('checked', true);
						}
						if (newValue.is_doubtful == null) {
							$("#doubtful").prop('checked', false);
						}else{
							$("#doubtful").prop('checked', true);
						}

						if (newValue.quiz_type == '2') {
							$(".question_choice").hide();
							$("#answer_essay").show();
							$("#answer").val(newValue.answer_essay);

						}else{
							$(".question_choice").show();
							$("#answer_essay").hide();
						}

						if (newValue.audio == 'available') {
							$('#audio').show();
							$('#audio_core').attr('src', newValue.audio_core);
						}else{
							$('#audio').hide();
						}

						$.getScript(baseUrl + 'aila_cbt/vendor/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image');
						$("#progress").hide();
						$('.navigation-btn').prop("disabled", false);
					// console.log(newValue);
				}
			},
			error : function (err) {
				// console.log(err)
			},
		});
		},random_number());
	});

	$(".number_option").click(function(){
		var jasonData = {
			classroom : $("#classroom_ID").val(),
			number : $(this).attr("data-id"),
			type : "number"
		}

		$("#selectedA, #selectedB, #selectedC, #selectedD, #selectedE").removeAttr('checked').prop('checked', false);		
		$("#progress").show();
		$('.navigation-btn').prop('disabled', true);

		setTimeout(function(){
			$.ajax({
				url : baseUrl + 'student/quiz/next_number',
				type : "post",
				data : jasonData,
				success :function(result){
					var newValue = JSON.parse(result);

					if (newValue.status != '1') {
						window.location.replace(baseUrl+'student/quiz/forced_stop/'+newValue.classroomId);
					}else{

						$("#ID").val(newValue.encodedId)
						$("#quiz_number").text(newValue.number);
						$("#question").html(newValue.question);
						$("#answer1").html(newValue.answer1);
						$("#answer2").html(newValue.answer2);
						$("#answer3").html(newValue.answer3);
						$("#answer4").html(newValue.answer4);
						$("#answer5").html(newValue.answer5);
						$("img").addClass(" responsive-img");
						if (newValue.answer != '') {
							$("#selected"+newValue.answer).attr('checked', 'checked').prop('checked', true);
						}
						if (newValue.is_doubtful == null) {
							$("#doubtful").prop('checked', false);
						}else{
							$("#doubtful").prop('checked', true);
						}

						if (newValue.quiz_type == '2') {
							$(".question_choice").hide();
							$("#answer_essay").show();
							$("#answer").val(newValue.answer_essay);

						}else{
							$(".question_choice").show();
							$("#answer_essay").hide();
						}

						if (newValue.audio == 'available') {
							$('#audio').show();
							$('#audio_core').attr('src', newValue.audio_core);
						}else{
							$('#audio').hide();
						}

						$.getScript(baseUrl + 'aila_cbt/vendor/tinymce/plugins/tiny_mce_wiris/integration/WIRISplugins.js?viewer=image');
						$("#progress").hide();
						$('.navigation-btn').prop("disabled", false);

					// console.log(newValue);
				}
			},
			error : function(err){

			}
		});
		},random_number());
		// console.log($(this).attr("data-id"))
	});

	var timeoutId;
	$('#answer_essay').on('input propertychange change', function() {
		console.log('Textarea Change');
		clearTimeout(timeoutId);
		timeoutId = setTimeout(function() {
			saveToDB();
		}, 1000);
	});

	function saveToDB()
	{
		var jasonData = {
			ID : $('#ID').val(),
			answer : $("#answer").val()
		}

		$.ajax({
			url: baseUrl + 'student/quiz/save_essai',
			type : "post",
			data :  jasonData,
			success: function(result) {
				var quiz_number = $("#quiz_number").text();
				$("#number_option_"+quiz_number).removeClass("grey").addClass("green");
				// console.log(result)
			},
			error : function (err) {
				// console.log(err)
			}
		})

		// console.log('Saving to the db');

		var d = new Date();
		$('.form-status-holder').html('Saved! Last: ' + d.toLocaleTimeString());
	}


})

function random_number() {
	var min = 5;
	var max = 10;
	var random = Math.floor(Math.random() * (max - min + 1)) + min;
	return random;
}