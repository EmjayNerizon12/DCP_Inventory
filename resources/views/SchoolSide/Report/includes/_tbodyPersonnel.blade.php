   <tr>
       <td class="td-cell">
           {{ Auth::guard('school')->user()->school->PrincipalName }}</td>
       {{-- <td class="td-cell"> {{ Auth::guard('school')->user()->school->PrincipalName  }}</td> --}}
       <td class="td-cell">
           {{ Auth::guard('school')->user()->school->PrincipalContact }}</td>
       <td class="td-cell"> School Head</td>
       {{-- <td class="td-cell"> {{ Auth::guard('school')->user()->last_login_at ? Auth::guard('school')->user()->last_login_at->format('F j, Y, g:i a') : 'Never' }}</td> --}}
   </tr>
   <tr>
       <td class="td-cell">
           {{ Auth::guard('school')->user()->school->ICTName }}</td>
       <td class="td-cell">
           {{ Auth::guard('school')->user()->school->ICTContact }}</td>
       <td class="td-cell"> ICT Coordinator</td>


   </tr>
   <tr>
       <td class="td-cell">
           {{ Auth::guard('school')->user()->school->CustodianName }}</td>
       <td class="td-cell">
           {{ Auth::guard('school')->user()->school->CustodianContact }}</td>
       <td class="td-cell"> Property Custodian</td>


   </tr>
