<?php

namespace App\Actions\Import;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProcessImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    use AsAction;


    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $hotel = new Hotel();
        foreach (config('app.import_fields') as $key => $field) {
            if (isset($field)) {
                if ($field == 'image') {
                    Storage::disk('public')->putFileAs('images', $row[$key], $row[$key]);
                }
                $hotel->$field  = $row[$key];
            }
        }
        $hotel->save();
    }
}
