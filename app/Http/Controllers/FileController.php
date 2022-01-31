<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFileJob;
use App\Jobs\ParseUploadFileJob;
use Auth;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function upload (Request $request, string $cls) {

        $request->validate([
            'parse_file' => 'required|file|mimes:csv,txt'
        ]);

        $this->dispatch(new ParseUploadFileJob($request->file('parse_file')
                                            ->store(config('my.public_files')),
                                        $cls)
                                    );

        return back();
    }

    public function save (string $cls){

        dispatch(new CreateFileJob(Auth::user(),$cls));

        return back();
    }
}
