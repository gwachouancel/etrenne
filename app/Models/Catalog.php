<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class Catalog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'supplier_id', 'path', 'filiale_id', 'ref_catalog'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function getOnlyReferences(){
        return Catalog::select("ref_catalog")->distinct()->pluck('ref_catalog');
    }
}
