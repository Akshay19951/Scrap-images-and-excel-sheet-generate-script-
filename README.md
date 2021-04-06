# Scrap-images-and-excel-sheet-generate-script
Just copy XPath 
$xpath = '//*[@id="tiles"]/li/a/div/div/img';

Add url which you have to scrap
$url = 'https://www.e-careers.in/it-networking-cyber-security/microsoft-technical';

$scrap = new Scrap($url, $xpath);
$path = __DIR__;

Folder name which you have to create
$scrap->dirDownload($path , 'folder');

Columns name with csv file name
$scrap->columns(array('Web Url', 'My Url'), 'csvFilename');
