<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'title',
        'authors',
        'year',
        'type',
        'abstract',
        'publisher',
        'venue',
        'volume',
        'number',
        'pages',
        'doi',
        'isbn',
        'issn',
        'gs_cluster_id',
        'article_link',
        'pdf_link',
        'citation_count',
        'keywords',
    ];

    protected $casts = [
        'year' => 'integer',
        'citation_count' => 'integer',
        'keywords' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function scholarProfile()
    {
        return $this->belongsTo(ScholarProfile::class, 'scholar_profile_id');
    }
}
