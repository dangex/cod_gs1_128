<?php
namespace Ayeo\Barcode\Response;

use Ayeo\Barcode\Printer;

abstract class Response
{
    public function __construct(Printer $printer)
    {
        $this->printer = $printer;
    }

    abstract function getType();

    public function output($text, $filename, $disposition = 'inline')
    {
//        header(sprintf('Content-Type: %s', $this->getType()));
//        header(sprintf('Content-Disposition: %s;filename=%s', $disposition, $filename));
//        imagepng($this->printer->getResource($text));
        
        ob_start();
        imagepng($this->printer->getResource($text));
        $bin = ob_get_clean();
        $b64 = base64_encode($bin);
       
        return $b64;
    }
}