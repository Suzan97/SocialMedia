<?php
class Login {
        public static function isLoggedIn() {
                if (isset($_COOKIE['SNID'])) {
                        if (DB::query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($_COOKIE['SNID'])))) {
                                $user_id = DB::query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
                                if (isset($_COOKIE['SNID_'])) {
                                        return $user_id;
                                } else {
                                        $cstrong = True;
                                        $tokens = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                                        DB::query('INSERT INTO login_tokens VALUES (\'\', :tokens, :user_id)', array(':tokens'=>sha1($tokens), ':user_id'=>$user_id));
                                        DB::query('DELETE FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($_COOKIE['SNID'])));
                                        setcookie("SNID", $tokens, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                                        setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                                        return $user_id;
                                }
                        }
                }
                return false;
        }
}
?>