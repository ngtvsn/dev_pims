<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_name',
        'office_code',
        'office_type_id',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the documents that belong to this office.
     */
    public function documents()
    {
        return $this->hasMany(IssuancesDocument::class, 'office_id');
    }

    /**
     * Get the office type that this office belongs to.
     */
    public function officeType()
    {
        return $this->belongsTo(OfficeType::class, 'office_type_id');
    }

    /**
     * Scope a query to only include active offices.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
