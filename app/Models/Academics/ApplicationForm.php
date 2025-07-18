<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;
    protected $table="application_forms";

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
