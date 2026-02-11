<script>
    const employeeContainer = document.getElementById('employeeTable');
    const spinnerContainer = document.getElementById('spinner-container');
    const schoolId = document.getElementById('school_id').value;
    const schoolName = document.getElementById('school_name').value;

    async function searchEmployee() {
        const searchTerm = document.getElementById('searchTerm').value;

        spinnerContainer.classList.remove('hidden');
        employeeContainer.classList.add('hidden');
        const response = await fetch(`search-school-employee-list/${searchTerm}`);
        const res = await response.json();

        await getEmployeeList(res.data);
        // searchButton.innerHTML = `Search`;
        spinnerContainer.classList.add('hidden');
        employeeContainer.classList.remove('hidden');
    }
    async function getEmployeeList(data) {
        const container = document.getElementById('employeeTable');
        container.classList.add('tracking-wider');
        container.innerHTML = '';
        const employeeCard = document.createElement('div');

        const tableEmployee = document.createElement('table');
        tableEmployee.classList.add('w-full', 'my-4');
        const thead = document.createElement('thead');
        thead.innerHTML = ` <tr>
                            <td class="top-header  border border-gray-800" colspan="6">
                              Employee Identity
                            </td>
                        </tr>
                        <tr>
                             
                            <td class="sub-header text-center w-5">No.</td>
                            <td class="sub-header text-center">Employee No.</td>
                            <td class="sub-header">Employee Name</td>
                            <td class="sub-header">Title</td>
                            <td class="sub-header">Position</td>
                            <td class="sub-header text-center">Details</td>
                        </tr>`;
        const tbody = document.createElement('tbody');
        if (data.length == 0) {
            tbody.innerHTML = `
            <tr>
                <td class="td-cell text-center" colspan="6">No Data Found</td>
            </tr>
            `
        }
        data.forEach((item, index) => {
            tbody.innerHTML += `
                

                        <!-- ===== HEADER ===== -->



                       
                        <tr>
                           
                            <td class="td-cell max-w-xs tracking-wider text-center">
                               ${index + 1} 

                            </td>
                            <td class="td-cell font-bold text-center tracking-wider">
                               ${item.employee_number ?? '' } 

                            </td>


                            <!-- Name -->
                            <td class="td-cell">
                                ${item.lname ?? '' }, 
                                ${item.fname ?? '' }
                                ${item.mname ?? '' }
                                ${item.suffix_name ?? '' }

                            </td>

                            <!-- Position Title -->
                            <td class="td-cell">
                                ${item.position_title?.name ?? 'No Title Yet' }

                            </td>

                            <!-- Position -->
                            <td class="td-cell">

                                ${item.position?.name ?? 'No Position Yet' }

                            </td>
                          
                            <td class="td-cell">
                                <div class=" flex justify-center items-center w-full">



                                    <div
                                        class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                                        <button onclick='showInfoModal(${JSON.stringify(item)})' type="button" title="Show Info Modal"
                                            class="btn-submit p-1 rounded-full">

                                            <!-- SVG UNTOUCHED -->
                                            <svg class="w-8 h-8" viewBox="-102.4 -102.4 1228.80 1228.80" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill="currentColor"
                                                        d="M288 320a224 224 0 1 0 448 0 224 224 0 1 0-448 0zm544 608H160a32 32 0 0 1-32-32v-96a160 160 0 0 1 160-160h448a160 160 0 0 1 160 160v96a32 32 0 0 1-32 32z">
                                                    </path>
                                                </g>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </td>

                        </tr>

                    
                `;





            let file_path = item.image_path ?
                `/school-employee/${schoolId}-${schoolName}/${item.image_path}` :
                '/icon/profile.png';
            employeeCard.innerHTML +=

                `
             <div class="border border-gray-400 p-6 my-4">

               <div class="cursor-pointer  flex flex-col justify-center text-center 
                                 cursor-pointer text-center relative
                                  ">

                     <div class="grid w-full  grid-cols-2 gap-0">
                         <div class="text-base text-left   font-medium tracking-wider  ">
                            ${index + 1}.
                         </div>

                         <div class="flex  justify-end ">

                             <button class="btn-submit w-auto px-2 rounded py-0 font-normal text-base hover:bg-blue-600">
                                 ${item.employee_number ?? '' } 
                             </button>
                         </div>
                     </div>



                     <div class="mb-2 flex justify-start items-center gap-4 md:my-0 my-4">

                         <div class="shadow-md md:w-42 md:h-42 h-22 w-22 p-1 border border-gray-300 rounded-full">
                             <img class="md:w-40 md:h-40 h-20 w-20 rounded-full object-cover"
                                 src="${file_path}"
                                 alt="Profile Photo">
                         </div>
                         <div>
                            <div class="md:text-base text-xs font-medium">
                               ${item.deped_email ?? '' }
                           </div>
                         <div class="md:text-2xl text-sm font-bold uppercase">
                                ${item.lname ?? '' }, 
                                ${item.fname ?? '' }
                                
                                ${item.mname ?? '' }
                                ${item.suffix_name ?? '' }
                         </div>
                         <div class="md:text-base text-xs">
                            ${item.position_title?.name ?? 'No Title Yet' }
                        </div>
                        <div class="md:text-base text-xs">
                            ${item.position?.name ?? 'No Position Yet' }
                        </div>
                          <div class=" flex justify-center items-center w-full">



                            <div
                                class="md:h-12 h-10 w-auto bg-white mt-2 p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                                <button onclick='showInfoModal(${JSON.stringify(item)})' type="button" title="Show Info Modal"
                                    class="btn-submit md:text-base text-xs px-4 py-1 rounded-full">

                                    <!-- SVG UNTOUCHED -->
                                 Full Details

                                </button>
                            </div>
                        </div>
                        </div>
                     </div>
                 </div>
                 </div>
           
                 `;


        });
        if (data.length == 0) {
            employeeCard.innerHTML = `<div class="text-center text-gray-500 text-lg">No Data Found</div>`
        }
        tableEmployee.appendChild(thead);
        tableEmployee.appendChild(tbody);

        container.appendChild(employeeCard);
    }



    function delete_employee(id) {
        if (confirm("Are you sure you want to delete this record?")) {
            fetch('/School/Employee/delete/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Record deleted successfully!');
                        location.reload();
                    } else {
                        alert('Failed to delete record.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function openModal() {
        const modal = document.getElementById('add-employee-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

    }

    function closeModal() {
        const modal = document.getElementById('add-employee-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

    }

    function closeEditModal() {
        const modal = document.getElementById('edit-employee-modal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function editModal(emp) {
        const modal = document.getElementById('edit-employee-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.getElementById('show-employee-modal').classList.add('hidden');
        document.getElementById('employee_id').value = emp.pk_schools_employee_id;
        document.getElementById('fname').value = emp.fname;
        document.getElementById('mname').value = emp.mname;
        document.getElementById('lname').value = emp.lname;
        document.getElementById('suffix_name').value = emp.suffix_name;
        document.getElementById('sex').value = emp.sex;
        document.getElementById('birthdate').value = emp.birthdate;
        document.getElementById('employee_number').value = emp.employee_number;
        document.getElementById('position_title_id').value = emp.position_title_id;
        document.getElementById('ro_office_id').value = emp.ro_office_id;
        document.getElementById('sdo_office_id').value = emp.sdo_office_id;
        document.getElementById('position_id').value = emp.position_id;
        document.getElementById('salary_grade').value = emp.salary_grade;
        document.getElementById('deped_email').value = emp.deped_email;
        document.getElementById('deped_email_status').value = emp.deped_email_status;
        document.getElementById('m365_email_status').value = emp.m365_email_status;
        document.getElementById('canva_login_status').value = emp.canva_login_status;
        document.getElementById('lr_portal_status').value = emp.lr_portal_status;
        document.getElementById('l4t_recipient').value = emp.l4t_recipient;
        document.getElementById('smart_tv_recipient').value = emp.smart_tv_recipient;
        document.getElementById('l4nt_recipient').value = emp.l4nt_recipient;
        document.getElementById('officer_in_charge').value = emp.officer_in_charge ? 1 : 0;
        document.getElementById('mobile_no_1').value = emp.mobile_no_1;
        document.getElementById('mobile_no_2').value = emp.mobile_no_2;
        document.getElementById('personal_email_address').value = emp.personal_email_address;
        document.getElementById('date_hired').value = emp.date_hired;
        document.getElementById('inactive').value = emp.inactive ? 1 : 0;
        document.getElementById('date_of_separation').value = emp.date_of_separation;
        document.getElementById('cause_of_separation_id').value = emp.cause_of_separation_id;
        document.getElementById('non_deped_fund').value = emp.non_deped_fund;
        document.getElementById('sources_of_fund_id').value = emp.sources_of_fund_id;
        document.getElementById('detailed_transfer_from').value = emp.detailed_transfer_from;
        document.getElementById('detailed_transfer_to').value = emp.detailed_transfer_to;
        if (emp.image_path) {
            document.getElementById('editSchoolPreview').src =
                `/school-employee/${schoolId}-${schoolName}/${emp.image_path}`;
            originalSrcEdit = document.getElementById('editSchoolPreview').src;
        } else {
            document.getElementById('editSchoolPreview').src =
                `/icon/profile.png`;
            originalSrcEdit = document.getElementById('editSchoolPreview').src;
        }

    }
    async function loadCards() {
        try {
            const cardContainer = document.getElementById("card-container");
            const cardSpinner = document.getElementById("card-spinner");

            const response = await fetch('get-data');
            const data = await response.json();


            const items = [{
                    key: "active_deped_email",
                    label: "Active DepEd Email",
                    color: "bg-green-500",
                    icon: `<svg viewBox="0 0 24 24"  class="md:h-10 md:w-10 h-6 w-6"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12ZM16 12V13.5C16 14.8807 17.1193 16 18.5 16V16C19.8807 16 21 14.8807 21 13.5V12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>`
                },
                {
                    key: "inactive_deped_email",
                    label: "Inactive DepEd Email",
                    color: "bg-red-500",
                    icon: `<svg viewBox="0 0 24 24"  class="md:h-10 md:w-10 h-6 w-6"  fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12ZM16 12V13.5C16 14.8807 17.1193 16 18.5 16V16C19.8807 16 21 14.8807 21 13.5V12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21H16" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>`

                },
                {
                    key: "m365_email_status_active",
                    label: "M365 Active",
                    color: "bg-green-500",
                    icon: `<svg viewBox="0 0 24 24"  class="md:h-10 md:w-10 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>microsoft_windows</title> <rect width="24" height="24" fill="none"></rect> <path d="M3,12V6.75L9,5.43v6.48L3,12M20,3v8.75L10,11.9V5.21L20,3M3,13l6,.09V19.9L3,18.75V13m17,.25V22L10,20.09v-7Z"></path> </g></svg>`
                },
                {
                    key: "m365_email_status_inactive",
                    label: "M365 Inactive",
                    color: "bg-red-500",
                    icon: `<svg viewBox="0 0 24 24"  class="md:h-10 md:w-10 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>microsoft_windows</title> <rect width="24" height="24" fill="none"></rect> <path d="M3,12V6.75L9,5.43v6.48L3,12M20,3v8.75L10,11.9V5.21L20,3M3,13l6,.09V19.9L3,18.75V13m17,.25V22L10,20.09v-7Z"></path> </g></svg>`

                },
                {
                    key: "canva_login_status_active",
                    label: "Canva Active",
                    color: "bg-green-500",
                    icon: `<svg viewBox="0 0 192 192"  class="md:h-10 md:w-10 h-6 w-6" xmlns="http://www.w3.org/2000/svg" style="enable-background:new 0 0 192 192" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M95.2 170c-11.6 0-22-3.1-30.9-9.1-8.8-6-15.4-14.6-19.7-25.6-2.5-6.4-4-13.4-4.7-21.4-.8-9.5-.2-19.2 1.9-28.7 3.3-15.3 10-28.5 19.8-39.5 9.7-10.8 21.2-18.1 34.3-21.5 5.6-1.5 11.2-2.2 16.5-2.2 6.4 0 12.7 1.1 18.7 3.3 8.9 3.3 15 9 17.9 17 1.4 3.7 1.8 7.6 1.4 12-.6 6.2-2.6 11.7-6 16.4-3.9 5.4-8.6 8.7-14.3 10.1-1 .3-2.1.4-3.3.4-.5 0-.9 0-1.4-.1-1.7-.2-3.2-.9-4.2-2.2-1-1.3-1.4-3-1.2-4.7.3-2 1.1-3.7 1.9-5.1l.3-.6c1.6-3.2 3.1-6.2 3.9-9.4 1.3-5.4 1.3-9.5-.1-13.3-1.5-4-4.3-6.5-8.5-7.5-1.6-.4-3.2-.6-4.8-.6-3.6 0-7.4.9-11.4 2.7C93.4 44 86.7 50 81 58.7c-3.9 6-6.9 12.7-9.1 20.5-1.6 5.6-2.6 11.5-3.2 17.6-.3 2.9-.5 6.3-.5 9.6.1 9.7 1.5 17.4 4.5 24.2 3.3 7.6 7.8 12.9 13.9 16.3 4.1 2.3 8.7 3.5 13.6 3.5.8 0 1.7 0 2.6-.1 10.4-.8 19.6-5.5 28-14.3 4.3-4.5 7.9-9.7 11-15.9.5-.9 1-1.9 1.8-2.7 1-1.1 2.3-1.7 3.7-1.7 1.7 0 3.2.9 4.2 2.5 1.2 2 1.1 4.2.9 5.6-.6 4.1-2.1 8.1-4.6 12.8-7.2 12.9-17.1 22.4-29.4 28.3-6.3 3-13.1 4.7-20.1 5-1.1.1-2.1.1-3.1.1z" style="fill:none;stroke:#ffffff;stroke-width:12;stroke-linejoin:round;stroke-miterlimit:10"></path></g></svg>`
                },
                {
                    key: "canva_login_status_inactive",
                    label: "Canva Inactive",
                    color: "bg-red-500",
                    icon: `<svg viewBox="0 0 192 192"  class="md:h-10 md:w-10 h-6 w-6" xmlns="http://www.w3.org/2000/svg" style="enable-background:new 0 0 192 192" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M95.2 170c-11.6 0-22-3.1-30.9-9.1-8.8-6-15.4-14.6-19.7-25.6-2.5-6.4-4-13.4-4.7-21.4-.8-9.5-.2-19.2 1.9-28.7 3.3-15.3 10-28.5 19.8-39.5 9.7-10.8 21.2-18.1 34.3-21.5 5.6-1.5 11.2-2.2 16.5-2.2 6.4 0 12.7 1.1 18.7 3.3 8.9 3.3 15 9 17.9 17 1.4 3.7 1.8 7.6 1.4 12-.6 6.2-2.6 11.7-6 16.4-3.9 5.4-8.6 8.7-14.3 10.1-1 .3-2.1.4-3.3.4-.5 0-.9 0-1.4-.1-1.7-.2-3.2-.9-4.2-2.2-1-1.3-1.4-3-1.2-4.7.3-2 1.1-3.7 1.9-5.1l.3-.6c1.6-3.2 3.1-6.2 3.9-9.4 1.3-5.4 1.3-9.5-.1-13.3-1.5-4-4.3-6.5-8.5-7.5-1.6-.4-3.2-.6-4.8-.6-3.6 0-7.4.9-11.4 2.7C93.4 44 86.7 50 81 58.7c-3.9 6-6.9 12.7-9.1 20.5-1.6 5.6-2.6 11.5-3.2 17.6-.3 2.9-.5 6.3-.5 9.6.1 9.7 1.5 17.4 4.5 24.2 3.3 7.6 7.8 12.9 13.9 16.3 4.1 2.3 8.7 3.5 13.6 3.5.8 0 1.7 0 2.6-.1 10.4-.8 19.6-5.5 28-14.3 4.3-4.5 7.9-9.7 11-15.9.5-.9 1-1.9 1.8-2.7 1-1.1 2.3-1.7 3.7-1.7 1.7 0 3.2.9 4.2 2.5 1.2 2 1.1 4.2.9 5.6-.6 4.1-2.1 8.1-4.6 12.8-7.2 12.9-17.1 22.4-29.4 28.3-6.3 3-13.1 4.7-20.1 5-1.1.1-2.1.1-3.1.1z" style="fill:none;stroke:#ffffff;stroke-width:12;stroke-linejoin:round;stroke-miterlimit:10"></path></g></svg>`

                },
                {
                    key: "lr_portal_status_active",
                    label: "LR Portal Active",
                    color: "bg-green-500",
                    icon: `<svg xmlns="http://www.w3.org/2000/svg"  class="md:h-10 md:w-10 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
               </svg>`
                },
                {
                    key: "lr_portal_status_iactive",
                    label: "LR Portal Inactive",
                    color: "bg-red-500",
                    icon: `<svg xmlns="http://www.w3.org/2000/svg"  class="md:h-10 md:w-10 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
               </svg>`
                },
                {
                    key: "l4t_recipient",
                    label: "L4T Recipient",
                    color: "bg-blue-500",
                    icon: `<svg viewBox="0 0 24 24"  class="md:h-10 md:w-10 h-6 w-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V16H23V17V18C23 19.6569 21.6569 21 20 21H4C2.34315 21 1 19.6569 1 18V17V16H2V6ZM20 6V16H4V6C4 5.44772 4.44772 5 5 5H19C19.5523 5 20 5.44772 20 6ZM4 19C3.44772 19 3 18.5523 3 18H21C21 18.5523 20.5523 19 20 19H4ZM5.5 6C5.22386 6 5 6.22386 5 6.5V14.5C5 14.7761 5.22386 15 5.5 15H18.5C18.7761 15 19 14.7761 19 14.5V6.5C19 6.22386 18.7761 6 18.5 6H5.5Z" fill="#ffffff"></path> </g></svg>`
                },
                {
                    key: "smart_tv_recipient",
                    label: "Smart TV Recipient",
                    color: "bg-purple-500",
                    icon: `<svg xmlns="http://www.w3.org/2000/svg"  class="md:h-10 md:w-10 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18v12H3V4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20h8" />
                                </svg>`
                },
                {
                    key: "l4nt_recipient",
                    label: "L4NT Recipient",
                    color: "bg-yellow-500",
                    icon: `<svg viewBox="0 0 24 24"  class="md:h-10 md:w-10 h-6 w-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V16H23V17V18C23 19.6569 21.6569 21 20 21H4C2.34315 21 1 19.6569 1 18V17V16H2V6ZM20 6V16H4V6C4 5.44772 4.44772 5 5 5H19C19.5523 5 20 5.44772 20 6ZM4 19C3.44772 19 3 18.5523 3 18H21C21 18.5523 20.5523 19 20 19H4ZM5.5 6C5.22386 6 5 6.22386 5 6.5V14.5C5 14.7761 5.22386 15 5.5 15H18.5C18.7761 15 19 14.7761 19 14.5V6.5C19 6.22386 18.7761 6 18.5 6H5.5Z" fill="#ffffff"></path> </g></svg>`

                }, {
                    key: "employees",
                    label: "Total Employees",
                    color: "bg-blue-500",
                    icon: `<svg fill="#ffffff" viewBox="0 0 36 36" class="md:h-10 md:w-10 h-6 w-6" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>employee_solid</title> <g id="aad88ad3-6d51-4184-9840-f392d18dd002" data-name="Layer 3"> <circle cx="16.86" cy="9.73" r="6.46"></circle> <rect x="21" y="28" width="7" height="1.4"></rect> <path d="M15,30v3a1,1,0,0,0,1,1H33a1,1,0,0,0,1-1V23a1,1,0,0,0-1-1H26V20.53a1,1,0,0,0-2,0V22H22V18.42A32.12,32.12,0,0,0,16.86,18a26,26,0,0,0-11,2.39,3.28,3.28,0,0,0-1.88,3V30Zm17,2H17V24h7v.42a1,1,0,0,0,2,0V24h6Z"></path> </g> </g></svg>`

                }
            ];
            items.forEach(item => {
                const value = data[item.key] ?? 0;

                const card = document.createElement("div");
                card.className =
                    "md:p-4 p-2 rounded-xl tracking-wider shadow-lg border border-gray-300 bg-white flex items-center md:gap-4 gap-2 hover:shadow-xl transition";

                card.innerHTML = `
                          <div
                                class="md:h-16 h-12 w-12 md:w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                                <div class="text-white ${item.color} p-2 rounded-full">
                                    
                                    ${item.icon}
                                </div>
                            </div>
                                
                                <div>
                                    <h3 class="text-gray-600 text-sm font-medium">${item.label}</h3>
                                    <p class="text-2xl font-bold">${value}</p>
                                </div>
                            `;

                cardContainer.appendChild(card);
            });

            cardSpinner.classList.add("hidden");
            cardContainer.classList.remove('hidden');
        } catch (error) {
            console.error(error);
        }
    };
    loadCards();
    searchEmployee();
</script>


</table>
