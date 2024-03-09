<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    
    public function getStatus():string
    {
        switch ($this->status){
            case 'pending':
                return 'pending';
                break;
            case 'progress':
                return 'in progress';
                break;
            case 'done':
                return 'done';
                break;
        }

    }
}
