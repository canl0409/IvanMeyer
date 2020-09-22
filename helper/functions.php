<?php

function tipoMidia($video, $texto, $audio, $ico = null)
{
    if ($ico) {
        if ($video) {
            return "fa-caret-square-right";
        }
        if ($audio) {
            return "fa-volume-down";
        }
        if ($texto) {
            return "fa-file";
        }
    } else {
        if ($video) {
            return "Vídeo";
        }
        if ($audio) {
            return "Áudio";
        }
        if ($texto) {
            return "Leitura";
        }
    }
}

function getRss()
{
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = true;
    $dom->loadXML(file_get_contents('https://www.terradamusicablog.com.br/rss'));

    $i = 1;
    foreach ($dom->getElementsByTagName('link') as $item) {
        $count = $i++;
        if ($count < 4) {
            $imagest = ($dom->getElementsByTagName('description')[$count]->nodeValue);
            preg_match('/src="([^"]*)"/i', $imagest, $image);
            $posts[$count]['image'] = $image[1];
            $posts[$count]['title']  = $dom->getElementsByTagName('title')[$count]->nodeValue;
            $posts[$count]['link']  = $dom->getElementsByTagName('link')[$count]->nodeValue;
        }
    }

    return $posts;
}

function data($d)
{
    return date('d/m/Y', strtotime($d));
}

function money($num)
{
    return   'R$' . number_format($num, 2); // retorna R$100,000.50
}


function uspace($tx)
{
    $text = str_replace(" ", '_', $tx);
    return $text;
}
function space($tx)
{
    $text = str_replace("_", ' ', $tx);
    return $text;
}
function ta($tx)
{
    $bad = array('À', 'à', 'Á', 'á', 'Â', 'â', 'Ã', 'ã', 'Ä', 'ä', 'Å', 'å', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Č', 'č', 'Ç', 'ç', 'Ď', 'ď', 'Đ', 'đ', 'È', 'è', 'É', 'é', 'Ê', 'ê', 'Ë', 'ë', 'Ě', 'ě', 'Ę', 'ę', 'Ğ', 'ğ', 'Ì', 'ì', 'Í', 'í', 'Î', 'î', 'Ï', 'ï', 'Ĺ', 'ĺ', 'Ľ', 'ľ', 'Ł', 'ł', 'Ñ', 'ñ', 'Ň', 'ň', 'Ń', 'ń', 'Ò', 'ò', 'Ó', 'ó', 'Ô', 'ô', 'Õ', 'õ', 'Ö', 'ö', 'Ø', 'ø', 'ő', 'Ř', 'ř', 'Ŕ', 'ŕ', 'Š', 'š', 'Ş', 'ş', 'Ś', 'ś', 'Ť', 'ť', 'Ť', 'ť', 'Ţ', 'ţ', 'Ù', 'ù', 'Ú', 'ú', 'Û', 'û', 'Ü', 'ü', 'Ů', 'ů', 'Ÿ', 'ÿ', 'ý', 'Ý', 'Ž', 'ž', 'Ź', 'ź', 'Ż', 'ż', 'Þ', 'þ', 'Ð', 'ð', 'ß', 'Œ', 'œ', 'Æ', 'æ', 'µ', '”', '“', '‘', '’', "'", "\n", "\r", '_');
    $good = array('A', 'a', 'A', 'a', 'A', 'a', 'A', 'a', 'Ae', 'ae', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'O', 'o', 'Oe', 'oe', 'O', 'o', 'o', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'Ue', 'ue', 'U', 'u', 'Y', 'y', 'Y', 'y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 'TH', 'th', 'DH', 'dh', 'ss', 'OE', 'oe', 'AE', 'ae', 'u', '', '', '', '', '', '', '', '-');
    $text = str_replace($bad, $good, $tx);
    return $text;
}

function ln($ln)
{
    $lk = ta($ln);
    $lk = str_replace(" ", '-', $lk);
    return strtolower($lk);
}


$sqlConnect = new Config();
function sec($string, $censored_words = 1, $br = true)
{
    global $sqlConnect;
    $string = trim($string);
    $string = mysqli_real_escape_string($sqlConnect->mysqli, $string);
    $string = htmlspecialchars($string, ENT_QUOTES);
    if ($br == true) {
        $string = str_replace('\r\n', " <br>", $string);
        $string = str_replace('\n\r', " <br>", $string);
        $string = str_replace('\r', " <br>", $string);
        $string = str_replace('\n', " <br>", $string);
    } else {
        $string = str_replace('\r\n', "", $string);
        $string = str_replace('\n\r', "", $string);
        $string = str_replace('\r', "", $string);
        $string = str_replace('\n', "", $string);
    }
    $string = stripslashes($string);
    $string = str_replace('&amp;#', '&#', $string);
    if ($censored_words == 1) {
        global $config;
        $censored_words = @explode(",", $config['censored_words']);
        foreach ($censored_words as $censored_word) {
            $censored_word = trim($censored_word);
            $string        = str_replace($censored_word, '****', $string);
        }
    }
    return $string;
}


function ln2($ln)
{
    $lk = ta($ln);
    $lk = str_replace(" ", '', $lk);
    $lk = str_replace("/", '_e_', $lk);
    $lk = str_replace("--", '-', $lk);
    $lk = str_replace("---", '-', $lk);
    $lk = str_replace(".", '', $lk);
    return strtolower($lk);
}

function ur($t)
{
    $text = uspace(ta(trim($t)));
    return strtolower($text);
}

function coods($o)
{

    return substr($o, 0, -1);
}


function ytcode($url)
{
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
    return $matches[1];
}
