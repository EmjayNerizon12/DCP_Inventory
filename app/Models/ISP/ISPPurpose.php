<?php

namespace App\Models\ISP;

use Illuminate\Database\Eloquent\Model;

class ISPPurpose extends Model
{
    protected $table = "isp_purpose";
    protected $primaryKey = "pk_isp_purpose_id";
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
    public function ispDetails()
    {
        return $this->hasMany(ISPDetails::class, 'isp_purpose_id', 'pk_isp_purpose_id');
    }
}
