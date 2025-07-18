<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Career extends Model
{
    use Searchable;
    public $fillable = [
        'name',
        'city',
        'state',
        'no_of_vacancy',
        'type',
        'shift_timing',
        'salary',
        'description'
    ];

    public function toSearchableArray(): array
    {
        $array['description'] = $this->description;
        $array['name'] = $this->name;
        return $array;
    }

}
