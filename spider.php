<?php
// Simple Captcha by Deon van Zyl
// 2009
// ---------
// This allows a Image with wording to display (Captcha)
// The user submits what is displayed to show that he isn`t a bot
// -----------
// -- add refresh javascript--

echo "
<SCRIPT LANGUAGE='JavaScript'>
setTimeout('window.location.reload();', 50000);
</script>
";

//-------

/*---------Encrypt img word---*/

// Generate Random ImagePassword

$encryptedpassword = generate_password();

function generate_password ($length = 6, $valid_chars = "")
{
    if($valid_chars=="")
    {
        // $valid_chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_."; //Very Strict
	$valid_chars = "abcdefghijklmnopqrstuvwxyzZ0123456789";
    }

    $imgpassword="";

    while($length>0)
    {
        $imgpassword.=$valid_chars[rand(0,strlen($valid_chars)-1)];
        $length--;
    }

    return $imgpassword;

}

// Create a Image with a String in it for Auth with time delay
//-----------done encrypt------------

if ((isset($imgpassword)==isset($imgword))&&(md5($imgpassword)==$imgword)&&(strlen($imgpassword)>5)&&(strlen($imgword)>5)){

    $today=date("Ymd");
    $spider=$ref.$today;
    $spider=md5($spider);

    if (strstr($ref,'modules') !== false) {
    	echo "<form method=post action='modules.php?name=$ref' name='proof'>";
    }else{

    	echo "<form method=post action='$ref' name='proof'>";
    }

    echo "<input type='hidden' name='spider' value='$spider'>
    </form>";

    echo "<script language='javascript'>
    document.proof.submit();
    </script>";

    echo "You are being redirected.If you experience any problems , please enable javascript on your browser";


}else{

        $mirrorpass=md5($encryptedpassword);

        //provide form to log in
        echo "<form method=post action='modules.php?name=antispider' name='login'>";

        echo "<table border='0'>";

        if (strlen($d_op)>'0'){
        	$ref=$ref."&d_op=$d_op";
        	echo "<input type='hidden' name='ref' value='$ref'>";
        	echo "<input type='hidden' name='d_op' value='$d_op'>";
        }else{
        	echo "<input type='hidden' name='ref' value='$ref'>";
        }


        echo "<tr><td>Type the exact characters displayed in the following image,into the textbox below it.</td></tr><tr><td><img src='./secureimage&encryptedpassword=$encryptedpassword'  align='left'border='1' /></td></tr>";
        echo "<tr><td colspan='2'><input type=text name=imgpassword><input type=submit value=\"Proceed\"></td></tr>";
        echo "</table>
        <input type='hidden' name='imgword' value='$mirrorpass'>";
        echo "</form>";
        echo "<b>Please Note:</b>The word will change every 50 Seconds.";

}
