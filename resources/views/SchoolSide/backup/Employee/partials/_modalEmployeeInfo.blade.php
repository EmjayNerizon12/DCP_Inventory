@include('SchoolSide.components.print')

<div class="modal hidden" id="show-employee-modal">
    <div class="modal-content extra-large-modal thin-scroll">
        <div class="flex flex-col items-center justify-center ">


            <div
                class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                <div class="text-white bg-[#16247B] p-2 rounded-full">
                    <svg class="w-10 h-10" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                        fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">

                            <g>
                                <path class="st0"
                                    d="M256.008,411.524c54.5,0,91.968-7.079,92.54-13.881c2.373-28.421-34.508-43.262-49.381-48.834 c-7.976-2.984-19.588-11.69-19.588-17.103c0-3.587,0-8.071,0-14.214c4.611-5.119,8.095-15.532,10.183-27.317 c4.857-1.738,7.627-4.524,11.095-16.65c3.69-12.93-5.548-12.5-5.548-12.5c7.468-24.715-2.357-47.944-18.825-46.246 c-11.358-19.857-49.397,4.54-61.31,2.841c0,6.818,2.834,11.92,2.834,11.92c-4.143,7.882-2.548,23.564-1.389,31.485 c-0.667,0-9.016,0.079-5.468,12.5c3.452,12.126,6.23,14.912,11.088,16.65c2.079,11.786,5.571,22.198,10.198,27.317 c0,6.143,0,10.627,0,14.214c0,5.413-12.35,14.548-19.611,17.103c-14.953,5.262-51.746,20.413-49.373,48.834 C164.024,404.444,201.491,411.524,256.008,411.524z">
                                </path>
                                <path class="st0"
                                    d="M404.976,56.889h-75.833v16.254c0,31.365-25.524,56.889-56.889,56.889h-32.508 c-31.366,0-56.889-25.524-56.889-56.889V56.889h-75.834c-25.444,0-46.071,20.627-46.071,46.071v362.969 c0,25.444,20.627,46.071,46.071,46.071h297.952c25.445,0,46.072-20.627,46.072-46.071V102.96 C451.048,77.516,430.421,56.889,404.976,56.889z M402.286,463.238H109.714V150.349h292.572V463.238z">
                                </path>
                                <path class="st0"
                                    d="M239.746,113.778h32.508c22.405,0,40.635-18.23,40.635-40.635V40.635C312.889,18.23,294.659,0,272.254,0 h-32.508c-22.406,0-40.635,18.23-40.635,40.635v32.508C199.111,95.547,217.341,113.778,239.746,113.778z M231.619,40.635 c0-4.492,3.634-8.127,8.127-8.127h32.508c4.492,0,8.127,3.635,8.127,8.127v16.254c0,4.492-3.635,8.127-8.127,8.127h-32.508 c-4.493,0-8.127-3.635-8.127-8.127V40.635z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="w-full flex flex-col justify-center w-full text-center">

                <div class="page-title">Employee Information</div>
                <div class="page-subtitle">Encode the information needed for the
                    employee</div>
            </div>
        </div>
        <div id="printableArea" class="w-full">
            @include('SchoolSide.components.print-header')

            <div id="employeeContainer" class="w-full"></div>
        </div>
    </div>
</div>

