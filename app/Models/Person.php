<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $table = 'tbl_persons';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'company_site_id',
        'name',
        'email',
        'phone',
        'role',
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    public function companySite()
    {
        return $this->belongsTo(CompanySite::class, 'company_site_id');
    }
}
