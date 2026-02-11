<?php

namespace App\Models\SchoolEquipment;

use App\Models\DCPBatch;
use App\Models\DCPBatchItem;
use App\Models\NonDCPItem;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEquipment extends Model
{
    protected $table = 'school_equipment';
    protected $primaryKey = 'id';
    public $timestamps = true; // Set false if table doesn't have created_at/updated_at

    protected $fillable = [
        'property_number',
        'school_id',
        'old_property_number',
        'serial_number',
        'equipment_item_id',
        'unit_of_measure_id',
        'manufacturer_id',
        'dcp_batch_id',
        'dcp_batch_item_id',
        'non_dcp_item_id',
        'category_id',
        'classification_id',
        'mode_of_acquisition_id',
        'source_of_acquisition_id',
        'source_of_fund_id',
        'allotment_class_id',
        'model',
        'specifications',
        'non_dcp',
        'gl_sl_code',
        'uacs_code',
        'acquisition_cost',
        'acquisition_date',
        'estimated_useful_life',
        'donor',
        'pmp_reference_no',
        'supplier_or_distributor',
        'qr_code',
        'remarks',
    ];

    protected $casts = [
        'non_dcp' => 'boolean',
        'acquisition_date' => 'date',
        'acquisition_cost' => 'decimal:2',
    ];

    // Relationships
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'pk_school_id');
    }
    public function equipmentItem()
    {
        return $this->belongsTo(EquipmentItems::class, 'equipment_item_id', 'id');
    }

    public function unitOfMeasure()
    {
        return $this->belongsTo(SchoolEquipmentUnitOfMeasure::class, 'unit_of_measure_id', 'id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(SchoolEquipmentManufacturer::class, 'manufacturer_id', 'id');
    }

    public function dcpBatch()
    {
        return $this->belongsTo(DCPBatch::class, 'dcp_batch_id', 'pk_dcp_batches_id');
    }

    public function category()
    {
        return $this->belongsTo(SchoolEquipmentCategories::class, 'category_id', 'id');
    }

    public function classification()
    {
        return $this->belongsTo(SchoolEquipmentClassification::class, 'classification_id', 'id');
    }

    public function modeOfAcquisition()
    {
        return $this->belongsTo(SchoolEquipmentModeOfAcquisition::class, 'mode_of_acquisition_id', 'id');
    }

    public function sourceOfAcquisition()
    {
        return $this->belongsTo(SchoolEquipmentSourceOfAcquisition::class, 'source_of_acquisition_id', 'id');
    }

    public function sourceOfFund()
    {
        return $this->belongsTo(SchoolEquipmentSourceOfFund::class, 'source_of_fund_id', 'id');
    }

    public function allotmentClass()
    {
        return $this->belongsTo(SchoolEquipmentAllotmentClass::class, 'allotment_class_id', 'id');
    }
    public function equipmentStatuses()
    {
        return $this->hasMany(SchoolEquipmentStatus::class, 'school_equipment_id', 'id');
    }
    public function equipmentAccountability()
    {
        return $this->hasMany(SchoolEquipmentAccountabilty::class, 'school_equipment_id', 'id');
    }
    public function equipmentDocument()
    {
        return $this->hasMany(SchoolEquipmentDocument::class, 'school_equipment_id', 'id');
    }
    public function dcpBatchItem(){
        return $this->belongsTo(DCPBatchItem::class, 'dcp_batch_item_id', 'pk_dcp_batch_items_id');
    }
    public function nonDCPItem(){
        return $this->belongsTo(NonDCPItem::class, 'non_dcp_item_id', 'pk_non_dcp_item_id');
    }
}
