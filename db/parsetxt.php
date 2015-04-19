<?php
$lines = file('parse1.txt');
$sql='';
$surano=0;
foreach ($lines as $line_num => $line) {
	if (eregi('Surah', $line)) {
		
		//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
		$surano++;
		list($SuraID, $suraName) = explode(':',$line);
		//list($SuraID, $translit, $AyahText, $ar) = explode(' 	',$line);
		//$lit = substr($translit,0,strpos($translit,'('));
		//if(strlen($lit)!=0) $translit =$lit;
		//echo $SuraID,$translit.'<br>';
		$suraName=addslashes(trim($suraName));

		$sql .= "INSERT INTO `surahnames` (`surano`,`Name`,`DatabaseID`) VALUES ($surano,'$suraName',4);"."<br>";

	}	
}
	echo $sql;
	//file_put_contents('names.sql', $sql);




?>