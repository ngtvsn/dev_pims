<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuancesDocumentLog extends Model
{
    use HasFactory;

    protected $table = 'document_logs';

    protected $fillable = [
        'document_id',
        'status_type_id',
        'action_id',
        'from_office_id',
        'to_office_id',
        'remarks',
        'created_by',
        'updated_by',
    ];

    public function document()
    {
        return $this->belongsTo(IssuancesDocument::class, 'document_id');
    }
}
