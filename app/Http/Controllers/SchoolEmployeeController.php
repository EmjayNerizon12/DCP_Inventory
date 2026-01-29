<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SchoolEmployeeController extends Controller
{
    public function index()
    {
        $employee = SchoolEmployee::where('school_id', Auth::guard('school')->user()->pk_school_id)
            ->with(['position', 'positionTitle', 'sdoOffice', 'roOffice', 'causeOfSeparation'])
            ->get();

        return view('SchoolSide.Employee.index', compact('employee'));
    }

    public function showSchoolEmployees()
    {
        $employee = SchoolEmployee::where('school_id', Auth::guard('school')->user()->pk_school_id)
            ->with(['position', 'positionTitle', 'sdoOffice', 'roOffice', 'causeOfSeparation'])
            ->get();
        return response()->json(['success' => true, 'data' => $employee]);
    }
    public function searchEmployee($searchTerm = null)
    {
        if (empty($searchTerm)) {
            return $this->showSchoolEmployees();
        } else {
            $employee = SchoolEmployee::where('school_id', Auth::guard('school')->user()->pk_school_id)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('fname', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('mname', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('lname', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('employee_number', 'LIKE', "%{$searchTerm}%");
                })
                ->with(['position', 'positionTitle', 'sdoOffice', 'roOffice', 'causeOfSeparation'])
                ->get();
            return response()->json(['success' => true, 'data' => $employee]);
        }
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255', //REQUIRED TO CHECK
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255', //REQUIRED TO CHECK
            'suffix_name' => 'nullable|string|max:50',
            'birthdate' => 'required|date', //REQUIRED TO CHECK
            'employee_number' => 'required|string|max:50|unique:schools_employee,employee_number', //REQUIRED TO CHECK
            'position_title_id' => 'required|integer', //REQUIRED TO CHECK
            'position_id' => 'nullable|integer',
            'salary_grade' => 'required|integer', //REQUIRED TO CHECK
            'school_id' => 'nullable|integer',
            'sex' => 'required|string', //REQUIRED TO CHECK
            'deped_email' => 'required|email|unique:schools_employee,deped_email', //REQUIRED TO CHECK
            'deped_email_status' => 'required|string', //REQUIRED TO CHECK
            'm365_email_status' => 'required|string', //REQUIRED TO CHECK
            'canva_login_status' => 'required|string', //REQUIRED TO CHECK
            'lr_portal_status' => 'required|string', //REQUIRED TO CHECK
            'l4t_recipient' => 'required|string', //REQUIRED TO CHECK
            'smart_tv_recipient' => 'required|string', //REQUIRED TO CHECK
            'l4nt_recipient' => 'required|string', //REQUIRED TO CHECK
            'ro_office_id' => 'nullable|integer',
            'sdo_office_id' => 'nullable|integer',
            'sources_of_fund_id' => 'nullable|integer',
            'position_id' => 'nullable|integer',
            'officer_in_charge' => 'nullable|boolean',
            'mobile_no_1' => 'nullable|string|max:20',
            'mobile_no_2' => 'nullable|string|max:20',
            'personal_email_address' => 'nullable|email',
            'date_hired' => 'nullable|date',
            'inactive' => 'required|boolean', //REQUIRED TO CHECK
            'date_of_separation' => 'nullable|date',
            'cause_of_separation_id' => 'nullable|string|max:255',
            'non_deped_fund' => 'nullable|string|max:255',
            'detailed_transfer_from' => 'nullable|string|max:255',
            'detailed_transfer_to' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = uniqid('employee_') . '.' . $image->getClientOriginalExtension();
            $school = School::findOrFail($validated['school_id']);
            $schoolName = Str::slug($school->SchoolName, '_');
            $path = public_path('school-employee/' . $validated['school_id'] . '-' . $schoolName);
            if (!file_exists($path)) {
                mkdir($path, 0755, true); // recursive = true
            }
            $image->move($path, $imageName);
            $validated['image_path'] = $imageName;
        } else {
            $validated['image_path'] = null;
        }
        // Assign school_id from authenticated user
        $validated['school_id'] = Auth::guard('school')->user()->pk_school_id;

        $employee = SchoolEmployee::create($validated);

        if ($employee) {
            return back()->with('success', 'Employee added successfully.');
        } else {
            return back()->with('error', 'Failed to add employee. Please try again.');
        }
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'primary_key' => 'required|integer',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix_name' => 'nullable|string|max:50',
            'birthdate' => 'required|date',
            'employee_number' => 'required|string|max:50|unique:schools_employee,employee_number,' . $request->primary_key . ',pk_schools_employee_id',
            'position_title_id' => 'required|integer',
            'position_id' => 'nullable|integer',
            'salary_grade' => 'required|integer',
            'school_id' => 'nullable|integer',
            'sex' => 'required|string',
            'deped_email' => 'required|email|unique:schools_employee,deped_email,' . $request->primary_key . ',pk_schools_employee_id',
            'deped_email_status' => 'required|string',
            'm365_email_status' => 'required|string',
            'canva_login_status' => 'required|string',
            'lr_portal_status' => 'required|string',
            'l4t_recipient' => 'required|string',
            'smart_tv_recipient' => 'required|string',
            'l4nt_recipient' => 'required|string',
            'ro_office_id' => 'nullable|integer',
            'sdo_office_id' => 'nullable|integer',
            'sources_of_fund_id' => 'nullable|integer',
            'officer_in_charge' => 'nullable|boolean',
            'mobile_no_1' => 'nullable|string|max:20',
            'mobile_no_2' => 'nullable|string|max:20',
            'personal_email_address' => 'nullable|email',
            'date_hired' => 'nullable|date',
            'inactive' => 'nullable|boolean',
            'date_of_separation' => 'nullable|date',
            'cause_of_separation_id' => 'nullable|integer',
            'non_deped_fund' => 'nullable|string|max:255',
            'detailed_transfer_from' => 'nullable|string|max:255',
            'detailed_transfer_to' => 'nullable|string|max:255',
        ]);

        $employee = SchoolEmployee::findOrFail($validated['primary_key']);
        $school_id = Auth::guard('school')->user()->school->pk_school_id;
        $school = School::findOrFail($school_id);
        $schoolName = Str::slug($school->SchoolName, '_');

        if ($request->hasFile('image_path')) {

            // 🔴 DELETE OLD IMAGE (if exists)
            if ($employee->image_path) {

                $oldPath = public_path(
                    'school-employee/' . $validated['school_id'] . '-' . $schoolName . '/' . $employee->image_path
                );

                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // ✅ UPLOAD NEW IMAGE
            $image = $request->file('image_path');
            $imageName = uniqid('employee_') . '.' . $image->getClientOriginalExtension();

            $path = public_path(
                'school-employee/' . $school_id . '-' . $schoolName
            );

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $image->move($path, $imageName);

            $validated['image_path'] = $imageName;
        }
        if ($employee) {
            // Remove primary_key before updating
            unset($validated['primary_key']);
            $employee->update($validated);
            return back()->with('success', 'Employee updated successfully.');
        } else {
            return back()->with('error', 'Failed to update employee. Please try again.');
        }
    }

    public function get_data()
    {
        $school_id = Auth::guard('school')->user()->school->pk_school_id;
        $active_deped_email = SchoolEmployee::where('school_id', $school_id)
            ->where('deped_email_status', 'Active')->count();
        $inactive_deped_email = SchoolEmployee::where('school_id', $school_id)
            ->where('deped_email_status', 'Inctive')->count();
        $m365_email_status_active = SchoolEmployee::where('school_id', $school_id)
            ->where('m365_email_status', 'Active')->count();
        $m365_email_status_inactive = SchoolEmployee::where('school_id', $school_id)
            ->where('m365_email_status', 'Inactive')->count();
        $canva_login_status_active = SchoolEmployee::where('school_id', $school_id)
            ->where('canva_login_status', 'Active')->count();
        $canva_login_status_inactive = SchoolEmployee::where('school_id', $school_id)
            ->where('canva_login_status', 'Inactive')->count();
        $lr_portal_status_active = SchoolEmployee::where('school_id', $school_id)
            ->where('lr_portal_status', 'Active')->count();
        $lr_portal_status_iactive = SchoolEmployee::where('school_id', $school_id)
            ->where('lr_portal_status', 'Inactive')->count();
        $l4t_recipient = SchoolEmployee::where('school_id', $school_id)
            ->where('l4t_recipient', 'Yes')->count();
        $smart_tv_recipient = SchoolEmployee::where('school_id', $school_id)
            ->where('smart_tv_recipient', 'Yes')->count();
        $l4nt_recipient = SchoolEmployee::where('school_id', $school_id)
            ->where('l4nt_recipient', 'Yes')->count();
        $employees = SchoolEmployee::where('school_id', $school_id)->count();
        return response()->json([
            'active_deped_email' => $active_deped_email,
            'inactive_deped_email' => $inactive_deped_email,
            'm365_email_status_active' => $m365_email_status_active,
            'm365_email_status_inactive' => $m365_email_status_inactive,
            'canva_login_status_active' => $canva_login_status_active,
            'canva_login_status_inactive' => $canva_login_status_inactive,
            'lr_portal_status_active' => $lr_portal_status_active,
            'lr_portal_status_iactive' => $lr_portal_status_iactive,
            'l4t_recipient' => $l4t_recipient,
            'smart_tv_recipient' => $smart_tv_recipient,
            'l4nt_recipient' => $l4nt_recipient,
            'employees' => $employees,
        ]);
    }
    public function destroy($id)
    {
        $employee = SchoolEmployee::findOrFail($id);
        $employee->delete();
        return response()->json([
            'success' => true,
            'message' => 'Employee Information removed successfully!',
        ]);
    }
}
