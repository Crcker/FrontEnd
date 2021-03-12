<?php
  header("Content-Type: text/plain");
  $string = $_GET["text"];
  $pattern = '/(\s+)/';
  $replacement = ' ';
  $clean = trim( $string );
  echo preg_replace($pattern, $replacement, $clean);
?>
