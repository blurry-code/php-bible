<?php 

function getScripture($bible, $bookNr, $chapterNr, $chCount, $wholeChapter, $versesNr) { 
    
    // Open the bible an look for the right book.
	$reader = new XMLReader;
	$reader->open($bible);
	while ($reader->read()) {
		if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'BIBLEBOOK') {
			if ($reader->getAttribute("bnumber") == $bookNr) {
				$data = $reader->readOuterXML();
				break;
			} else $reader->next();
		} 
	}
    
	$cData = array();
	for ($c = 0; $c < $chCount; $c++) {
		// The book was fetched. Chose now the right chapter.
		if (!$data || $data == null) {
			echo("<script>console.log('PHP: Something went wrong fetching the book!');</script>");
		} else {
			$reader2 = new XMLReader;
			$reader2->XML($data);
			while ($reader2->read()) {
				if ($reader2->nodeType == XMLReader::ELEMENT && $reader2->name == 'CHAPTER') {
					if ($reader2->getAttribute("cnumber") == $chapterNr[$c]) {
						array_push($cData, $reader2->readOuterXML());
						break;
					} else $reader2->next();
				}
			}
		}
	}
	
	// The chapter was fetched. Chose now the right verses.
	$result = "";
	if (!$wholeChapter) {
		if (!$cData || $cData == null) {
			echo("<script>console.log('PHP: Something went wrong fetching the chapter!');</script>");
		} else {
			$vCount = 0;
			$countMax = count($versesNr);
			$reader3 = new XMLReader;
			$reader3->XML($data);
			while ($reader3->read()) {
				if ($reader3->nodeType == XMLReader::ELEMENT && $reader3->name == 'VERS') {
					if ($reader3->getAttribute("vnumber") == $versesNr[$vCount] && $vCount < $countMax) {
						$result = $result.$reader3->readOuterXML();
						$vCount++;
					} 
					$reader3->next();
				}
			}
		}
	} else {
		for ($r = 0; $r < $chCount; $r++) {
			$text = str_replace('<CHAPTER cnumber="'.$chapterNr[$r].'">','<div class="chapter"><span>Kapitel '.$chapterNr[$r].'<br /></span><p class="chapterText">',$cData[$r]);
			$result = $result.$text;
		}
	}
    formatText($result);
}

function formatText ($result) {
    // The right verses are chosen. Format now the text.
	if ($result == "") {
		echo("<script>console.log('PHP: Something went wrong fetching the verses!');</script>");
	} else {
	
		// format chapter
		$cPlace = "";
		if ($wholeChapter) {
			if ($chCount == 1) $cPlace = str_replace('<CHAPTER cnumber="'.$chapterNr.'">','<div class="chapter"><p class="chapterText">',$result); 
			else $cPlace = $result;
			$cPlace = str_replace('</CHAPTER>','</p></div>',$cPlace);
		} else {
			//$cPlace = '<div class="chapter"><span>Kapitel '.$chapterNr.'<br /></span><p class="chapterText">'.$result.'</p></div>';
			$cPlace = '<div class="chapter"><p class="chapterText">'.$result.'</p></div>';
		}
		
		// format verses
		$vPlace = preg_replace('/<VERS vnumber="(.*?)">/', '<span class="vNum">$1</span><span class="vers">', $cPlace);
		$vPlace = str_replace('</VERS>','</span>',$vPlace);
		$vPlace = str_replace('</span>','</span> ',$vPlace);
		
		// format words/strings
		$wPlace = preg_replace('/<gr str="(.*?)">/', '', $vPlace);
		$wPlace = str_replace('</gr>','',$wPlace);
		
		// decode and send back
		echo $wPlace;	
	}
}

?>