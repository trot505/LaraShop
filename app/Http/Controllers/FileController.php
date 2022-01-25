<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Arr;
use File;
use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    protected $pathFile;
    protected $data;
    protected $columnName;
    protected $textFile;
    protected $insertArray;
    protected const START_FILE = '\UFEFF';
    protected const COLUMN_LOCALE = [
        'id' => 'Идентификатор',
        'name' => 'Название',
        'category_id' => 'Категория товара',
        'price' => 'Цена',
        'amount' => 'Количество',
        'description' => 'Описание',
    ];

    public function upload (Request $request, string $cls){


        $request->validate([
            'parse_file' => 'required|file|mimes:csv,txt'
        ]);

        $this->pathFile = $request->file('parse_file')->store('public');

        $this->readFile();
        $this->insertDb($cls);

        return back();
    }

    public function save(string $cls){
        $saveFile = config('my.public_files').'downloadsFile.csv';

        $headers = [
            'Content-Description: File Transfer',
            'Content-Type: application/octet-stream',
            'Content-Transfer-Encoding: binary',
            'Expires: 0',
            'Cache-Control: must-revalidate',
            'Pragma: public'
        ];

        $cls = "\App\Models\\$cls";
        $this->data = $cls::get()->makeHidden(['picture','created_at','updated_at']);
        [$this->columnName] = Arr::divide($this->data->first()->toArray());

        $this->textFile = implode(';',array_values(array_intersect_key(self::COLUMN_LOCALE,array_flip($this->columnName)))).PHP_EOL;

        //$this->textFile = implode(';',$this->columnName).PHP_EOL;

        foreach($this->data->toArray() as $el){
            $this->textFile .= implode(';',$el).PHP_EOL;
        }

        Storage::put($saveFile, $this->textFile);

        return Storage::download($saveFile,'downloadFile.csv',$headers);
    }

    protected function readFile(){
        $cont = fopen(Storage::path($this->pathFile),'r');
        $this->columnName = fgetcsv($cont,3000,';');
        while(!feof($cont)){
            $line = fgetcsv($cont,3000,';');
            dump($line);
            if($line && count($line) == count($this->columnName)) $this->insertArray[] = array_combine($this->columnName,$line);
        }
        fclose($cont);
        Storage::delete($this->pathFile);
    }

    protected function insertDb (string $cls){
        $cls = "\App\Models\\$cls";
        dd($cls::insert($this->insertArray));
    }
    /*function remove_utf8_bom($text)
    {
        $bom = pack('H*','EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }*/
}
