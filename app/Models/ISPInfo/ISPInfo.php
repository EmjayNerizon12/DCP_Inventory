<?php

namespace App\Models\ISPInfo;

use App\Models\ISP\ISPDetails;
use Illuminate\Database\Eloquent\Model;

class ISPInfo extends Model
{
    protected $table = 'i_s_p_infos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'school_internet_id', //FK
        'cost_per_month',
        'account_number',
        'description',
        'subscription_type',
        'contract_start',
        'contract_end',
        'inactive_contract',
        'active_isp_counter',
        'mode_of_acq_id', //FK
        'source_of_acq_id', //FK
        'donor',
        'source_of_fund_id', //FK
        'total_no_access_points',
        'active_counter1',
        'location_of_access_points',
        'total_admin_area_isps',
        'active_counter2',
        'admin_area_rate_id', //FK
        'total_classroom_isps',
        'active_counter3',
        'classroom_area_rate_id', //FK
        'rate',
        'created_at',
        'updated_at'
    ];

    public function sourceOfAcq()
    {
        return $this->belongsTo(ISPSourceOfAcq::class, 'source_of_acq_id', 'id');
    }
    public function sourceOfFund()
    {
        return $this->belongsTo(ISPSourceOfFund::class, 'source_of_fund_id', 'id');
    }
    public function modeOfAcq()
    {
        return $this->belongsTo(ISPModeOfAcq::class, 'mode_of_acq_id', 'id');
    }
    public function adminAreaRate()
    {
        return $this->belongsTo(ISPRating::class, 'admin_area_rate_id', 'id');
    }
    public function classroomAreaRate()
    {
        return $this->belongsTo(ISPRating::class, 'classroom_area_rate_id', 'id');
    }
    public function schoolInternet()
    {
        return $this->belongsTo(ISPDetails::class, 'school_internet_id', 'pk_isp_details_id');
    }
}
