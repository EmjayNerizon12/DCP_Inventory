<script>
    const spinner = document.getElementById('spinner-container');
    const equipmentContainer = document.getElementById('equipment-card-info');
    const dcpCardContainer = document.getElementById('dcp-card-info');
    const learnersDataContainer = document.getElementById('learner-card-info');
    const conditionContainer = document.getElementById('condition-table-list');
    const productsListContainer = document.getElementById('dcp-card-products');
    const packageTypeContainer = document.getElementById('dcp-card-package-type');
    const token = localStorage.getItem('token');
    const school_id = document.getElementById('school_id').value;
    console.log(token);
    async function getDashboardData() {
        try {
            const token = localStorage.getItem('token');

            const response = await fetch(`/api/School/dcpDashboard/equipment-information/${school_id}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const res = await response.json();
            const data = res.data;
            const container = document.getElementById('equipment-card-info');
            container.classList.add('grid', 'md:grid-cols-5', 'grid-cols-2', 'gap-4', 'my-2');
            const employee_card = document.createElement('div');
            employee_card.innerHTML = `
            <div class="card-dashboard">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-600 text-white md:w-16 md:h-16 h-12 w-12 rounded-full flex items-center justify-center">
                                        <!-- Archive Icon -->
                                        <svg class="md:w-10 md:h-10 w-6 h-6" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
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
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total School Employees</p>
                                    <h3 class="card-value dashboard-card-value">${data.school_employee_count}</h3>
                                </div>

                                
                            </div>
                        </div>
                
                `;
            const internet_card = document.createElement('div');
            internet_card.innerHTML = `

                         <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">

                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                        <svg class="md:w-10 md:h-10 w-6 h-6" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title></title>
                                                <g>
                                                    <path d="M48,60A12,12,0,1,0,60,72,12.0081,12.0081,0,0,0,48,60Z"></path>
                                                    <path
                                                        d="M22.6055,46.6289A5.9994,5.9994,0,1,0,31.1133,55.09a24.2258,24.2258,0,0,1,33.7734,0,5.9512,5.9512,0,0,0,4.2539,1.77,6,6,0,0,0,4.2539-10.23C59.7773,32.918,36.2227,32.918,22.6055,46.6289Z">
                                                    </path>
                                                    <path
                                                        d="M90.27,29.7773a59.1412,59.1412,0,0,0-84.539,0,5.9994,5.9994,0,1,0,8.5312,8.4375c18.1172-18.3281,49.3594-18.3281,67.4766,0A5.9994,5.9994,0,1,0,90.27,29.7773Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total Internet Connections</p>
                                    <h3 class="card-value dashboard-card-value">${data.internet_count}</h3>
                                </div>

                                
                            </div>
                        </div>`;

            const cctv_card = document.createElement('div');
            cctv_card.innerHTML = `

                         <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                        <svg class="md:w-10 md:h-10 w-6 h-6" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 280.606 280.606" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            enable-background="new 0 0 280.606 280.606" transform="matrix(-1, 0, 0, 1, 0, 0)">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <path
                                                        d="m278.161,191.032l-149.199-149.199c-3.89-3.89-10.253-3.89-14.143,0l-55.861,55.861c-3.89,3.89-3.89,10.411 0,14.302l14.098,14.256h-40.056v-23.317c0-5.5-4.44-9.683-9.94-9.683h-13c-5.5,0-10.06,4.183-10.06,9.683v79c0,5.5 4.56,10.317 10.06,10.317h13c5.5,0 9.94-4.817 9.94-10.317v-22.683h73.056l78.767,78.607c3.89,3.891 11.097,4.979 16.016,2.52l75.449-37.764c4.919-2.459 5.763-7.693 1.873-11.583zm-162.104-127.81c3.223-3.222 8.445-3.222 11.668-7.10543e-15 3.222,3.223 3.222,8.445 0,11.667-3.223,3.223-8.445,3.223-11.668,0.001-3.222-3.222-3.222-8.445 1.42109e-14-11.668zm53.349,135.373l-94.007-94.007 11.313-11.313 94.007,94.007-11.313,11.313z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total CCTV Equipment</p>
                                    <h3 class="card-value dashboard-card-value">${data.cctv_count}</h3>
                                </div>

                                
                            </div>
                        </div>`;
            const biometrics_card = document.createElement('div');
            biometrics_card.innerHTML = `

                         <div class="card-dashboard ">
                              <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">

                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                            <svg class="md:w-10 md:h-10 w-6 h-6" fill="currentColor" viewBox="0 0 32 32" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                             <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                             <g id="SVGRepo_iconCarrier">
                                 <title>fingerprint</title>
                                 <path
                                     d="M5.796 6.587c2.483-2.099 5.629-3.486 9.084-3.812l0.066-0.005c4.263 0 8.188 1.446 11.312 3.874l-0.042-0.031c0.121 0.087 0.271 0.138 0.434 0.138 0.415 0 0.751-0.336 0.751-0.751 0-0.251-0.123-0.473-0.312-0.609l-0.002-0.002c-3.327-2.569-7.556-4.118-12.147-4.118-0.028 0-0.055 0-0.083 0h0.004c-3.847 0.349-7.287 1.856-10.029 4.166l0.027-0.022c-0.174 0.139-0.284 0.35-0.284 0.587 0 0.414 0.336 0.75 0.75 0.75 0.178 0 0.342-0.062 0.471-0.166l-0.001 0.001zM28.555 11.495c-4.166-4.572-8.404-6.891-12.602-6.891h-0.044c-4.184 0.017-8.378 2.336-12.468 6.895-0.119 0.132-0.192 0.308-0.192 0.501 0 0.414 0.336 0.75 0.75 0.75 0.222 0 0.421-0.096 0.558-0.249l0.001-0.001c3.794-4.23 7.615-6.382 11.356-6.396 3.796-0.025 7.647 2.139 11.53 6.4 0.138 0.151 0.335 0.245 0.555 0.245 0.414 0 0.75-0.336 0.75-0.75 0-0.195-0.074-0.372-0.196-0.505l0.001 0.001zM22.68 27.684c-1.684-0.444-3.106-1.387-4.139-2.657l-0.011-0.014c-1.034-1.355-1.692-3.047-1.792-4.887l-0.001-0.023c-0.048-0.381-0.37-0.672-0.759-0.672-0.022 0-0.043 0.001-0.065 0.003l0.003-0c-0.381 0.040-0.675 0.358-0.675 0.746 0 0.027 0.001 0.053 0.004 0.079l-0-0.003c0.137 2.165 0.912 4.126 2.136 5.724l-0.018-0.025c1.245 1.532 2.94 2.654 4.882 3.169l0.065 0.015c0.056 0.015 0.12 0.023 0.185 0.023h0c0.414-0 0.75-0.336 0.75-0.75 0-0.348-0.237-0.641-0.559-0.725l-0.005-0.001zM20.094 9.35c-1.252-0.502-2.703-0.793-4.222-0.793-0.586 0-1.162 0.043-1.725 0.127l0.064-0.008c-2.143 0.362-4.029 1.268-5.569 2.571l0.017-0.014c-2.242 1.836-3.847 4.374-4.482 7.275l-0.016 0.086c-0.093 0.436-0.166 0.871-0.228 1.369-0.029 0.323-0.046 0.7-0.046 1.080 0 2.965 1.012 5.694 2.709 7.86l-0.021-0.028c0.139 0.172 0.349 0.281 0.585 0.281 0.414 0 0.75-0.336 0.75-0.75 0-0.178-0.062-0.342-0.166-0.47l0.001 0.001c-1.473-1.869-2.363-4.257-2.363-6.854 0-0.348 0.016-0.692 0.047-1.032l-0.003 0.044q0.076-0.601 0.201-1.189c0.578-2.645 2.001-4.892 3.966-6.501l0.020-0.016c1.324-1.122 2.963-1.912 4.767-2.222l0.060-0.008c0.429-0.064 0.923-0.1 1.426-0.1 1.33 0 2.6 0.255 3.764 0.718l-0.069-0.024c3.107 1.2 5.481 3.696 6.492 6.807l0.022 0.077c0.549 1.778 0.705 4.901-0.43 6.142-0.348 0.34-0.823 0.549-1.348 0.549-0.219 0-0.43-0.037-0.626-0.104l0.014 0.004c-0.743-0.197-1.382-0.57-1.893-1.073l0.001 0.001c-0.376-0.309-0.674-0.699-0.869-1.144l-0.008-0.020c-0.108-0.36-0.171-0.774-0.171-1.202 0-0.031 0-0.061 0.001-0.092l-0 0.005c0-0.009 0-0.019 0-0.029 0-0.555-0.076-1.093-0.217-1.603l0.010 0.042c-0.527-1.406-1.684-2.466-3.118-2.849l-0.032-0.007c-0.463-0.172-0.997-0.272-1.555-0.272-0.344 0-0.679 0.038-1.001 0.11l0.030-0.006c-0.913 0.269-1.685 0.784-2.262 1.469l-0.006 0.007c-0.679 0.705-1.167 1.597-1.38 2.592l-0.006 0.035c-0.008 0.137-0.013 0.297-0.013 0.458 0 2.243 0.889 4.278 2.333 5.773l-0.002-0.002c1.365 1.634 2.84 3.086 4.444 4.385l0.060 0.047c0.13 0.113 0.301 0.181 0.489 0.181 0.414 0 0.75-0.336 0.75-0.75 0-0.231-0.104-0.437-0.268-0.575l-0.001-0.001c-1.586-1.282-2.993-2.664-4.257-4.17l-0.038-0.047c-1.249-1.225-2.024-2.93-2.024-4.816 0-0.075 0.001-0.15 0.004-0.224l-0 0.011c0.168-0.742 0.528-1.383 1.024-1.889l-0.001 0.001c0.389-0.476 0.907-0.833 1.499-1.022l0.023-0.006c0.181-0.037 0.389-0.059 0.602-0.059 0.394 0 0.771 0.073 1.119 0.206l-0.021-0.007c0.993 0.249 1.786 0.941 2.17 1.847l0.008 0.021c0.090 0.346 0.141 0.744 0.141 1.154 0 0.018-0 0.036-0 0.054l0-0.003c-0 0.019-0 0.042-0 0.064 0 0.602 0.096 1.182 0.273 1.725l-0.011-0.039c0.287 0.702 0.722 1.291 1.269 1.752l0.007 0.006c0.699 0.676 1.574 1.174 2.549 1.421l0.039 0.008c0.285 0.087 0.612 0.137 0.951 0.137 0.956 0 1.819-0.399 2.431-1.040l0.001-0.001c1.689-1.846 1.359-5.639 0.756-7.596-1.175-3.631-3.878-6.475-7.332-7.815l-0.084-0.029zM9.269 20.688c0.052-2.064 1.027-3.89 2.526-5.088l0.013-0.010c0.574-0.489 1.234-0.901 1.95-1.208l0.050-0.019c0.8-0.349 1.732-0.552 2.712-0.552 1.095 0 2.131 0.254 3.053 0.705l-0.041-0.018c2.115 1.295 3.505 3.594 3.505 6.217 0 0.112-0.003 0.224-0.008 0.335l0.001-0.016c0.020 0.399 0.348 0.715 0.75 0.715 0.415 0 0.751-0.336 0.751-0.751 0-0.011-0-0.021-0.001-0.032l0 0.002c0.006-0.117 0.009-0.254 0.009-0.392 0-3.165-1.727-5.926-4.29-7.394l-0.042-0.022c-1.078-0.535-2.347-0.848-3.69-0.848-1.187 0-2.317 0.245-3.342 0.686l0.055-0.021c-0.915 0.389-1.703 0.88-2.401 1.475l0.013-0.011c-1.823 1.479-2.999 3.694-3.073 6.186l-0 0.012c0.125 3.937 1.87 7.444 4.586 9.893l0.012 0.011c0.134 0.128 0.317 0.207 0.518 0.207 0.414 0 0.75-0.336 0.75-0.75 0-0.213-0.089-0.406-0.232-0.543l-0-0c-2.434-2.174-3.998-5.277-4.134-8.746l-0.001-0.023z">
                                 </path>
                             </g>
                         </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total Biometric Equipment</p>
                                    <h3 class="card-value dashboard-card-value">${data.biometric_count}</h3>
                                </div>

                                
                            </div>
                        </div>`;

            const other_card = document.createElement('div');
            other_card.innerHTML = `

                         <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="md:w-10 md:h-10 w-6 h-6" fill="currentColor">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <defs>
                                                        <style>
                                                            .cls-1 {
                                                                fill: none;
                                                                stroke: currentColor;
                                                                stroke-linecap: round;
                                                                stroke-linejoin: round;
                                                                stroke-width: 2px;
                                                            }
                                                        </style>
                                                    </defs>
                                                    <title></title>
                                                    <g data-name="Layer 2" id="Layer_2">
                                                        <path class="cls-1" d="M22,10V22H10V10c0-6,4-9,6-9S22,4,22,10Z"></path>
                                                        <polygon class="cls-1" points="10 22 7 26 25 26 22 22 10 22"></polygon>
                                                        <circle class="cls-1" cx="16" cy="12" r="3"></circle>
                                                        <line class="cls-1" x1="16" x2="16" y1="26" y2="31"></line>
                                                        <line class="cls-1" x1="20" x2="20" y1="26" y2="29"></line>
                                                        <line class="cls-1" x1="12" x2="12" y1="26" y2="29"></line>
                                                    </g>
                                                </g>
                                            </svg>

                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Other School Equipment</p>
                                    <h3 class="card-value dashboard-card-value">${data.other_equipment}</h3>
                                </div>

                                
                            </div>
                        </div>`;


            container.appendChild(employee_card);

            container.appendChild(internet_card);
            container.appendChild(cctv_card);
            container.appendChild(biometrics_card);
            container.appendChild(other_card);
        } catch (error) {
            console.error(error)
        }
    }
    async function getDCPData() {

        const response = await fetch(`/api/School/dcpDashboard/dcp-information/${school_id}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });
        const res = await response.json();
        const data = res.data;
        const container = document.getElementById('dcp-card-info');
        container.classList.add('grid', 'md:grid-cols-5', 'grid-cols-2', 'gap-4', 'my-4');
        const batch_card = document.createElement('div');
        batch_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-green-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                       <svg class="md:w-10 md:h-10 w-6 h-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 3L3 8V16L12 21L21 16V8L12 3Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M3.5 7.8L12 12.5L20.5 7.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 12.5V21" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total Batch Received</p>
                                    <h3 class="card-value dashboard-card-value">${data.totalBatches}</h3>
                                </div>

                                
                            </div>
                        </div>`;

        const items_card = document.createElement('div');
        items_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-yellow-400 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                          <svg class="md:w-10 md:h-10 w-6 h-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 7H21V10H3V7Z" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5 10H19V18C19 19 18 20 17 20H7C6 20 5 19 5 18V10Z" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 14H15" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total Product Received</p>
                                    <h3 class="card-value dashboard-card-value">${data.totalItems}</h3>
                                </div>

                                
                            </div>
                        </div>`;






        const underWarranty_card = document.createElement('div');
        underWarranty_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-green-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                        <svg fill="currentColor" class="md:w-10 md:h-10 w-6 h-6" viewBox="0 0 52 52" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M26,2c3,0,5.43,3.29,8.09,4.42s6.82.51,8.84,2.65,1.51,6.07,2.65,8.84S50,23,50,26s-3.29,5.43-4.42,8.09-.51,6.82-2.65,8.84-6.07,1.53-8.84,2.65S29,50,26,50s-5.43-3.29-8.09-4.42-6.82-.51-8.84-2.65-1.53-6.07-2.65-8.84S2,29,2,26s3.29-5.43,4.42-8.09.51-6.82,2.65-8.84,6.07-1.53,8.84-2.65S23,2,26,2Zm0,7.58A16.42,16.42,0,1,0,42.42,26h0A16.47,16.47,0,0,0,26,9.58Zm7.62,9.15,1.61,1.52a1.25,1.25,0,0,1,0,1.51L25.08,33.07a2.07,2.07,0,0,1-1.61.7,2.23,2.23,0,0,1-1.61-.7L16.37,27.6a1,1,0,0,1-.1-1.42l.1-.11L18,24.56a1.1,1.1,0,0,1,1.54-.07l.07.07,3.89,4,8.59-9.8A1.1,1.1,0,0,1,33.62,18.73Z">
                                    </path>
                                </g>
                            </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Under Warranty Products</p>
                                    <h3 class="card-value dashboard-card-value">${data.total_under_warranty}</h3>
                                </div>

                                
                            </div>
                        </div>`;



        const outWarranty_card = document.createElement('div');
        outWarranty_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-red-600 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                               <svg viewBox="0 0 16 16" class="md:w-10 md:h-10 w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14 2H13V4.41421L9.41421 8L13 11.5858V14H14V16H2V14H3V11.5858L6.58579 8L3 4.41421V2H2V0H14V2ZM5 2V3.58579L8 6.58579L11 3.58579V2H5ZM8 9.41421L5 12.4142V14H11V12.4142L8 9.41421Z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Out of Warranty Products</p>
                                    <h3 class="card-value dashboard-card-value">${data.total_out_of_warranty}</h3>
                                </div>

                                
                            </div>
                        </div>`;






        container.appendChild(batch_card);
        container.appendChild(items_card);
        container.appendChild(underWarranty_card);
        container.appendChild(outWarranty_card);

        //THIRD ROW OF CARDS
        const learnersDataContainer = document.getElementById('learner-card-info');
        learnersDataContainer.classList.add('grid', 'md:grid-cols-5', 'grid-cols-2', 'gap-4', 'my-4');
        const learner_total_card = document.createElement('div');
        learner_total_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-400 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                               <svg class="md:w-10 md:h-10 w-6 h-6" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <style type="text/css">
                                            .st0 {
                                                fill: currentColor;
                                            }
                                        </style>
                                        <g>
                                            <path class="st0"
                                                d="M505.837,180.418L279.265,76.124c-7.349-3.385-15.177-5.093-23.265-5.093c-8.088,0-15.914,1.708-23.265,5.093 L6.163,180.418C2.418,182.149,0,185.922,0,190.045s2.418,7.896,6.163,9.627l226.572,104.294c7.349,3.385,15.177,5.101,23.265,5.101 c8.088,0,15.916-1.716,23.267-5.101l178.812-82.306v82.881c-7.096,0.8-12.63,6.84-12.63,14.138c0,6.359,4.208,11.864,10.206,13.618 l-12.092,79.791h55.676l-12.09-79.791c5.996-1.754,10.204-7.259,10.204-13.618c0-7.298-5.534-13.338-12.63-14.138v-95.148 l21.116-9.721c3.744-1.731,6.163-5.504,6.163-9.627S509.582,182.149,505.837,180.418z">
                                            </path>
                                            <path class="st0"
                                                d="M256,346.831c-11.246,0-22.143-2.391-32.386-7.104L112.793,288.71v101.638 c0,22.314,67.426,50.621,143.207,50.621c75.782,0,143.209-28.308,143.209-50.621V288.71l-110.827,51.017 C278.145,344.44,267.25,346.831,256,346.831z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total No. of Learners</p>
                                    <h3 class="card-value dashboard-card-value">${data.totalLearners}</h3>
                                </div>

                                
                            </div>
                        </div>`;

        const teachers_total_card = document.createElement('div');
        teachers_total_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-400 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                              
                                    <svg fill="currentColor" class="md:w-10 md:h-10 w-6 h-6" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M 38.7232 28.5490 C 43.1399 28.5490 46.9403 24.6047 46.9403 19.4690 C 46.9403 14.3949 43.1193 10.6356 38.7232 10.6356 C 34.3271 10.6356 30.5061 14.4771 30.5061 19.5101 C 30.5061 24.6047 34.3066 28.5490 38.7232 28.5490 Z M 15.0784 29.0215 C 18.8994 29.0215 22.2274 25.5703 22.2274 21.1125 C 22.2274 16.6958 18.8789 13.4294 15.0784 13.4294 C 11.2575 13.4294 7.8885 16.7779 7.9090 21.1536 C 7.9090 25.5703 11.2370 29.0215 15.0784 29.0215 Z M 3.6155 47.5717 L 19.2281 47.5717 C 17.0917 44.4697 19.7006 38.2247 24.1173 34.8146 C 21.8371 33.2944 18.8994 32.1645 15.0579 32.1645 C 5.7931 32.1645 0 39.0053 0 44.6957 C 0 46.5445 1.0271 47.5717 3.6155 47.5717 Z M 25.8018 47.5717 L 51.6241 47.5717 C 54.8493 47.5717 56 46.6472 56 44.8395 C 56 39.5394 49.3644 32.2261 38.7026 32.2261 C 28.0616 32.2261 21.4262 39.5394 21.4262 44.8395 C 21.4262 46.6472 22.5766 47.5717 25.8018 47.5717 Z">
                                            </path>
                                        </g>
                                    </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total No. of Teachers</p>
                                    <h3 class="card-value dashboard-card-value">${data.totalTeachers}</h3>
                                </div>

                                
                            </div>
                        </div>`;








        const classrooms_total_card = document.createElement('div');
        classrooms_total_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-400 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                        <svg fill="currentColor" class="md:w-10 md:h-10 w-6 h-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M4,23H20a1,1,0,0,0,0-2V2a1,1,0,0,0-1-1H5A1,1,0,0,0,4,2V21a1,1,0,0,0,0,2ZM6,3H18V21H6Zm3,8v2a1,1,0,0,1-2,0V11a1,1,0,0,1,2,0Z">
                                                    </path>
                                                </g>
                                            </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total No. of Classrooms</p>
                                    <h3 class="card-value dashboard-card-value">${data.totalClassrooms}</h3>
                                </div>

                                
                            </div>
                        </div>`;
        const sections_total_card = document.createElement('div');
        sections_total_card.innerHTML = `
                     <div class="card-dashboard ">
                            <div class="flex md:flex-row flex-col justify-center md:items-start items-center w-full gap-4">
                                <div
                                    class="dashboard-icon-container">

                                    <div class="bg-blue-400 text-white dashboard-icon">
                                        <!-- Archive Icon -->
                                        <svg viewBox="0 0 64 64" class="md:w-10 md:h-10 w-6 h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                aria-hidden="true" role="img" class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet"
                                                fill="currentColor">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M32 2C15.432 2 2 15.431 2 32c0 16.569 13.432 30 30 30s30-13.432 30-30C62 15.431 48.568 2 32 2m8.953 42.678c-2.049 1.752-4.943 2.627-8.684 2.627c-3.82 0-6.826-.863-9.014-2.588c-2.189-1.727-3.283-4.098-3.283-7.117h5.787c.188 1.326.557 2.316 1.105 2.973c1.006 1.195 2.727 1.791 5.166 1.791c1.461 0 2.646-.156 3.557-.473c1.73-.604 2.594-1.725 2.594-3.365c0-.957-.424-1.699-1.27-2.225c-.848-.512-2.191-.965-4.029-1.357l-3.141-.689c-3.088-.684-5.209-1.424-6.363-2.224c-1.957-1.339-2.934-3.432-2.934-6.28c0-2.599.957-4.757 2.869-6.476c1.912-1.72 4.723-2.579 8.43-2.579c3.096 0 5.734.81 7.922 2.431c2.184 1.621 3.33 3.974 3.438 7.058h-5.828c-.107-1.745-.887-2.985-2.34-3.721c-.969-.485-2.174-.729-3.613-.729c-1.602 0-2.879.315-3.834.945s-1.434 1.509-1.434 2.638c0 1.037.471 1.811 1.414 2.322c.604.342 1.889.742 3.855 1.201l5.092 1.201c2.23.524 3.904 1.227 5.018 2.105c1.729 1.365 2.594 3.341 2.594 5.925c0 2.651-1.023 4.854-3.074 6.606"
                                                        fill="currentColor"></path>
                                                </g>
                                            </svg>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="card-title dashboard-card-label">Total No. of  Sections</p>
                                    <h3 class="card-value dashboard-card-value">${data.totalSections}</h3>
                                </div>

                                
                            </div>
                        </div>`;










        learnersDataContainer.appendChild(learner_total_card);
        learnersDataContainer.appendChild(teachers_total_card);
        learnersDataContainer.appendChild(classrooms_total_card);
        learnersDataContainer.appendChild(sections_total_card);


        const productsListContainer = document.getElementById('dcp-card-products');
        productsListContainer.classList.add('grid', 'md:grid-cols-5', 'grid-cols-1', 'gap-4', 'my-4');
        const title = document.createElement('div');
        title.classList.add('md:col-span-5', 'col-span-1', 'dashboard-title');
        title.innerHTML = `Product Name Received from DCP Batches`;

        productsListContainer.appendChild(title);

        const products = data.item_sorted;
        const bgColor = [
            'bg-slate-200',
            'bg-gray-200',
            'bg-zinc-200',
            'bg-neutral-200',
            'bg-stone-200',

            'bg-red-200',
            'bg-orange-200',
            'bg-amber-200',
            'bg-yellow-200',
            'bg-lime-200',
            'bg-green-200',
            'bg-emerald-200',
            'bg-teal-200',
            'bg-cyan-200',
            'bg-sky-200',
            'bg-blue-200',
            'bg-indigo-200',
            'bg-violet-200',
            'bg-purple-200',
            'bg-fuchsia-200',
            'bg-pink-200',
            'bg-rose-200',
        ];
        bgColor.reverse();
        Object.entries(products).map(([key, value], index) => {
            const card = document.createElement('div');
            card.innerHTML = `
            <div class="card-macaron ${bgColor[index % bgColor.length]}">
                <div class="w-full">
                    <p class="card-macaron-title">${key}</p>
                    <h3 class="card-macaron-value">${value}</h3>
                </div>
            </div>`;
            productsListContainer.appendChild(card);
        });

        const packageTypeContainer = document.getElementById('dcp-card-package-type');
        packageTypeContainer.classList.add('grid', 'md:grid-cols-5', 'grid-cols-1', 'gap-4', 'my-4');
        const packageTypeTitle = document.createElement('div');
        packageTypeTitle.classList.add('md:col-span-5', 'col-span-1', 'dashboard-title');
        packageTypeTitle.innerHTML = `Packages Received from DCP Batches`;
        packageTypeContainer.appendChild(packageTypeTitle);
        const packages = data.packagesWithCounts;
        const packageInfoUrl = "{{ route('schools.packages.info', ':id') }}";
        packages.forEach((package, index) => {
            const card = document.createElement('div');
            const url = packageInfoUrl.replace(':id', package.id);

            card.innerHTML = `
            <a href="${url}">
            <div class="card-macaron h-full text-center flex items-center ${bgColor[index % bgColor.length]}">
                <div class="w-full">
                    <p class="card-macaron-title">${package.name}</p>
                    <h3 class="card-macaron-value">${package.count}</h3>
                </div>
            </div> </a>`;
            packageTypeContainer.appendChild(card);
        });
    }
    async function getConditionData() {
        const container = document.getElementById('condition-table-list');
        const conditionTitle = document.createElement('div');
        const bgColor = [
            'bg-slate-600', 'bg-gray-600', 'bg-zinc-600', 'bg-neutral-600', 'bg-stone-600',
            'bg-red-600', 'bg-orange-600', 'bg-amber-600', 'bg-yellow-600', 'bg-lime-600',
            'bg-green-600', 'bg-emerald-600', 'bg-teal-600', 'bg-cyan-600', 'bg-sky-600',
            'bg-blue-600', 'bg-indigo-600', 'bg-violet-600', 'bg-purple-600',
            'bg-fuchsia-600', 'bg-pink-600', 'bg-rose-600'
        ];
        bgColor.reverse();
        try {
            const response = await fetch(`/api/School/dcpDashboard/condition-information/${school_id}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            const entries = Object.entries(data);
            const total = Object.values(data)
                .reduce((sum, val) => sum + Number(val), 0);

            const maxValue = Math.max(...Object.values(data));

            const tableHTML = `
            <div class="dashboard-title">
                Current Conditions of the DCP Products
                </div>
            <table class="min-w-full border border-gray-300 text-base tracking-wider ">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="table-header text-left">Condition</th>
                        <th class="table-header  text-center">Count</th>
                        <th class="table-header  text-center">Percentage</th>
                        <th class="table-header  text-left">Progress</th>
                    </tr>
                </thead>
                <tbody>
                    ${entries.map(([key, value], index) => {
                       const percent = total > 0
                            ? ((value / total) * 100).toFixed(1)
                            : 0;
                        const color = bgColor[index % bgColor.length];

                        return `
                            <tr class="hover:bg-gray-50">
                                <td class="td-cell">${key}</td>
                                <td class="td-cell text-center font-semibold">${value}</td>
                                <td class="td-cell text-center">${percent}%</td>
                                <td class="td-cell">
                                    <div class="w-full bg-gray-200 rounded-full h-4">
                                        <div class="${color} h-4 rounded-full transition-all duration-300"
                                             style="width: ${percent}%"></div>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }).join('')}
                </tbody>
            </table>
        `;

            container.innerHTML = tableHTML;

        } catch (error) {
            console.error('Error loading condition table:', error);
            container.innerHTML = `<p class="text-red-600">Failed to load data.</p>`;
        }
    }
    async function loadData() {

        await getDashboardData();
        await getDCPData();
        await getConditionData();
        spinner.classList.add('hidden');
        equipmentContainer.classList.remove('hidden');
        dcpCardContainer.classList.remove('hidden');
        conditionContainer.classList.remove('hidden');
        learnersDataContainer.classList.remove('hidden');
        productsListContainer.classList.remove('hidden');
        packageTypeContainer.classList.remove('hidden');
    }
    loadData();
</script>
