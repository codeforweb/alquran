<?php
//Translation from https://quranenc.com/en/home#transes

$sql='';$versecnt=0;
if (($handle = fopen("rwwad.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$qry = "INSERT INTO quran(DatabaseID,SuraID,VerseID,AyahText) VALUES (8, ".$data[1].",".$data[2].",'".addslashes($data[3])."');"."\n";
		echo $qry.'<br>';
		$sql .= $qry;
		$versecnt++;
    }
    fclose($handle);
}
file_put_contents('8.sql', $sql);
echo 'done';

?>