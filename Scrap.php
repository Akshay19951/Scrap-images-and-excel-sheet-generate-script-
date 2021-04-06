<?php
class Scrap{
    protected $url = array();
    protected $dir;
    protected $cols = array();
    protected $fileName;
    public $csvData = array();

    public function __construct($webUrl, $XPath)
    {
        $result = file_get_contents($webUrl);
        $str = <<<EOF
        $result
        EOF;

        $doc = new DOMDocument();
        @$doc->loadHTML($str);    
        $selector = new DOMXPath($doc);

        $nodeList = $selector->query($XPath);

        foreach($nodeList as $node) {
            $this->url[] = $node->getAttribute('src');
        }
    }

    public function dirDownload($path, $name)
    {
        $this->dir = $path . '/'. $name .'/';

        foreach ($this->url as $key => $url) {
            if(empty($url)){ continue; }
            $ext = explode('.', $url);
            $ext = end($ext);

            $this->csvData[$key+1]="$url, $key.$ext";

            if(!is_dir($this->dir)){
                mkdir($this->dir);
            }
            file_put_contents($this->dir.$key .'.'. $ext, file_get_contents($url));
        }
    }
    public function columns(array $columns, $fileNameCSV)
    {
        $this->cols = $columns;
        $this->fileName = $fileNameCSV;
        $column_header = implode(',', $columns);
        $this->csvData[0]=$column_header;
        
        $fp = fopen($this->dir.date('dmY').'-'.$this->fileName.'.csv', 'w');
        $i = 0;
        foreach ( $this->csvData as $line ) {
            if(empty($this->csvData[$i])){ continue; }
            $val = explode(",", $this->csvData[$i]);
            fputcsv($fp, $val);
            $i++;
        }
        fclose($fp);
        $this->done();
    }
    
    public function done()
    {
        echo "<h1>Please check your $this->dir </h1>";
    }
}

