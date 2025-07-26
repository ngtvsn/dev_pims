<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuancesDocumentStatusType extends Model
{
    use HasFactory;

    protected $table = 'document_status_types';

    protected $fillable = [
        'documents_status_type_name',
        'description',
    ];

    /**
     * Get the documents that belong to this status type.
     */
    public function documents()
    {
        return $this->hasMany(IssuancesDocument::class, 'status_type_id');
    }
}