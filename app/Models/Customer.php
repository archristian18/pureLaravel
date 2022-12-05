<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $fillable = ['firstname', 'lastname', 'details'];

    public function Customer()
    {
        return $this->belongsTo(AddCustomer::class);
    }

}
