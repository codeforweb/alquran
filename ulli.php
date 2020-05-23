<!DOCTYPE html>
<html> 
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" media="screen" href="includes/style.css"/>
	</head>
<body class="bg">

		<form method='GET'  action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="text" name="verses" placeholder="verses" value="1:1">
			<br><input type="text" name="ayahseperator" placeholder="ayahseperator" value=":">
			<br><input type="text" name="surahseperator" placeholder="surahseperator" value=",">
			<br><input type="submit" value="ULLI">
		</form>
<table>		
<?php
	$verses= trim($_GET['verses']);
	$ayahseperator = trim($_GET['ayahseperator']);
	$surahseperator= trim($_GET['surahseperator']);
	
	if($verses!=""){
		
		$link = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
		mysql_select_db('quranshareef') or die('Could not select database');
		mysql_query("SET NAMES 'utf8'", $link);

		echo '<ol class="tamil">';
		
		$listverses = explode($surahseperator , $verses);
		//print_r($listverses);
		for($i=0;$i < count($listverses) ;$i++){
			$singleverse = $listverses[$i];
			list($surah,$verse) = explode ($ayahseperator , $singleverse);
			//echo $surah.'->'.$verse.'<br>';
			$qry= 'SELECT AyahText,VerseID,lang.DatabaseID, Name FROM `quran` , lang WHERE `SuraID` = '.$surah.' AND VerseID='.$verse .' AND (quran.DatabaseID=1 OR quran.DatabaseID=5) AND lang.DatabaseID = quran.DatabaseID ORDER BY VerseID,DatabaseID';

			$resultset = mysql_query($qry);
			//printf ("No of records: %d\n", mysql_affected_rows());
			$prevsurah=0;$prevverse = 0;
			while ($rsAyah= mysql_fetch_array($resultset, MYSQL_ASSOC)) {
				$ayah= $rsAyah['AyahText'];
				$db = $rsAyah['DatabaseID'];
				
				if($prevsurah!=$surah && $prevverse!=$verse){
					echo '<li>'."\n";
					$prevsurah=$surah;$prevverse = $verse;
				}
				if($db==1) {
					echo '<span class="arabic">'.$ayah .'</span>'."\n";	
				}else{
					echo '<span class="tamil">'.$ayah .'&nbsp;['.$surah.':'.$verse.']' .'</span>'."\n";	
				}
				
				if($prevsurah!=$surah && $prevverse!=$verse){
					//echo $surah.','.$prevsurah.','.$verse.'<br>';
					echo '</li>'."\n";
				}
			}	
			
		}
	}
	echo '<ol>';
?>
	
	</body>
</html>
	
