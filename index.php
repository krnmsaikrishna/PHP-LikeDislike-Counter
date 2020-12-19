<?php
$fp=fopen("likes.txt","r"); 
$likes= fread($fp,1024); 
fclose($fp);
$fp=fopen("dislikes.txt","r"); 
$dislikes = fread($fp,1024); 
fclose($fp);
?>

<?
if ( isset( $_POST['dislike'] ) )
{
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
$file = 'dislikesip.txt';
$searchfor=$ip;
$contents = file_get_contents($file);
$pattern = preg_quote($searchfor, '/');
$pattern = "/$pattern/";

  if(preg_match_all($pattern, $contents, $matches))
{
           $status="false";
      }
       else
{
             $status="true";
         }

if ($status=="true")
{
$dislikesip= fopen("dislikesip.txt", "a+") or die("Unable to open file!");
$txt="\n$ip";
fwrite($dislikesip, $txt);
fclose($dislikesip);
$fp=fopen("dislikes.txt","r"); 
$count = fread($fp,1024); 
fclose($fp);
$count = $count + 1;
$fp = fopen("dislikes.txt", "w"); 
fwrite($fp, $count);
fclose($fp); 
echo "Thankyou for also our dislike.";
}
else
{
echo "You are already disliked.";
}
}

if ( isset( $_POST['like'] ) )
{
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
$file = 'likesip.txt';
$searchfor=$ip;
$contents = file_get_contents($file);
$pattern = preg_quote($searchfor, '/');
$pattern = "/$pattern/";

  if(preg_match_all($pattern, $contents, $matches))
{
           $status="false";
      }
       else
{
             $status="true";
         }

if ($status=="true")
{
$likesip= fopen("likesip.txt", "a+") or die("Unable to open file!");
$txt="\n$ip";
fwrite($likesip, $txt);
fclose($likesip);
$fp=fopen("likes.txt","r"); 
$count = fread($fp,1024); 
fclose($fp);
$count = $count + 1;
$fp = fopen("likes.txt", "w"); 
fwrite($fp, $count);
fclose($fp); 
echo "Thankyou for our like.";
}
else
{
echo "You are already liked.";
}
}
?>
<link rel="stylesheet" href="w3.css" />
<style>
.arrow-left {
	width: 0; 
	height: 0; 
	border-top: 5px solid transparent;
	border-bottom: 5px solid transparent; 
	display:inline-block;
	border-right:5px solid black; 
}

td
{
}
</style>
<form action="index.php" method="post">
<div style="display:inline-block; ">
<table>
<tr>
<td style="width:25;">
<input type="submit" name="like" class="w3-btn  w3-teal w3-hover-red"  value=""
style="background-position:50% 40%; background-repeat:no-repeat; border-radius:100%; background-size:16 16; background-image:url('like.png'); width:25; height:30; position:relative;" />
</td>
<td style="margin-left:-100%;">
<div class="arrow-left"></div>
<div style="width:120px; height:30px; background-color:black; text-align:center; display:inline-block; border-radius:6px; margin-left:-5px;">
<p  color="white" style="margin-top:5px;font-size:16px;"><?php echo@$likes; ?>  likes</p>
</td>
</tr>
</table>
</div>
<div style="display:inline-block; ">
<table>
<tr>
<td style="width:25;">
<input type="submit" name="dislike" class="w3-btn w3-teal w3-hover-red" value=""
style="background-position:40% 60%; background-repeat:no-repeat; border-radius:100%; background-size:16 16; background-image:url('dislike.png'); width:25; height:30; position:relative;" />
</td>
<td>
<div class="arrow-left"></div>
<div style="width:120px; height:30px; background-color:black; text-align:center; display:inline-block; border-radius:6px; margin-left:-5px;">
<p  color="white" style="margin-top:5px;font-size:16px;"><?php echo@$dislikes; ?>  dislikes</p>
</td>
</tr>
</table>
</div>
</form>