<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function created_by_user()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
