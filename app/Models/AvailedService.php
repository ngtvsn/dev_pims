<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailedService extends Model
{
    use HasFactory;

    public function status_type()
    {
        return $this->belongsTo(StatusType::class, 'status_type_id')->orderBy('id', 'asc');
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id')->orderBy('id', 'asc');
    }
    
    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id')->orderBy('id', 'asc');
    }
}
