<?php 
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename="'.$title_for_layout.'.xml"');
echo $content_for_layout; ?>