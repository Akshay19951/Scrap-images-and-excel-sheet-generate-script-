<?php
include 'Scrap.php';

$url = 'https://www.e-careers.in/it-networking-cyber-security/microsoft-technical';
$scrap = new Scrap($url, '//*[@id="tiles"]/li/a/div/div/img');
$path = __DIR__;
$scrap->dirDownload($path , 'folder');
$scrap->columns(array('Web Url', 'My Url'), 'csvFilename');