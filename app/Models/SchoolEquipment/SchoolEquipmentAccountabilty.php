<?php

namespace App\Models\SchoolEquipment;

use App\Models\SchoolEmployee;
use Illuminate\Database\Eloquent\Model;

class SchoolEquipmentAccountabilty extends Model
{
    protected $table = 'school_equipment_accountabilties';
    protected $primaryKey = 'id';
    public $timestamps = true; // Set false if table doesn't have created_at/updated_at
    protected $fillable = [
        'transaction_type_id',
        'school_equipment_id',

        'accountable_employee_id',
        'date_assigned_to_accountable_employee',

        'custodian',
        'custodian_received_date',

        'end_user',
        'end_user_received_date',

        'created_at',
        'updated_at',
    ];

    public function accountableEmployee()
    {
        return $this->belongsTo(SchoolEmployee::class, 'accountable_employee_id', 'pk_schools_employee_id');
    }
    public function schoolEquipment()
    {
        return $this->belongsTo(SchoolEquipment::class, 'school_equipment_id', 'id');
    }
    public function transactionType()
    {
        return $this->belongsTo(SchoolEquipmentTransactionType::class, 'transaction_type_id', 'id');
    }
   public function equipmentCustodian()
    {
        return $this->belongsTo(SchoolEmployee::class, 'custodian', 'pk_schools_employee_id');
    } 
    public function equipmentEndUser()
    {
        return $this->belongsTo(SchoolEmployee::class, 'end_user', 'pk_schools_employee_id');
    }

}
