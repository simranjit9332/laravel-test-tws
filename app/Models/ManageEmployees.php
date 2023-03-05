<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageEmployees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'company_id ',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];
}
