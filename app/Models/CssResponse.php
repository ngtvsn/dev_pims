<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CssResponse extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = [];
    protected $auditInclude = [
        'status_type_id',
        'date_transacted',
        'date_accomplished',
        'client_name',
        'contact_details',
        'sex_type_id',
        'client_group_id',
        'client_type_id',
        'specify_client_type',
        'region_id',
        'transacting_office_id',
        'availed_service_id',
        'other_service_availed',
        'awareness_response_id',
        'visibility_response_id',
        'helpfulness_response_id',
        'responsiveness_rate_id',
        'responsiveness_remarks',
        'reliability_rate_id',
        'reliability_remarks',
        'facility_access_rate_id',
        'facility_access_remarks',
        'communication_rate_id',
        'communication_remarks',
        'cost_rate_id',
        'cost_remarks',
        'integrity_rate_id',
        'integrity_remarks',
        'assurance_rate_id',
        'assurance_remarks',
        'outcome_rate_id',
        'outcome_remarks ',
        'overall_rate_id',
        'overall_remarks'
    ];

    public function sex_type()
    {
        return $this->belongsTo(SexType::class, 'sex_type_id')->orderBy('id', 'asc');
    }

    public function status_type()
    {
        return $this->belongsTo(StatusType::class, 'status_type_id')->orderBy('id', 'asc');
    }

    public function client_group()
    {
        return $this->belongsTo(ClientGroup::class, 'client_group_id')->orderBy('id', 'asc');
    }

    public function client_type()
    {
        return $this->belongsTo(ClientType::class, 'client_type_id')->orderBy('id', 'asc');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id')->orderBy('id', 'asc');
    }

    public function transacting_office()
    {
        return $this->belongsTo(TransactingOffice::class, 'transacting_office_id')->orderBy('id', 'asc');
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id')->orderBy('id', 'asc');
    }

    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id')->orderBy('id', 'asc');
    }

    public function availed_service()
    {
        return $this->belongsTo(AvailedService::class, 'availed_service_id')->orderBy('id', 'asc');
    }

    public function responsiveness_rate()
    {
        return $this->belongsTo(Rating::class, 'responsiveness_rate_id')->orderBy('id', 'asc');
    }

    public function reliability_rate()
    {
        return $this->belongsTo(Rating::class, 'reliability_rate_id')->orderBy('id', 'asc');
    }

    public function facility_access_rate()
    {
        return $this->belongsTo(Rating::class, 'facility_access_rate_id')->orderBy('id', 'asc');
    }

    public function communication_rate()
    {
        return $this->belongsTo(Rating::class, 'communication_rate_id')->orderBy('id', 'asc');
    }

    public function cost_rate()
    {
        return $this->belongsTo(Rating::class, 'cost_rate_id')->orderBy('id', 'asc');
    }

    public function integrity_rate()
    {
        return $this->belongsTo(Rating::class, 'integrity_rate_id')->orderBy('id', 'asc');
    }

    public function assurance_rate()
    {
        return $this->belongsTo(Rating::class, 'assurance_rate_id')->orderBy('id', 'asc');
    }

    public function outcome_rate()
    {
        return $this->belongsTo(Rating::class, 'outcome_rate_id')->orderBy('id', 'asc');
    }

    public function overall_rate()
    {
        return $this->belongsTo(Rating::class, 'overall_rate_id')->orderBy('id', 'asc');
    }

    public function awareness()
    {
        return $this->belongsTo(AwarenessResponse::class, 'awareness_response_id')->orderBy('id', 'asc');
    }

    public function visibility()
    {
        return $this->belongsTo(VisibilityResponse::class, 'visibility_response_id')->orderBy('id', 'asc');
    }

    public function helpfulness()
    {
        return $this->belongsTo(HelpfulnessResponse::class, 'helpfulness_response_id')->orderBy('id', 'asc');
    }
    
    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('client_name', 'like', $term)
                ->orWhere('contact_details', 'like', $term)
                ->orWhere('specify_client_type', 'like', $term)
                ->orWhere('other_service_availed', 'like', $term)
                ->orWhereHas('sex_type', function ($query) use ($term) {
                    $query->where('sex_type_name', 'like', $term);
                })
                ->orWhereHas('status_type', function ($query) use ($term) {
                    $query->where('status_type_name', 'like', $term);
                })
                ->orWhereHas('client_group', function ($query) use ($term) {
                    $query->where('client_group_name', 'like', $term);
                })
                ->orWhereHas('client_type', function ($query) use ($term) {
                    $query->where('client_type_name', 'like', $term);
                })
                ->orWhereHas('region', function ($query) use ($term) {
                    $query->where('region_name', 'like', $term);
                })
                ->orWhereHas('transacting_office', function ($query) use ($term) {
                    $query->where('transacting_office_name', 'like', $term);
                })
                ->orWhereHas('availed_service', function ($query) use ($term) {
                    $query->where('availed_service_name', 'like', $term);
                })
                ->orWhereHas('responsiveness_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('reliability_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('facility_access_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('communication_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('cost_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('integrity_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('assurance_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('outcome_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('overall_rate', function ($query) use ($term) {
                    $query->where('rating_name', 'like', $term);
                })
                ->orWhereHas('awareness', function ($query) use ($term) {
                    $query->where('awareness_response_name', 'like', $term);
                })
                ->orWhereHas('visibility', function ($query) use ($term) {
                    $query->where('visibility_response_name', 'like', $term);
                })
                ->orWhereHas('helpfulness', function ($query) use ($term) {
                    $query->where('helpfulness_response_name', 'like', $term);
                });
        });
    }
}
