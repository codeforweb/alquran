<?php
$sql='';$versecnt=0;
$lines = file('output.txt');
foreach ($lines as $line_num => $line) {
	//$line ='[001.001] In the Name of Allâh, the Most Beneficent, the Most Merciful';
	//$line="[003:001] Alif-Lâm-Mîm.[These letters are one of the miracles of the Qur'ân, and none but Allâh (Alone) knows their meanings.]";
	$pos1= strpos ($line,']');
	$num =substr($line, 1, $pos1-1);
	$ayah= substr($line, $pos1+1, (strlen($line)-$pos1) );
	$ayah=addslashes(trim($ayah));
	//echo $num.'->'.$ayah.'<br>';exit;
	list($SuraID, $VerseID) = explode(":", trim($num));
	$SuraID= sprintf('%d',$SuraID);
	$VerseID= sprintf('%d',$VerseID);
	//echo 'P -> '.$SuraID.':'.$VerseID.'<br>';
	$qry = "INSERT INTO quran(DatabaseID,SuraID,VerseID,AyahText) VALUES (3, ".$SuraID.",".$VerseID.",'$ayah');"."\n";
	echo $qry.'<br>';
	$sql .= $qry;
	$versecnt++;

}	
file_put_contents('4.sql', $sql);
echo '<br>done<br>'.$versecnt;

?>