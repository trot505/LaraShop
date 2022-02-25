<?php

namespace App\Jobs;

use App\Models\User;
use Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class CreateFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $filePath;
    private $cls;
    protected const COLUMN_LOCALE = [
        'id' => 'Идентификатор',
        'name' => 'Название',
        'category_id' => 'Категория товара',
        'price' => 'Цена',
        'amount' => 'Количество',
        'description' => 'Описание',
    ];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $cls)
    {
        $this->user = $user;
        $this->cls = ucfirst($cls);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createFile();

        $this->user->file_path = $this->filePath;
        $this->user->save();
    }

    private function createFile(){
        $this->filePath = config('my.public_files')."downloadsFile_{$this->cls}_{$this->user->id}.csv";
        $class = "\App\Models\\$this->cls";
        $data = $class::get()->makeHidden(['picture','created_at','updated_at']);
        //разделяем массив на ключи и значения и полчаем ключи массива в переменную
        [$columnName] = Arr::divide($data->first()->toArray());

        //преобразуем массив колонок в строку с заменой на русский язык
        $textFile = implode(';',array_values(array_intersect_key(self::COLUMN_LOCALE,array_flip($columnName)))).PHP_EOL;

        foreach($data->toArray() as $el){
            $textFile .= implode(';',$el).PHP_EOL;
        }

        Storage::put($this->filePath, $textFile);
    }
}
