<?php

namespace App\Models;

use App\Models\SchoolEquipment\SchoolEquipmentAccountabilty;
use Illuminate\Database\Eloquent\Model;

class SchoolEmployee extends Model
{
    protected $table = 'schools_employee';
    protected $primaryKey = 'pk_schools_employee_id';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'birthdate',
        'employee_number',
        'image_path',
        'position_title_id', //fk
        'salary_grade',
        'school_id',
        'sex',
        'deped_email',
        'deped_email_status',
        'm365_email_status',
        'canva_login_status',
        'lr_portal_status',
        'l4t_recipient',
        'smart_tv_recipient',
        'l4nt_recipient',
        'suffix_name',
        'ro_office_id', //fk
        'sdo_office_id', //fk
        'position_id', //fk
        'officer_in_charge',
        'mobile_no_1',
        'mobile_no_2',
        'personal_email_address',
        'date_hired',
        'inactive',
        'date_of_separation',
        'cause_of_separation_id', //fk
        'non_deped_fund',
        'sources_of_fund_id', //fk
        'detailed_transfer_from',
        'detailed_transfer_to',
        'created_at',
        'updated_at'
    ];
    public function positionTitle()
    {
        return $this->belongsTo(EmployeePosition::class, 'position_title_id', 'pk_school_position_id');
    }
    public function schoolOfEmployee()
    {
        return $this->belongsTo(School::class, 'school_id', 'pk_school_id');
    }
    public function roOffice()
    {
        return $this->belongsTo(EmpROOffice::class, 'ro_office_id', 'id');
    }
    public function sdoOffice()
    {
        return $this->belongsTo(EmpSDOOffice::class, 'sdo_office_id', 'id');
    }
    public function causeOfSeparation()
    {
        return $this->belongsTo(EmpCauseOfSeparation::class, 'cause_of_separation_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(EmpPosition::class, 'position_id', 'id');
    }
    public function sourceOfFund()
    {
        return $this->belongsTo(EmpSourceOfFund::class, 'sources_of_fund_id', 'id');
    }
    public function schoolEquipmentAccounbility(){
        return $this->hasMany(SchoolEquipmentAccountabilty::class, 'accountable_employee_id', 'pk_schools_employee_id');
    }
     public function schoolEquipmentCustoian(){
        return $this->hasMany(SchoolEquipmentAccountabilty::class, 'custodian', 'pk_schools_employee_id');
    }
     public function schoolEquipmentEndUser(){
        return $this->hasMany(SchoolEquipmentAccountabilty::class, 'end_user', 'pk_schools_employee_id');
    }
}
