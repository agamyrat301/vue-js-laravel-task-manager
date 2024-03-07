<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    
    public function getStatus():string
    {
        switch ($this->status){
            case 0:
                return 'pending';
                break;
            case 1:
                return 'in progress';
                break;
            case 2:
                return 'done';
                break;
        }

    }
}
