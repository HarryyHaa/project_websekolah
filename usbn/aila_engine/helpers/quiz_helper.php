<?php

if (! function_exists('encode')) {
	function encode($text=''){
		return rtrim(strtr(base64_encode($text), '+/', '-_'), '=');
	}
}

if (! function_exists('decode')) {
	function decode($text=''){
		return base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($text) % 4, '=', STR_PAD_RIGHT));
	}
}


// function encode($i)
// {
// 	$CI =&get_instance();
// 	$_alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
// 	$CI->_alphabet = str_split($_alphabet);
// 	if ($i == 0)
// 		return $CI->_alphabet[0];

// 	$result = '';
// 	$base = count($CI->_alphabet);

// 	while ($i > 0)
// 	{
// 		$result[] = $CI->_alphabet[($i % $base)];
// 		$i = floor($i / $base);
// 	}

// 	$result = array_reverse($result);

// 	return join("", $result);
// }


// function decode($input)
// {
// 	$CI =&get_instance();
// 	$_alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
// 	$CI->_alphabet = str_split($_alphabet);
// 	$i = 0;
// 	$base = count($CI->_alphabet);

// 	$input = str_split($input);

// 	foreach($input as $char)
// 	{
// 		$pos = array_search($char, $CI->_alphabet);

// 		$i = $i * $base + $pos;
// 	}

// 	return $i;
// }


if (! function_exists('count_correct_multiple_choice')) {
	function count_correct_multiple_choice($student_ID='', $classroom_ID){
		$CI =&get_instance();
		$correct = $CI->quiz_model->get_correct_answer_total($classroom_ID, $student_ID);
		return $correct;
	}
}

if (! function_exists('count_score_multiple_choice')) {
	function count_score_multiple_choice($student_ID='', $classroom_ID, $quiz_total=''){
		$CI =&get_instance();
		$correct = $CI->quiz_model->get_correct_answer_total($classroom_ID, $student_ID);
		if ($quiz_total == 0) {
			$score 	= 0;
		}else{
			$score 	= (($correct / $quiz_total) * 100);
		}
		return number_format($score, 2);
	}
}

if (! function_exists('count_score_essay')) {
	function count_score_essay($student_ID='', $classroom_ID, $quiz_name_ID){
		$CI =&get_instance();

		$total = $CI->quiz_model->get_score_weight($quiz_name_ID);
		$correct = $CI->quiz_model->get_score_essay($classroom_ID, $student_ID);
		if ($total == 0) 
		{
			return 0;
		}
		else
		{
			if ($total == 0) {
				$score = 0;
			}else{
				$score 	= (($correct / $total) * 100);
			}
			return number_format($score, 2);
		}
	}
}

if (! function_exists('count_score_total')) {
	function count_score_total($student_ID='', $classroom_ID, $quiz_name_ID, $multiple_choice_percentage, $essay_percentage){
		$CI =&get_instance();

		// start multiple choice score
		$total_multiple_choice_score = $CI->quiz_model->count_quiz_by_classroom_id($classroom_ID, $quiz_type = 1);
		$correctmultiple_choice_score = $CI->quiz_model->get_correct_answer_total($classroom_ID, $student_ID);
		if ($total_multiple_choice_score == 0) {
			$multiple_choice = 0;
		}else{
			$multiple_choice = (($correctmultiple_choice_score / $total_multiple_choice_score) * $multiple_choice_percentage); 
		}
		// end multiple choice score

		// start essay score
		$total_essay_score = $CI->quiz_model->get_score_weight($quiz_name_ID);
		$correct_essay_score = $CI->quiz_model->get_score_essay($classroom_ID, $student_ID);

		if ($total_essay_score <= 0) $total_essay_score = 1;

		$essay = (($correct_essay_score / $total_essay_score) * $essay_percentage); 
		// end essay score

		$total = $multiple_choice + $essay;

		return number_format($total, 2);

	}
}

if (! function_exists('row_count')) {
	function row_count($table='', $select= NULL, $where = NULL){
		$CI =&get_instance();
		if ($select != NULL) {
			$CI->db->select($select);
		}
		if ($where != NULL) {
			$CI->db->where($where);
		}
		return $CI->db->get($table)->num_rows();
	}
}

if (! function_exists('remove_tag_p')) {
	function remove_tag_p($text){
		$text 		= str_replace('<p>', '', $text);
		$new_text 	= str_replace('</p>', '', $text);
		return $new_text;
	}
}

if (! function_exists('random_string')) {
	function random_string($length = 10) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}


if ( ! function_exists('pagination')) {
	function pagination($url, $rowscount, $per_page) {
		$ci = & get_instance();
		$ci->load->library('pagination');

		$config = array();
		$config["base_url"] = base_url($url);
		$config["total_rows"] = $rowscount;
		$config["per_page"] = $per_page;
        //config for bootstrap pagination class integration
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="material-icons">chevron_left</i>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="material-icons">chevron_right</i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$ci->pagination->initialize($config);
		return $ci->pagination->create_links();
	}
}

if(!function_exists('set_host_server'))
{
	function set_host_server($string='')
	{
		$CI =& get_instance();
		$CI->load->helper('url');
		return preg_replace('/http:\/\/(.*?)aila_cbt/', get_instance()->config->base_url().'aila_cbt', $string);
	}
}

if (!function_exists('clear_text'))
{
	function clear_text($text)
	{
		$text = stripslashes($text);
		$text = strip_tags($text);
		$text = str_replace('pastebin.com', '', $text);
		return $text;
	}
}

if (!function_exists('limit_login')) 
{
	function limit_login($status_limit = false)
	{
		if ($status_limit) 
		{
			$CI 		=& get_instance();
			$student_id = $CI->session->userdata('ID');
			$session_id = $CI->session->userdata('session_id');
			$student 	= $CI->db->select('session_id')->where('ID', $student_id)->get('student');
			if ($student->num_rows() > 0) 
			{
				if ($student->row()->session_id != $session_id) 
				{
					$CI->session->set_flashdata('info', 'Terdapat device lain yang digunakan untuk masuk ke akun ini!');
					redirect('main/logout');
				}
			}
		}
	}
}

if (! function_exists('is_mobile')) {
	function is_mobile()
	{
		$useragent=$_SERVER['HTTP_USER_AGENT'];

		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			return TRUE;
		}else{
			return FALSE;
		}

	}
}