<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'tbl_plants';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'plant_type_id',
        'serial_range_id',
        'configuration_id',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public function plantType()
    {
        return $this->belongsTo(PlantType::class, 'plant_type_id');
    }

    public function serialRange()
    {
        return $this->belongsTo(PlantSerialRange::class, 'serial_range_id');
    }

    public function configuration()
    {
        return $this->belongsTo(PlantConfiguration::class, 'configuration_id');
    }
}
