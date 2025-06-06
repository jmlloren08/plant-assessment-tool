<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantModel extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $table = 'tbl_plant_models';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'make_id',
        'name',
        'description',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    
    public function make()
    {
        return $this->belongsTo(PlantMake::class, 'make_id');
    }
}
