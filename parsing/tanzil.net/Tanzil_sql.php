<?php
/*
$lines = file('en.hilali');
$sql='';
foreach ($lines as $line_num => $line) {
	list($SuraID, $VerseID, $AyahText) = explode('|',$line);
	$AyahText=addslashes(trim($AyahText));
	$sql .= "INSERT INTO `Quran` (`DatabaseID`,`SuraID`,`VerseID`,`AyahText`) VALUES (3,$SuraID,$VerseID,'$AyahText');"."\n";
}
	echo 'DONE';
	file_put_contents('3_mk.sql', $sql);

	
*/

$lines = file('ur.junagarhi.txt');
$sql='';
foreach ($lines as $line_num => $line) {
	list($SuraID, $VerseID, $AyahText) = explode('|',$line);
	$AyahText=addslashes(trim($AyahText));
	$sql .= "INSERT INTO `Quran` (`DatabaseID`,`SuraID`,`VerseID`,`AyahText`) VALUES (11,$SuraID,$VerseID,'$AyahText');"."\n";
}
	echo 'DONE';
	file_put_contents('11_MuhammadJunagarhi.sql', $sql);
//*/



?>