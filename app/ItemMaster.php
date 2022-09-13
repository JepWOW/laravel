<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    //
    protected $fillable = [
        'type_id',
        'code',
        'description',
        'created_by',
        'deleted_at'
    ];

    public function type(){
        return $this->BelongsTo('\App\ItemType', 'type_id', 'id')->where('deleted_at', null);
    }

}
