<?php

class Notify {
  public static function createNotify($text){
    $text = explode(" ", $text);
    $notify = array();

    foreach ($text as $word) {
       if(substr($word, 0, 1) == "@"){
            $notify[substr($word, 1)] = array("type"=>1, "extra"=>' {"postbody": "'.htmlentities(implode($text, " ")).'"} ');
       }
    }
    if (count($text) == 0 && $post_id !=0){
      $temp = DB::query();
      DB::query('INSERT INTO notifications VALUES(\'\', :type, :receiver, :sender, :extra)', array(':type'=>2, ':receiver'=>$r, ':sender'=>$s, ':extra'=>""));

    }
    return $notify;
  }


}

?>
