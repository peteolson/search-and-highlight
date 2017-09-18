<!DOCTYPE html>
<html lang="en">
<form id="search" action="search.php?search" method="post" name="search">
<p>needle</p><p><input name="needle" type="text" size="20" value="
<?php echo isset($_POST['needle']) ? $_POST['needle'] : '' ?>">
<p>haystack</p><p><input name="haystack" type="text" size="20" value="
<?php echo isset($_POST['haystack']) ? $_POST['haystack'] : '' ?>">
<input type="submit" value="submit">
</form>
</body>
</html>

<?php
	function highlightKeywords($text, $keyword) 
	{
			$wordsAry = explode(" ", $keyword);
			$wordsCount = count($wordsAry);
			
			for($i=0;$i<$wordsCount;$i++) {
				$highlighted_text = "<span style='font-weight:bold;color:red;'>$wordsAry[$i]</span>";
				$text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
			}

			return $text;
	}

    function search()
    {
		if (isset($_POST['needle']) and isset($_POST['haystack'])) 
		{
			$needle = $_POST['needle'];
			$haystack = $_POST['haystack'];
			if(preg_match_all('/'.$needle.'/i',$haystack))
			{
				echo nl2br(highlightKeywords($haystack,$needle));
			}
		} 
    }
//Controller
$param = $_SERVER['QUERY_STRING'];
$arr = explode("=", $param);
if (count($arr) > 1) {
    $param = $arr[0];
}
if ($param == "search") {
    search();
}
?>
