<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // Menentukan field yg boleh di masukkan ke dalam table
    // protected $fillable = ['thumbnail', 'title', 'dan lain-lain'];
    // protected $fillable = ['thumbnail','item_name','item_price','item_amount'];

    // Menentukan field yg tidak boleh dimasukkan ke dalam table
    protected $guarded = ['id'];


    // RELATIONSHIP
    public function category()
    {
        // $this->belongsTo('Model Category', 'yg ada di table blog', 'yg ada di table category');
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function user()
    {
        // $this->belongsTo('Model User', 'yg ada di table blog', 'yg ada di table user');
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function item()
    {
        // $this->belongsTo('Model User', 'yg ada di table blog', 'yg ada di table user');
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
    }
}
