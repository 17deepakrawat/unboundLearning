<?php

namespace App\Models\Website;

use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Blog extends Model
{
    use Searchable;
    public function comments()
    {
        return $this->hasMany(BlogComment::class,'blogs_id','id');
    }

    public function toSearchableArray(): array
    {
        $array['content'] = $this->content;
        $array['name'] = $this->name;
        $array['slug'] = $this->slug;
        $array['author'] = $this->author;
        return $array;
    }
}
