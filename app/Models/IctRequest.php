<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class IctRequest extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $guarded = [];
    protected $auditInclude = [
        'request_status_type_id',
        'ticket_no',
        'request_type_id',
        'sub_request_type_id',
        'request_details',
        'technical_support_representative_id',
        'technical_support_representative_findings',
        'reason_for_cancellation',
        'action_taken_datetime',
        'action_taken',
        'resolved_datetime',
        'cancelled_datetime',
        'acknowledged_datetime', 
        'created_by',
        'updated_by'
    ];

    public function request_status_type()
    {
        return $this->belongsTo(RequestStatusType::class, 'request_status_type_id')->orderBy('id', 'asc');
    }

    public function request_type()
    {
        return $this->belongsTo(RequestType::class, 'request_type_id')->orderBy('id', 'asc');
    }

    public function sub_request_type()
    {
        return $this->belongsTo(SubRequestType::class, 'sub_request_type_id')->orderBy('id', 'asc');
    }

    public function technical_support_representative()
    {
        return $this->belongsTo(User::class, 'technical_support_representative_id')->orderBy('id', 'asc');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'created_by')->orderBy('id', 'asc');
    }

    public function user_updated()
    {
        return $this->belongsTo(User::class, 'updated_by')->orderBy('id', 'asc');
    }

    public function scopeSearch($query, $term)
    {
        $terms = collect(explode(' ', strtolower($term)))->filter(); 
    
        $query->where(function ($query) use ($terms) {
            foreach ($terms as $term) {
                $term = "%$term%";
                $query->where(function ($query) use ($term) {
                    $query->whereRaw('LOWER(ticket_no) LIKE ?', [$term])
                    ->orWhereRaw('LOWER(request_details) LIKE ?', [$term])
                    ->orWhereRaw('LOWER(technical_support_representative_findings) LIKE ?', [$term])
                    ->orWhereRaw('LOWER(reason_for_cancellation) LIKE ?', [$term])
                    ->orWhereHas('request_status_type', function ($query) use ($term) {
                        $query->whereRaw('LOWER(request_status_type_name) LIKE ?', [$term]);
                    })
                    ->orWhereHas('request_type', function ($query) use ($term) {
                        $query->whereRaw('LOWER(request_type_name) LIKE ?', [$term]);
                    })
                    ->orWhereHas('sub_request_type', function ($query) use ($term) {
                        $query->whereRaw('LOWER(sub_request_type_name) LIKE ?', [$term]);
                    })
                    ->orWhereHas('user_created', function ($query) use ($term) {
                        $query->whereRaw('LOWER(last_name) LIKE ?', [$term])
                            ->orWhereRaw('LOWER(first_name) LIKE ?', [$term])
                            ->orWhereRaw('LOWER(email) LIKE ?', [$term]);
                    })
                    ->orWhereHas('user_updated', function ($query) use ($term) {
                        $query->whereRaw('LOWER(last_name) LIKE ?', [$term])
                            ->orWhereRaw('LOWER(first_name) LIKE ?', [$term])
                            ->orWhereRaw('LOWER(email) LIKE ?', [$term]);
                    });
                });
            }
        });
    }
}
