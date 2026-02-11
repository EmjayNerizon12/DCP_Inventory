<?php

namespace App\Models\ISP;

use App\Models\ISP\ISPList;
use App\Models\ISPInfo\ISPInfo;
use App\Models\School;
use Illuminate\Database\Eloquent\Model;

class ISPDetails extends Model
{
    protected $table = "isp_details";
    protected $primaryKey = "pk_isp_details_id";
    protected $fillable = [
        'school_id', //FK
        'isp_list_id', //FK done
        'isp_purpose_id', //FK
        'isp_connection_type_id', //FK donr
        'isp_internet_quality_id', //FK Done
        'created_at',
        'updated_at'
    ];

    public function ispInfo()
    {
        return $this->hasMany(ISPInfo::class, 'school_internet_id', 'pk_isp_details_id');
    }
    public function ispList()
    {
        return $this->belongsTo(ISPList::class, 'isp_list_id', 'pk_isp_list_id');
    }
    public function ispConnectionType()
    {
        return $this->belongsTo(ISPConnectionType::class, 'isp_connection_type_id', 'pk_isp_connection_type_id');
    }
    public function ispInternetQuality()
    {
        return $this->belongsTo(ISPInternetQuality::class, 'isp_internet_quality_id', 'pk_isp_internet_quality_id');
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'pk_school_id');
    }
    public function ispAreaDetails()
    {
        return $this->hasMany(ISPAreaDetails::class, 'isp_details_id', 'pk_isp_details_id');
    }

    public function ispSpeedTest()
    {
        return $this->hasMany(ISPSpeedTest::class, 'isp_details_id', 'pk_isp_details_id');
    }
    public function ispPurpose()
    {
        return $this->belongsTo(ISPPurpose::class, 'isp_purpose_id', 'pk_isp_purpose_id');
    }
}
