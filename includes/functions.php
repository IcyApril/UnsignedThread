<?php

if(!defined('includeAllow')){die('Direct access not premitted');}

function statusIDtoPhrase ($status) {
	
	switch ($status) {

	case 1:
		$statusName = "host reply";
		break;
	
	case 2:
		$statusName = "guest reply";
		break;
		
	case 3:
		$statusName = "closed";
		break;
		
	case 4:
		$statusName = "new";
		break;
	}
	
	return $statusName;
	
}

function statusIDtoPhraseFormatted ($status) {
	
	switch ($status) {

	case 1:
		$statusName = '<span class="badge badge-inverse">host reply</span>';
		break;
	
	case 2:
		$statusName = '<span class="badge badge-warning">guest reply</span>';
		break;
		
	case 3:
		$statusName = '<span class="badge">closed</span>';
		break;
		
	case 4:
		$statusName = '<span class="badge badge-important">new</span>';
		break;
	}
	
	return $statusName;
	
}

function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0) $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'&hellip;';
   return $phrase;
}