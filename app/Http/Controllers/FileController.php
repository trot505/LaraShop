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

    public function download (string $cls){

        dispatch(new CreateFileJob(Auth::user(),$cls));

        return back();
    }

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

        dispatch(new DeleteFileJob($filePath));

        return Storage::download($filePath,'downloadFile.csv',$headers);
    }
}
