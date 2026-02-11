<?php

namespace App\Models\ISP;

use Illuminate\Database\Eloquent\Model;

class ISPAreaDetails extends Model
{
    protected $table = "isp_area_details";
    protected $primaryKey = "pk_isp_area_details_id";
    protected $fillable = [
        'isp_details_id', //FK CHECK
        'isp_area_available_id', //FK CHECK
        'created_at',
        'updated_at'
    ];
    public function ispDetails()
    {
        return $this->belongsTo(ISPDetails::class, 'isp_details_id', 'pk_isp_details_id');
    }
    public function ispAreaAvailable()
    {
        return $this->belongsTo(ISPAreaAvailable::class, 'isp_area_available_id', 'pk_isp_area_available_id');
    }
}
