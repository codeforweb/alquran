<?php
$link = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
mysql_select_db('quranshareef') or die('Could not select database');
mysql_query("SET NAMES 'utf8'", $link);

$result = mysql_query('SELECT * FROM surahnames where DatabaseID=4') or die('Query failed: ' . mysql_error());

$indexstr ='<!DOCTYPE html><html> <head><meta charset="UTF-8">';
$indexstr .='<style>h1{text-align:center}.bg{background-color: #ffffcc;}table { font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif; }li{margin-bottom:10px;}</style>';
$indexstr .='</head> <body class="bg">'."\n";
$leftframe=$indexstr;

$indexstr.='<div class="arabic" style="text-align:center;font-weight:bold;font-size:30px">بِسۡمِ ٱللَّهِ ٱلرَّحۡمَٰنِ ٱلرَّحِيمِ </div>'."\n";
$indexstr.='<h1>Surah Index</h1>'."\n";
$indexstr.='<table width="49%" cellspacing="0" cellpadding="0" bordercolor="#00FFCC" border="1" align="center" bordercolordark="#009900" bordercolorlight="#66FFCC">';
$indexstr.='<tbody><tr><td bgcolor="#009999">No</td><td bgcolor="#009999" align="center">Surah Name</td></tr>'."\n";

$leftframe.='<ol>';

while ($rs = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$surano = $rs['surano'];
	$surahname= $rs['Name'];
	$filename= $surano.'.html';

	$indexstr.='<tbody><tr><td><a href="'.$surano.'.html">'.$surano.'</a></td><td align="left"><a href="'.$filename.'">'.$surahname.'</a></td></tr>'."\n";
	$leftframe.='<li><a href="'.$filename.'" target="main">'.$surahname.'</a></li>'."\n";
	
	$resultset = mysql_query('SELECT AyahText,VerseID,lang.DatabaseID, Name FROM `quran` , lang WHERE `SuraID` = '.$surano.' AND lang.DatabaseID = quran.DatabaseID ORDER BY VerseID,DatabaseID');

	$str ='<!DOCTYPE html><html> <head><meta charset="UTF-8">'."\n";
	$str .='<link rel="stylesheet" media="screen" href="includes/style.css"/>'."\n";
	$str .='<style></style>'."\n".'</head>';
	$str.='<body class="bg"><table>'."\n";
	
	$str.='<h1>'.$surano.' - '.$surahname.'</h1>'."\n";
	$str.='<div class="shadow">';
	$rs = mysql_query("SELECT Name FROM surahnames where `surano`=$surano AND (DatabaseID=1 OR DatabaseID=5)");
	while ($rs1 = mysql_fetch_row($rs)) {	
		$str.= $rs1[0].'<br/>';
	}
	$str.='</div>'."\n";
	if($surano!=9) 
			$str.='<tr class="arabic" style="text-align:left;"><td>بِسۡمِ ٱللَّهِ ٱلرَّحۡمَٰنِ ٱلرَّحِيمِ </td></tr>'."\n";

	$prevVerse=0;	
	while ($rsAyah= mysql_fetch_array($resultset, MYSQL_ASSOC)) {
		$ayah= $rsAyah['AyahText'];
		$name= $rsAyah['Name'];
		$VerseID=$rsAyah['VerseID'];
		$DatabaseID=$rsAyah['DatabaseID'];
		//echo $VerseID,$prevVerse.'<br>';
		if($VerseID!=$prevVerse){
			$prevVerse=$VerseID;
			$str.='<tr class="border_bottom"><td><span id="'.$VerseID.'">'.$surano.':'.$VerseID.'</span><br/>';			
		}
		if($DatabaseID==1){
			$str.= '<span class="arabic">'.$ayah.'</span><br/>';
		}else $str.='<span>'.$name.'<br/>'.$ayah.'</span><br/><br/>';

		if($VerseID!=$prevVerse){
			$str.='</td></tr>'."\n";
		}
	}
		$str.='</table></body></html>';
		//echo $str;
		file_put_contents('alltrans/'.$filename, $str);

}
	$indexstr.='</tbody></table></body></html>';
	$leftframe.='</ol></body></html>';
	
	file_put_contents('alltrans/0.html', $indexstr);
	file_put_contents('alltrans/frameindex.html', $leftframe);
	echo $indexstr;

mysql_free_result($result);
mysql_close($link);
echo $cnt.' Lines..  DONE';

?>