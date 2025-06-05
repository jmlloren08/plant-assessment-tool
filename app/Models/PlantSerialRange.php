<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantSerialRange extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'tbl_plant_serial_ranges';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'model_id',
        'plant_area_id',
        'name',
        'description',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public function model()
    {
        return $this->belongsTo(PlantModel::class, 'model_id');
    }
    
    public function plantArea()
    {
        return $this->belongsTo(PlantArea::class, 'plant_area_id');
    }
}
