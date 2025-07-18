<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class HelpCenterFeature extends Model
{
    use Searchable;
    public function toSearchableArray(): array
    {
        $array['content'] = $this->content;
        $array['name'] = $this->name;
        return $array;
    }
}
