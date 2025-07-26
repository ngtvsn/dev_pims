<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuancesDocumentType extends Model
{
    use HasFactory;

    protected $table = 'document_types';

    protected $fillable = [
        'document_type_name',
    ];

    public function documents()
    {
        return $this->hasMany(IssuancesDocument::class, 'document_type_id');
    }

    public function documentSubTypes()
    {
        return $this->hasMany(IssuancesDocumentSubType::class, 'document_type_id');
    }
}