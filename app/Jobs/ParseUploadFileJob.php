<?php

namespace App\Jobs;

use App\Http\Controllers\FileController;
use App\Models\User;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class ParseUploadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private $cls;
    private $columnName;
    private $insertArray;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filePath, string $cls)
    {
        $this->filePath = $filePath;
        $this->cls = ucfirst($cls);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->readFile();
        $this->insertDb();
    }

    protected function readFile(){
        $cont = fopen(Storage::path($this->filePath),'r');
        $this->columnName = fgetcsv($cont,3000,';');
        while(!feof($cont)){
            $line = (array) mb_convert_encoding(fgetcsv($cont,3000,';'),'UTF-8');
            $line = array_map(function($v){
                return $v === '' ? null : $v;
            },$line);
            if($line && count($line) == count($this->columnName)) $this->insertArray[] = array_combine($this->columnName,$line);
        }
        fclose($cont);
        Storage::delete($this->filePath);
    }

    protected function insertDb (){
        $cls = "\App\Models\\$this->cls";
        $cls::upsert($this->insertArray,['id'],$this->columnName);
    }
}
