<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IssuancesDocument extends Model implements Auditable
{
    public function parentDocument()
    {
        return $this->belongsTo(IssuancesDocument::class, 'version_of_id');
    }

    public function versions()
    {
        return $this->hasMany(IssuancesDocument::class, 'version_of_id');
    }

    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'issuance_documents';

    protected $fillable = [
        'version_of_id',
        'status_type_id',
        'document_reference_code',
        'document_type_id',
        'document_sub_type_id',
        'document_title',
        'document_date',
        'description',
        'specify_attachments',
        'file_path',
        'original_filename',
        'office_id',
        'created_by',
        'updated_by',
        'issuance_deleted_by',
        'issuance_deletion_reason',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'issuance_deleted_at' => 'datetime',
    ];

    protected $dates = ['issuance_deleted_at'];
    
    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    const DELETED_AT = 'issuance_deleted_at';

    // Relationships
    public function documentType()
    {
        return $this->belongsTo(IssuancesDocumentType::class, 'document_type_id');
    }

    public function documentSubType()
    {
        return $this->belongsTo(IssuancesDocumentSubType::class, 'document_sub_type_id');
    }

    public function statusType()
    {
        return $this->belongsTo(IssuancesDocumentStatusType::class, 'status_type_id');
    }

    public function office()
    {
        return $this->belongsTo(TransactingOffice::class, 'office_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function documentLogs()
    {
        return $this->hasMany(IssuancesDocumentLog::class, 'document_id');
    }

    // Scopes
    public function scopeIssuances($query)
    {
        return $query->where('document_type_id', 10); // Issuances type
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status_type_id', [1, 2]); // Draft and Published status
    }

    // Accessors
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d, Y');
    }

    public function getClassificationBadgeAttribute()
    {
        $subType = $this->documentSubType?->document_sub_type_name ?? 'General';
        
        $badgeClasses = [
            'Memorandum' => 'badge-primary',
            'PITAHC Personnel Order' => 'badge-success', 
            'PITAHC Order' => 'badge-warning',
            'General' => 'badge-secondary'
        ];
        
        return $badgeClasses[$subType] ?? 'badge-secondary';
    }
}
