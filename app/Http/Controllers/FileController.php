<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFileJob;
use App\Jobs\DeleteFileJob;
use App\Jobs\ParseUploadFileJob;
use Auth;
use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{

    //запускаем задачу на парсинг файла для добавления категорий или продуктов
    public function loading (Request $request, string $cls) {

        $request->validate([
            'parse_file' => 'required|file|mimes:csv,txt'
        ]);

        $this->dispatch(new ParseUploadFileJob($request->file('parse_file')
                                            ->store(config('my.public_files')),
                                        $cls)
                                    );

        return back();
    }

    //запускаем задачу на формирование файла выгрузки категорий или товаров
    public function download (string $cls){

        dispatch(new CreateFileJob(Auth::user(),$cls));
        return back();
    }

    // функция загрузки файла клиенту
    public function saveFile (){

        $headers = [
            'Content-Description: File Transfer',
            'Content-Type: application/octet-stream',
            'Content-Transfer-Encoding: binary',
            'Expires: 0',
            'Cache-Control: must-revalidate',
            'Pragma: public'
        ];
        $user = Auth::user();

        $filePath = $user->file_path;

        $user->file_path = null;
        $user->save();

        //задача на удаление файла
        dispatch(new DeleteFileJob($filePath));

        return Storage::download($filePath,'downloadFile.csv',$headers);
    }
}
