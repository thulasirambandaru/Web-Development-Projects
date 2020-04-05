<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('say_hello') ) {

    function say_hello( $name = 'world' ) {
        echo 'Hello ' . $name;
    }

}


if(!function_exists('commom_images'))
{
	function commom_images()
	{
		$CI =& get_instance();
		$CI->load->model("mwelcome");
		$result=$CI->mwelcome->getSchool();
		$image=array();
		$image['logo']=$result[0]['school_logo'];
		$image['fav_icon']=$result[0]['fav_icon'];
		return $image;
	}
}


if(!function_exists('do_upload')){

    function do_upload($file_name,$file_tem_name,$folder)
    {
        $target_dir = "uploads/";
        if($folder!='' && $folder!=0){
            if(!is_dir($target_dir.$folder)){
                mkdir($target_dir.$folder);
            }
            $target_dir = $target_dir.$folder.'/';
            $folder = $folder.'/';
        }
        else $folder = '';
        $image = $file_name;
        list($txt, $ext) = explode(".", $image);
        $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;

        $target_file = $target_dir.$actual_image_name;
        if(move_uploaded_file($file_tem_name,$target_file)){
            return $folder.$actual_image_name;
        }
        else
        {
            return 0;
        }

    }

}

if(!function_exists('generate_password')){

    function generate_password($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);

    }

}

if(!function_exists('image_url')){

    function image_url($image,$type)
    {
        $file = '';
        if(!$image){
            if($type=='school'){ $file = BASE_URL.'images/default-school.JPG'; }
            else if($type=='user'){ $file = BASE_URL.'images/default_avatar.png'; }
        }
        else if(file_exists('uploads/'.$image)){ $file = BASE_URL.'uploads/'.$image; }
        else{
            if($type=='school'){ $file = BASE_URL.'images/default-school.JPG'; }
            else if($type=='user'){ $file = BASE_URL.'images/default_avatar.png'; }
        }
        return $file;
    }

}

if(!function_exists('exact_mage_url')){

    function exact_mage_url($image)
    {
        $file = '';
        if(!$image){
            $file=0;
        }
        else if(file_exists('uploads/'.$image)){
            $file = BASE_URL.'uploads/'.$image;
        }

        return $file;
    }

}


if(!function_exists('check_file_type')){

    function check_file_type($tem_name,$file_type)
    {
        $valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png");

        if($file_type=='image')
            $valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png");

        $file_extension = strrchr($tem_name, ".");
        if(!in_array($file_extension, $valid_file_extensions)) {
           return false;
        }
        else{
            return true;
        }
    }

}

if(!function_exists('encode')) {

    function encode($value)
    {
        $key='#&sun_sms@*#&';
        return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');
    }
}

if(!function_exists('decode')) {

    function decode($value)
    {
        $key='#&sun_sms@*#&';
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($value, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }
}

if(!function_exists('week_days')) {

    function week_days($value)
    {
        $day = '';
        switch($value)
        {
            case 0 : $day = "Sunday"; break;
            case 1 : $day = "Monday"; break;
            case 2 : $day = "Tuesday"; break;
            case 3 : $day = "WednesDay"; break;
            case 4 : $day = "Thursday"; break;
            case 5 : $day = "Friday"; break;
            case 6 : $day = "Saturday"; break;
        }

        return $day;
    }
}
if(!function_exists('get_days_in_month')) {

    function get_days_in_month($month, $year)
    {
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }
}

?>