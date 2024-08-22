<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'file_path'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
