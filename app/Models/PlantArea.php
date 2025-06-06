<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantArea extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $table = 'tbl_plant_areas';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'serial_range_id',
        'plant_type_id',
        'ignition_id',
        'fuel_id',
        'oxygen_id',
        'name',
        'description',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public function serialRange()
    {
        return $this->belongsTo(PlantSerialRange::class, 'serial_range_id');
    }

    public function plantType()
    {
        return $this->belongsTo(PlantType::class, 'plant_type_id');
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }

    public function ignition()
    {
        return $this->belongsTo(IgnitionSource::class, 'ignition_id');
    }

    public function oxygen()
    {
        return $this->belongsTo(OxygenSource::class, 'oxygen_id');
    }
}
