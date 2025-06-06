<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantSerialNumber extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $table = 'tbl_plant_serial_numbers';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'serial_range_id',
        'serial_number',
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

}
