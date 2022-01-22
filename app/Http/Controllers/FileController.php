<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $addFile;
    protected $saveFile;

    public function parse(Request $request, string $cls){

        $request->validate([
            'add_file' => 'mimes:csv'
        ]);

        $this->addFile = $request->file('add_file');

    }

    public function save(string $cls){

    }

    protected function readFile(){
        $fd = fopen($this->addFile, 'r');
        $r = 1;
        while (($data = fgetcsv($fd, 1000, ",")) !== FALSE) {
            if($r == 1){

            }
        }
        fclose($fd);
    }

    function remove_utf8_bom($text)
    {
        $bom = pack('H*','EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }

    function file_force_download() {
        if (file_exists($this->saveFile)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($this->saveFile));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($this->saveFile));
            // читаем файл и отправляем его пользователю
            readfile($this->saveFile);
            //удаление файла
            unlink($this->saveFile);
            exit;
        }
    }
}
