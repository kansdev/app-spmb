<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentUpload extends Model
{
    use HasFactory;

    protected $table = 'document_upload';

    protected $fillable = ['user_id', 'type', 'file_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
