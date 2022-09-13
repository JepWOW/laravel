<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    //
    protected $fillable = [
        'code',
        'description',
        'created_by',
        'deleted_at'
    ];

    public function masters(){
        return $this->hasMany('\App\ItemMaster', 'type_id')->where('deleted_at', null);
    }
}
