<!DOCTYPE html>
<html> 
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" media="screen" href="includes/style.css"/>
	</head>
<body class="bg">

		<form method='GET'  action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="text" name="search" title="search">
			<input type="submit" value="search">
		</form>
<table>		
<?php
	$search=$_GET['search'];
	if(trim($search)!=""){
		$link = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
		mysql_select_db('quranshareef') or die('Could not select database');
		mysql_query("SET NAMES 'utf8'", $link);
		
		if(strpos($search,'"') === false){
		$terms = explode(' ', $search);
			
			$bits = array();
			foreach ($terms as $term) {
				$bits[] = " AyahText LIKE '%".mysql_real_escape_string($term)."%'";
			}
			$srcqry = "(".implode(' AND ', $bits).")";
		}else {
			$search = str_replace('"', '', $search);
			$srcqry=" AyahText LIKE '%".mysql_real_escape_string($search)."%'";
		}

		$qry ='SELECT SuraID,VerseID,AyahText, lang.DatabaseID, Name FROM quran,lang WHERE '.$srcqry.'  AND lang.DatabaseID = quran.DatabaseID ORDER BY `VerseID`';
		//echo $qry; exit;
		$resultset = mysql_query($qry);
		printf ("No of records: %d\n", mysql_affected_rows());
		
		while ($rsAyah= mysql_fetch_array($resultset, MYSQL_ASSOC)) {
			$ayah= $rsAyah['AyahText'];
			$name= $rsAyah['Name'];
			$surano= $rsAyah['SuraID'];
			$VerseID=$rsAyah['VerseID'];
			$DatabaseID=$rsAyah['DatabaseID'];
			$ayah = str_replace($search, '<span style="color:red"><b>'.$search.'</b></span>', $ayah);
			
			$file= 'alltrans/'.$surano.'.html#'.$VerseID;
			$str.='<tr class="border_bottom"><td><a href="'.$file.'">'.$surano.':'.$VerseID.'</a><br/>';

			$qry1="SELECT AyahText FROM quran WHERE SuraID=$surano AND VerseID=$VerseID AND DatabaseID=1";
			$rs1= mysql_fetch_row(mysql_query($qry1));

			$str.= '<span class="arabic">'.$rs1[0].'</span><br/>';
			$str.='<span>'.$name.'<br/>'.$ayah.'</span><br/><br/>';

				$str.='</td></tr>'."\n";
		}
			echo $str;
		mysql_close($link);
?>
		</table>
<?php		
	}	
?>
	
	</body>
</html>
	
