<?php 

function verifyLogin($username, $password){;
  $sql = sprintf("select * from users where username = '%s' or email = '%s'", mysql_real_escape_string($username), mysql_real_escape_string($username));
  $result = mysql_query($sql);
  $num_results = mysql_num_rows($result);
  $row = mysql_fetch_assoc($result);

  $bcrypt = new Bcrypt(1);
  if ($num_results == 1 && $bcrypt->verify($password,$row["password_hash"])){
    login($username);
    return true;
  }else{
    // echo "<script type=\"text/javascript\">".
    //       "window.location = \"login.php?error=badlogin\"".
    //       "</script>";
    redirect_to_URL("login.php?error=badlogin");
  }
  return false;
}

function checkLogin($dispError = true){
  if (isset($_SESSION["username"]) && isset($_SESSION["userid"]) && isset($_SESSION["useremail"])){
    return true;
  }else{
    // echo "<script type=\"text/javascript\">".
    //       "window.location = \"login.php?error=notloggedin\"".
    //       "</script>";
    if($dispError){
      // Display Error message saying to login first
      redirect_to_URL("login.php?error=notloggedin");
    }else{
      redirect_to_URL("login.php");
    }
  }
  return false;
}

function hashPassword($password){
  $bcrypt = new Bcrypt(1);
  return $bcrypt->hash($password);
}

function logout(){
  unset($_SESSION["username"]);
  unset($_SESSION["userid"]);
  unset($_SESSION["useremail"]);
}

function login($username){
  $sql = sprintf("select * from users where username = '%s' or email = '%s'", mysql_real_escape_string($username), mysql_real_escape_string($username));
  $result = mysql_query($sql);
  $row = mysql_fetch_assoc($result);  
  $_SESSION["username"] = $row["username"];
  $_SESSION["userid"] = $row["id"];
  $_SESSION["useremail"] = $row["email"];
}

class Bcrypt {
  private $rounds;
  public function __construct($rounds = 12) {
    if(CRYPT_BLOWFISH != 1) {
      throw new Exception("bcrypt not supported in this installation. See http://php.net/crypt");
    }

    $this->rounds = $rounds;
  }

  public function hash($input) {
    $hash = crypt($input, $this->getSalt());

    if(strlen($hash) > 13)
      return $hash;

    return false;
  }

  public function verify($input, $existingHash) {
    $hash = crypt($input, $existingHash);
    return $hash === $existingHash;
  }

  private function getSalt() {
    $salt = sprintf('$2a$%02d$', $this->rounds);

    $bytes = $this->getRandomBytes(16);

    $salt .= $this->encodeBytes($bytes);

    return $salt;
  }

  private $randomState;
  private function getRandomBytes($count) {
    $bytes = '';

    if(function_exists('openssl_random_pseudo_bytes') &&
        (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')) { // OpenSSL slow on Win
      $bytes = openssl_random_pseudo_bytes($count);
    }

    if($bytes === '' && is_readable('/dev/urandom') &&
       ($hRand = @fopen('/dev/urandom', 'rb')) !== FALSE) {
      $bytes = fread($hRand, $count);
      fclose($hRand);
    }

    if(strlen($bytes) < $count) {
      $bytes = '';

      if($this->randomState === null) {
        $this->randomState = microtime();
        if(function_exists('getmypid')) {
          $this->randomState .= getmypid();
        }
      }

      for($i = 0; $i < $count; $i += 16) {
        $this->randomState = md5(microtime() . $this->randomState);

        if (PHP_VERSION >= '5') {
          $bytes .= md5($this->randomState, true);
        } else {
          $bytes .= pack('H*', md5($this->randomState));
        }
      }

      $bytes = substr($bytes, 0, $count);
    }

    return $bytes;
  }

  private function encodeBytes($input) {
    // The following is code from the PHP Password Hashing Framework
    $itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $output = '';
    $i = 0;
    do {
      $c1 = ord($input[$i++]);
      $output .= $itoa64[$c1 >> 2];
      $c1 = ($c1 & 0x03) << 4;
      if ($i >= 16) {
        $output .= $itoa64[$c1];
        break;
      }

      $c2 = ord($input[$i++]);
      $c1 |= $c2 >> 4;
      $output .= $itoa64[$c1];
      $c1 = ($c2 & 0x0f) << 2;

      $c2 = ord($input[$i++]);
      $c1 |= $c2 >> 6;
      $output .= $itoa64[$c1];
      $output .= $itoa64[$c2 & 0x3f];
    } while (1);

    return $output;
  }
}
?>