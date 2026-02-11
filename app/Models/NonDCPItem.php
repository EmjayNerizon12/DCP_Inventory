<?php

namespace App\Models;

use App\Models\SchoolEquipment\SchoolEquipment;
use Illuminate\Database\Eloquent\Model;

class NonDCPItem extends Model
{
    protected $table = 'non_dcp_item';
    protected $primaryKey = "pk_non_dcp_item_id";
    protected $fillable = [
        'school_id',
        'item_description',
        'total_item',
        'total_functional',
        'unit_price',
        'date_acquired',
        'fund_source_id',
        'item_holder_and_location',
        'remarks',
        'created_at',
        'updated_at'
    ];

    public function fund_source()
    {
        return $this->belongsTo(FundSource::class, 'fund_source_id', 'pk_fund_source_id');
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'pk_school_id');
    }
    public function schoolEquipment()
    {
        return $this->hasMany(SchoolEquipment::class, 'non_dcp_item_id', 'pk_non_dcp_item_id');
    }
}
