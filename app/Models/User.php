<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'userId');
    }
}
