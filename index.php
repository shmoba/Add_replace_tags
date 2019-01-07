<?php
error_reporting(E_ALL);
mb_internal_encoding('utf-8');
// Дано: $x - большой текст с html кодом, где часто встречаются теги em и i. Необходимо наклонный текст сделать еще и красным цветом.

$text = '<p>Текст — зафиксированная на каком-либо материальном носителе человеческая мысль; в общем плане связная и полная последовательность символов. Существуют две основные <i>трактовки</i> понятия «текст»: имманентная (расширенная, философски нагруженная) и <em>репрезентативная</em> (более частная). Имманентный подход подразумевает <i>отношение</i> к тексту как к автономной реальности, <em>нацеленность</em> на выявление его внутренней структуры. Репрезентативный — рассмотрение текста как особой формы представления знаний о внешней тексту действительности.</p>';
echo $text;

function arrray_tag ($str, $start, $end) { // получить массив со словами в тегах
  $contents = array();
  $start_length = strlen($start);
  $end_length = strlen($end);
  $start_from = $content_start = $content_end = 0;
  while (false !== ($content_start = strpos($str, $start, $start_from))) {
    $content_start += $start_length;
    $content_end = strpos($str, $end, $content_start);
    if (false === $content_end) {
      break;
    }
    $contents[] = substr($str, $content_start, $content_end - $content_start);
    $start_from = $content_end + $end_length;
  }
    return $contents;
}

$contents = array_merge(arrray_tag($text, '<i>', '</i>'),arrray_tag($text, '<em>', '</em>'));

//print_r($contents);

function replace_tags ($str, $contents, $start, $end) { // обернуть слова в тег
  foreach($contents as $key => $word) {
    $str = str_replace($word, $start.$word.$end,$str);
    }
    return $str;
}
$start = '<span style="color:red">';
$end = '</span>';
echo replace_tags($text,$contents,$start,$end);

?>