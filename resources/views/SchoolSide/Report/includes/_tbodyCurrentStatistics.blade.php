   <tr>
       <td colspan="2" class="sub-header">
           Total Classrooms:
       </td>
       <td colspan="2" class="td-cell text-base">
           @php
               $total_classrooms = App\Models\SchoolData::where(
                   'pk_school_id',
                   Auth::guard('school')->user()->school->pk_school_id,
               )->sum('Classrooms');
               echo $total_classrooms;
           @endphp
       </td>
       <td colspan="2" class="sub-header">
           Classrooms with Smart TV:
       </td>
       <td colspan="2" class="td-cell text-base">
           {{ Auth::guard('school')->user()->school->classroom_with_tv }}

       </td>
   </tr>
   <tr>
       <td colspan="2" class="sub-header text-base">
           Total Enrollment:
       </td>
       <td colspan="2" class="td-cell text-base"> @php
           $total_learners = App\Models\SchoolData::where(
               'pk_school_id',
               Auth::guard('school')->user()->school->pk_school_id,
           )->sum('RegisteredLearners');
           echo $total_learners;
       @endphp</td>
       <td colspan="2" class="sub-header text-base">
           Total Teachers:
       </td>
       <td colspan="2" class="td-cell text-base">
           @php
               $total_teachers = App\Models\SchoolData::where(
                   'pk_school_id',
                   Auth::guard('school')->user()->school->pk_school_id,
               )->sum('Teachers');
               echo $total_teachers;
           @endphp
       </td>
   </tr>
   <tr>
       <td colspan="2" class="sub-header text-base">
           Total Non-Teaching:
       </td>
       <td colspan="2" class="td-cell text-base">
           {{ Auth::guard('school')->user()->school->total_no_teaching }}

       </td>
       <td colspan="2" class="sub-header text-base">
           Smart TV Ratio:
       </td>
       <td colspan="2" class="td-cell text-base">
           @php

               $total_classrooms = App\Models\SchoolData::where(
                   'pk_school_id',
                   Auth::guard('school')->user()->school->pk_school_id,
               )->sum('Classrooms');

               if ($total_classrooms != 0) {
                   $smart_tv = Auth::guard('school')->user()->school->classroom_with_tv;
                   $ratio = ($smart_tv / $total_classrooms) * 100;
               } else {
                   $ratio = 0;
               }

           @endphp
           {{ number_format($ratio, 2) }}% of classrooms have Smart TVs

       </td>
   </tr>
