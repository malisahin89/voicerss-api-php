<?php
// https://github.com/malisahin89
// https://www.linkedin.com/in/muhammetalisahin/

require_once 'voicerss_tts.php';

function sefText($text)
{
    $text = mb_strtolower($text, 'UTF-8');
    $tr = ['ş', 'ı', 'ü', 'ğ', 'ç', 'ö', 'Ş', 'İ', 'Ü', 'Ğ', 'Ç', 'Ö'];
    $en = ['s', 'i', 'u', 'g', 'c', 'o', 'S', 'I', 'U', 'G', 'C', 'O'];
    $text = str_replace($tr, $en, $text);
    $text = preg_replace('/[^a-z0-9\s-]/u', '', $text);
    $text = preg_replace('/\s+/', ' ', $text);
    $text = str_replace(' ', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

function txt2mp3($txt)
{
    // DETAILS: https://voicerss.org/api/
    // HTML FULL FORM: https://github.com/malisahin89/voicerss-api-js
    $tts = new VoiceRSS;
    $voice = $tts->speech([
        'key' => 'abe0d1fb05954158a267cc410c184af9',
        'hl' => 'en-us',
        'v' => 'Mary',
        'src' => $txt,
        'r' => '0',
        'c' => 'mp3',
        'f' => '44khz_16bit_stereo',
        'ssml' => 'false',
        'b64' => 'false',
    ]);
    $filename = sefText($txt);
    file_put_contents($filename . '.mp3', $voice['response']);
}

$texts = ["Hello world", "text to speech", "follow me on github"];
foreach ($texts as $text) {
    txt2mp3($text);
}
