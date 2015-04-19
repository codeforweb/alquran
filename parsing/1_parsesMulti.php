<?php
libxml_use_internal_errors(true);
$sql='';
$doc = new DOMDocument();
$doc->encoding = 'UTF-8'; // insert proper
$versecnt=0;
$text='';
if ($handle = opendir('mk/')) {    
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
		
			$doc->loadHTMLFile('mk/'.$entry);

			$xpath = new DOMXpath($doc);
			$target_table_rows = $xpath->query('//div/table/tr');
			$txt = $target_table_rows->item(0)->nodeValue;
			$text.=$txt;
		}
	}
}
 file_put_contents('1.txt', $text);
 echo 'done';



?>