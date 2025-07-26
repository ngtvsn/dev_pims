<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuancesDocumentSubType extends Model
{
    use HasFactory;

    protected $table = 'document_sub_types';

    protected $fillable = [
        'document_type_id',
        'document_sub_type_name',
    ];

    public function documentType()
    {
        return $this->belongsTo(IssuancesDocumentType::class, 'document_type_id');
    }

    public function documents()
    {
        return $this->hasMany(IssuancesDocument::class, 'document_sub_type_id');
    }
}