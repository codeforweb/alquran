<!DOCTYPE html>
<html> 
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" media="screen" href="includes/style.css"/>
	</head>
<body class="bg">
	<table>
<?php

		$link = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
		mysql_select_db('quranshareef') or die('Could not select database');
		mysql_query("SET NAMES 'utf8'", $link);
		
		for($i=2 ;$i< 115 ;$i++){
			//$qry ='SELECT SuraID,VerseID,AyahText, lang.DatabaseID, Name FROM quran,lang WHERE DatabaseID=1 and SuraID='.$i.'  AND lang.DatabaseID = quran.DatabaseID ORDER BY `VerseID`';
			$qry ='SELECT AyahText FROM quran WHERE DatabaseID=1 and VerseID=1 AND SuraID='.$i.'  ORDER BY `SuraID`';
			//echo $qry; exit;
			$rs = mysql_query($qry);
			$row= mysql_fetch_row($rs);
			$ayah=$row[0];
			//$ayah = str_replace('بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ', '', $ayah);
			//$qry ="update quran SET AyahText='$ayah' WHERE DatabaseID=1 and VerseID=1 AND SuraID=$i;";
			echo $ayah."<br>";
		}
		mysql_close($link);
?>
	
		</table>
	</body>
</html>
	
