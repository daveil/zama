<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;Filename=$title_for_layout.xls");
header('Cache-Control: max-age=0');
$content_for_layout; 
exit;