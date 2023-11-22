<?php

function h($haapsi){
	$hash = md5($haapsi);
	$r = implode("0", array_reverse(str_split($hash)));
	echo substr($r, 5, 10);
}

$r = $_GET["haapsi"]??null;

if ($r!==null) h($r); else exit("send get parameter haapsi");