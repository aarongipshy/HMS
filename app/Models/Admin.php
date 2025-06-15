<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // ប្តូរពី false ទៅ true ដើម្បីអនុញ្ញាតឱ្យប្រើ timestamps
    public $timestamps = true;
    
    protected $fillable = [
        'username', 
        'password',
        'full_name',
        'email',
        'mobile',
        'photo',
        'address'
    ];
}
