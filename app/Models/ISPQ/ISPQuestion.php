<?php

namespace App\Models\ISPQ;

use Illuminate\Database\Eloquent\Model;

class ISPQuestion extends Model
{
    protected $table = 'i_s_p_questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'question_text',
        'question_type',
        'created_at',
        'updated_at',
    ];
    public function choices()
    {
        return $this->hasMany(ISPChoice::class, 'question_id', 'id');
    }
    public function answers()
    {
        return $this->hasMany(ISPAnswer::class, 'question_id', 'id');
    }
}
