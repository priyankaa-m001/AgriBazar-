<?php
// I am not using this file in the project right now. I made check_login() and
// random_num() when I was learning, but my login now works through
// user-account.php and $_SESSION['user'], so I kept this file only for reference.
// I did not delete it, because I may use random_num() later for order numbers.

// Note: check_login() below still uses mysqli and points to login.php,
// which does not exist in this project, so please do not use it as it is.
function check_login($con)
{
     if(isset($_SESSION['user_id']))
     {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
     }

     //redirect to login page//

     header("Location:login.php");
     die;


}

function  random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }

     $len = rand(4,$length);

     for($i=0; $i < $len; $i++)
     {
       //code
       $text .= rand(0,9);
     }

      return $text;
}

?>