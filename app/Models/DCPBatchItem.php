<?php

namespace App\Models;

use App\Models\SchoolEquipment\SchoolEquipment;
use Illuminate\Database\Eloquent\Model;

class DCPBatchItem extends Model
{
    protected $table = 'dcp_batch_items';
    protected $primaryKey = 'pk_dcp_batch_items_id';
    protected $fillable = [
        'dcp_batch_id',
        'item_type_id',
        'generated_code',
        'unit_price',
        'quantity',
        'unit',
        'condition_id',
        'brand',
        'serial_number',
        'iar_ref_code',
        'iar_value',
        'iar_file',
        'iar_date',
        'itr_value',
        'itr_ref_code',
        'itr_file',
        'itr_date',
        'certificate_of_completion',
        'coc_status',
        'date_approved',
        'training_acceptance_status',
        'training_acceptance_file',
        'delivery_receipt_status',
        'delivery_receipt_file',
        'invoice_receipt_status',
        'invoice_receipt_file',
        'dcp_assigned_users',

    ];
    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity'   => 'integer',
    ];
    public function brand_details()
    {
        return $this->belongsTo(DCPBatchItemBrand::class, 'brand', 'pk_dcp_batch_item_brands_id');
    }
    public function dcpBatch()
    {
        return $this->belongsTo(DCPBatch::class, 'dcp_batch_id', 'pk_dcp_batches_id');
    }

    public function dcpItemType()
    {
        return $this->belongsTo(DCPItemTypes::class, 'item_type_id', 'pk_dcp_item_types_id');
    }

    public function dcpCondition()
    {
        return $this->belongsTo(DCPDeliveryCondintion::class, 'condition_id', 'pk_dcp_delivery_conditions_id');
    }

    public function dcpAssignedUsers()
    {
        return $this->hasOne(DCPItemAssignedUser::class, 'dcp_batch_item_id', 'pk_dcp_batch_items_id');
    }


    public function dcpBatchItemLocation()
    {
        return $this->hasOne(DCPItemAssignedLocation::class, 'dcp_batch_item_id', 'pk_dcp_batch_items_id');
    }
    public function dcpItemWarranties()
    {
        return $this->hasOne(DCPItemWarrantyStatus::class, 'dcp_batch_item_id', 'pk_dcp_batch_items_id');
    }
    public function dcpItemCurrentCondition()
    {
        return $this->hasOne(DCPItemCondition::class, 'dcp_batch_item_id', 'pk_dcp_batch_items_id');
    }
    public function schoolEquipment(){
        return $this->hasMany(SchoolEquipment::class, 'dcp_batch_item_id', 'pk_dcp_batch_items_id');
    }
}