<script>
    function showInfoModal(emp) {
        console.log(emp);
        const modal = document.getElementById('show-employee-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        const container = document.getElementById('employeeContainer');
        let file_path = emp.image_path ?
            `/school-employee/${schoolId}-${schoolName}/${emp.image_path}` :
            '/icon/profile.png';
        container.innerHTML = '';
        container.innerHTML = `
        
        <table class="w-full tracking-wider table-auto border-collapse" id="employeeTable">
                       
                      <tr>
                        <td colspan="4"   
                            class="top-header text-base">
                            SCHOOL PERSONNEL DIGITAL IDENTITY
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"   
                            class="secondary-header text-base">
                            Basic Information
                        </td>
                    </tr>

                    <tr class="medium-text">
                        <td class="sub-header text-base">Name</td>
                        <td class="td-cell"  >
                            ${ emp.lname ?? '' }, ${ emp.fname ?? '' } ${ emp.mname ?? '' } ${ emp.suffix_name ?? '' }</td>
                        <td class="sub-header text-base"  rowspan="4">Employee Photo</td>
                            
                           <td class="td-cell" rowspan="4"  >
                            <div class="w-full h-full flex justify-center items-center">
                            <div class="shadow-md p-1 border border-gray-300 rounded-full">
                               <img class="md:w-40 md:h-40 h-20 w-20 rounded-full object-cover"
                                   src="${file_path}"
                                   alt="Profile Photo">
                           </div>
                           </div>
                                  </td>
                    </tr>   
                    


                    <tr class="medium-text">

                        <td class="sub-header text-base">Sex</td>
                        <td class="td-cell">${ emp.sex ?? '' }</td>
                        
                        </tr>
                        <tr class="medium-text">

                          <td class="sub-header text-base">Salary Grade</td>
                        <td class="td-cell">${ emp.salary_grade ?? '' }</td>
                             
                        </tr>
                        <tr class="medium-text">
                        <td class="sub-header text-base">Employee No.</td>
                            <td class="td-cell">${ emp.employee_number ?? '' }</td>
                           
                    </tr> 
                    <tr class="medium-text">
                        <td class="sub-header text-base">Birthdate</td>
                        <td class="td-cell">
                            ${formatDate(emp.birthdate)}</td>
                            <td class="sub-header text-base">Employee Title</td>
                        <td class="td-cell">${ emp.position_title?.name ?? '' }</td>
                       
                        </tr>

                    {{-- ===== LOGIN / EMAIL STATUS ===== --}}
                    <tr>
                        <td colspan="4"   
                            class="secondary-header text-base">
                            Login / Email Status
                        </td>
                    </tr>

                    <tr class="medium-text">

                        <td class="sub-header text-base">DepEd Email</td>
                        <td class="td-cell">${ emp.deped_email ?? '' }</td>
                        <td class="sub-header text-base">DepEd Email Status</td>
                        <td class="td-cell">${ emp.deped_email_status ?? '' }</td>
                          </tr>
                       <tr class="medium-text">

                         <td class="sub-header text-base">M365 Email Status</td>
                        <td class="td-cell">${ emp.m365_email_status ?? '' }</td>
                        <td class="sub-header text-base">L4NT Recipient</td>
                        <td class="td-cell">${ emp.l4nt_recipient ?? '' }</td>
                    </tr>

                    <tr class="medium-text">

                        <td class="sub-header text-base">Canva Login Status</td>
                        <td class="td-cell">${ emp.canva_login_status ?? '' }</td>
                        <td class="sub-header text-base">LR Portal Status</td>
                        <td class="td-cell">${ emp.lr_portal_status ?? '' }</td>
                        </tr>
                      <tr class="medium-text">

                        <td class="sub-header text-base">L4T Recipient</td>
                        <td class="td-cell">${ emp.l4t_recipient ?? '' }</td>
                        <td class="sub-header text-base">Smart TV Recipient</td>
                        <td class="td-cell">${ emp.smart_tv_recipient ?? '' }</td>
                    </tr>

                    {{-- ===== OFFICE / POSITION INFO ===== --}}
                    <tr>
                        <td colspan="4"   
                            class="secondary-header text-base">
                            Office / Position
                        </td>
                    </tr>

                    <tr class="medium-text">

                        <td class="sub-header text-base">Personal Email</td>
                        <td class="td-cell">${ emp.personal_email_address ?? '' }</td>
                        <td class="sub-header text-base">RO Office</td>
                        <td class="td-cell">${ emp.ro_office?.name ?? '' }</td>
                          </tr>
                <tr class="medium-text">

                          <td class="sub-header text-base">SDO Office</td>
                        <td class="td-cell">${ emp.sdo_office?.name ?? '' }</td>
                        <td rowspan="2" class="sub-header text-base">Officer in
                            Charge
                        </td>
                        <td rowspan="2" class="td-cell">
                            ${ emp.officer_in_charge ? 'Yes' : 'No' }</td>
                    </tr>
                    <tr class="medium-text">

                        <td class="sub-header text-base">Position</td>
                        <td class="td-cell"> ${ emp.position?.name ?? '' }</td>
                        
                        </tr>
                        <tr class="medium-text">
                            <td class="sub-header text-base">Mobile No 1</td>
                            <td class="td-cell">${ emp.mobile_no_1 ?? '' }</td>

                         <td class="sub-header text-base">Mobile No 2</td>
                        <td   class="td-cell">${ emp.mobile_no_2 ?? '' }</td>

                    </tr>

                    {{-- ===== EMPLOYMENT DATES / STATUS ===== --}}
                    <tr>
                        <td colspan="4"   
                            class="secondary-header text-base">
                            Employment Dates/Status
                        </td>
                    </tr>

                    <tr class="medium-text">

                        <td class="sub-header text-base">Date Hired</td>
                        <td class="td-cell">
                            ${formatDate(emp.date_hired)}</td>
                        <td class="sub-header text-base">Inactive</td>
                        <td class="td-cell">${ emp.inactive ? 'Yes': 'No' }</td>
             </tr>
                    <tr class="medium-text">

                          <td class="sub-header text-base">Date of Separation</td>
                        <td class="td-cell"> ${formatDate(emp.date_of_separation)}</td>
                        <td class="sub-header text-base">Cause of Separation</td>
                        <td class="td-cell"> ${ emp.cause_of_separation?.name }</td>
                    </tr>

                    {{-- ===== ACTION BUTTONS ===== --}}
                    <tr class="medium-text">

                        <td colspan="4">
                            <div class="button-container  mt-2 flex flex-row justify-start gap-2">

                                <div
                                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button title="Edit ISP" class="btn-update p-1 rounded-full"
                                        onclick='editModal(${JSON.stringify(emp)})'>
                                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="Edit / Edit_Pencil_Line_02">
                                                    <path id="Vector"
                                                        d="M4 20.0001H20M4 20.0001V16.0001L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L8 20.0001L4 20.0001Z"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div
                                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button type="button" title="Remove Employee"
                                        onclick="delete_employee('${emp.pk_schools_employee_id }')"
                                        class="btn-delete p-1 rounded-full">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div
                            class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                            <button class="theme-button p-1 rounded-full"
                                onclick="window.print()">
                                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17 7H7V6h10v1zm0 12H7v-6h10v6zm2-12V3H5v4H1v8.996C1 17.103 1.897 18 3.004 18H5v3h14v-3h1.996A2.004 2.004 0 0 0 23 15.996V7h-4z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                                 <div
                                    class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                    <button type="button" title="Close" class="btn-cancel p-1 rounded-full"
                                        onclick='closeEmployeeInfoModal()'>
                                       <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                 
                            </div>

                        </td>
                    </tr>

                  
            
            </table>
        `;
    }

    function formatDate(dateString) {
        if (!dateString) return 'N/A';

        const date = new Date(dateString);

        if (isNaN(date)) return 'Invalid Date';

        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    function closeEmployeeInfoModal() {

        document.getElementById("show-employee-modal").classList.add("hidden");
        document.body.classList.remove('overflow-hidden');
    }
</script>
