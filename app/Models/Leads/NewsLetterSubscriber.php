<?php

namespace App\Models\Leads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetterSubscriber extends Model
{
  use HasFactory;

  protected $table = 'newsletter_subscribers';

  protected $fillable = ['email'];
}
