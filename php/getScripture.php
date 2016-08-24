<?php    

include 'scripture.php';


/*
 *  DEV
 */

function parseReference_book (&$reference) {
    
    // load the verses
    $filename = "../bibles/bible_de.json";
    $handle = fopen($filename, "r") or die ("Unable to open file!");
    $contents = fread($handle, filesize($filename));
    $bible_info = json_decode($contents, true);
    fclose($handle); 
    
    
    echo("<script>console.log('".$bible_info."');</script>");
    $foundItem;
    foreach($bible_info as $item) {
        if ($foundItem) break;
        if (strpos($reference, $item['name']) !== false) {
            $reference = str_replace($item['name'], "", $reference);
            $foundItem = $item;
            break;
        }
        foreach ($item['alternatives'] as $alt) {
            if (strpos($reference, $alt) !== false) {
                $reference = str_replace($alt, "", $reference);
                $foundItem = $item;
                break;
            }
        }
    }
    $reference = str_replace(' ','', $reference);
    return $foundItem;
}

function parseReference_chapter (&$reference) {
    if (!$reference || $reference == "") return;
    
    $chapter;
    if (strpos($reference,":")) {
        $chapter = explode(":",$reference)[0];
        $reference = str_replace(":", "", $reference);
    } else {
        $chapter = $reference;
    }
    $reference = str_replace($chapter, "", $reference);
    return $chapter;
}

function parseReference_verse (&$reference) {
    if (!$reference || $reference == "") return;
   
    if (!strpos($reference,"-")) {
        return $reference;
    } else {
        $v = explode("-", $reference);
        if (count($v) != 2 || $v[0] > $v[1]) return;
        if ($v[0] == $v[1]) return $v[0];
        else {
            $verses = array();
            for ($i = $v[0]; $i < ($v[1]+1); $i++) {
                array_push($verses, $i);
            }
            return $verses;
        }
    }
}

$reference = $_GET["reference"];



$bibleBook;
$bibleChapter;
$bibleVerse;
if (!empty($reference)) {
    $bibleBook = parseReference_book ($reference);
    $bibleChapter = parseReference_chapter ($reference);
    $bibleVerse = parseReference_verse ($reference);
    
    $wholeChapter;
    if  (empty($bibleVerse)) $wholeChapter = true;
    else $wholeChapter = false;
    
    getScripture("../bibles/schlachter_1951_strong.xml", $bibleBook['nummer'], $bibleChapter, 1, $wholeChapter, $bibleVerse);
} else {
    


    /*
     * INITIALIZE
     */
        // logging
        $tmpLog = $_GET["log"];
        if (!empty($tmpLog)) {
            if ($tmpLog == "true") {
                $log = true;
            } else {
                $log = false;
            }
        } else {
            $log = false;
        }

        // bible
        if (!empty($_GET["translation"])) {
            if ($_GET["translation"] == "schlachter") 
                $bible = "../bibles/schlachter_1951_strong.xml";
            else if ($_GET["translation"] == "luther") 
                $bible = "../bibles/luther_1545_strong.xml";
            else {
                echo("<script>console.log('PHP: Unknown bible translation. Use default.');</script>");
                $bible = "../bibles/schlachter_1951_strong.xml";
            }
        } else {
            $bible = "../bibles/schlachter_1951_strong.xml";
        }

        // book
        if(!empty($_GET["book"]))  $bookNr = $_GET["book"];
        else {
            $bookNr = "1";
            echo("<script>console.log('PHP: The book number was not specified!');</script>");
        }


        // chapter
        $chapterNr = array();
        if(!empty($_GET["chapter"]))  {
            $tmpChapters = $_GET["chapter"];
            if (strpos($tmpChapters,'-')) {
                $ch = explode('-',$tmpChapters);
                if (count($ch) != 2) echo("<script>console.log('PHP: Multiple ranges for chapters are not supported!');</script>");
                $cFrom = intval ($ch[0]);
                $cTo = intval ($ch[1]) + 1;
                for ($c = $cFrom; $c < $cTo; $c++) { 
                    array_push($chapterNr, $c);
                }	
                if ($log) echo("<script>console.log('PHP: Multiple chapters selected.');</script>");
            } else {
                if ($log) echo("<script>console.log('PHP: Only one chapter selected: chapter ".$tmpChapters.".');</script>");
                array_push($chapterNr, $tmpChapters);
            }
        } else {
            array_push($chapterNr,"1");
            echo("<script>console.log('PHP: The chapter number was not specified!');</script>");
        }
        $chCount = count($chapterNr);


        // verses
        if ($chCount == 1) {
            $versesNr = array();
            $arrVers = array();
            $arrVRange = array();
            $tmpVerses = $_GET["verses"];
            if(!empty($tmpVerses)) {
                if (!strpos($tmpVerses,',') && !strpos($arrVEl,'-')) {
                    array_push($versesNr, intval($tmpVerses));
                } else if (strpos($tmpVerses,',')) {
                    if ($log) echo("<script>console.log('PHP: Multiple arrays of verses selected.');</script>");
                    $arrVers = explode (',',$tmpVerses);
                } else array_push($arrVers, $tmpVerses);
                foreach ($arrVers as $arrVEl) {
                    if (strpos($arrVEl,'-')) {
                        if ($log) echo("<script>console.log('PHP: Multiple ranges of verses selected.');</script>");
                        $arrVRange = explode ('-',$arrVEl);
                    } else array_push($arrVRange, $arrVEl);
                    if (count($arrVRange) != 2) echo("<script>console.log('PHP: Ranges must have format <value>-<value>!');</script>");
                    $vFrom = intval ($arrVRange[0]);
                    $vTo = intval ($arrVRange[1]) + 1;
                    for ($v = $vFrom; $v < $vTo; $v++) { 
                        array_push($versesNr, $v);
                    }	
                }
                sort($versesNr);
                if ($log) {
                    $comma_separated = implode(",", $versesNr);
                    echo("<script>console.log('PHP: Following verses have been selected: ".$comma_separated.".');</script>");
                }	
            } else {
                $wholeChapter = true;
            }
        }	else {
            echo("<script>console.log('PHP: Multiple chapters AND multiple verses are not supported!');</script>");
            $wholeChapter = true;
        }


    /*
       echo $bible."<br />";
        echo "book ".$bookNr."<br />";
        var_dump($chapterNr);
        echo "<br />chapters amount: ".$chCount."<br />";
    echo "whole chapters: ".$wholeChapter."<br />";
    var_dump($versesNr);
    */

     getScripture($bible, $bookNr, $chapterNr, $chCount, $wholeChapter, $versesNr);

}


































/*
 *	Fetch the right part of scripture.
 */
 /*
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
*/
?>