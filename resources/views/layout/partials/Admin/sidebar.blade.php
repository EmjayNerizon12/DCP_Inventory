<div id="sidebar" class="sidebar py-10 ">
	@php
		$navCategories = [
		    'DCP List' => [
		        [
		            'label' => 'Product',
		            'url' => route('index.dcp.items'),
		            'active' => request()->routeIs('index.dcp.items'),
		            'icon' => '<svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
							<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
							<g id="SVGRepo_iconCarrier">
								<path
									d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
									stroke="currentColor" stroke-width="2"></path>
								<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
								<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
								<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
							</g>
						</svg>',
		        ],
		        [
		            'label' => 'Package',
		            'url' => route('index.dcp.package'),
		            'active' => request()->routeIs('index.dcp.package'),
		            'icon' => '<svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
							<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
							<g id="SVGRepo_iconCarrier">
								<path
									d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
									stroke="currentColor" stroke-width="2"></path>
								<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
								<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
								<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
							</g>
						</svg>',
		        ],
		        [
		            'label' => 'Batch',
		            'url' => route('index.batch'),
		            'active' => Request::is('Admin/DCPBatch/index'),
		            'icon' => '<svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
							<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
							<g id="SVGRepo_iconCarrier">
								<path
									d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
									stroke="currentColor" stroke-width="2"></path>
								<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
								<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
								<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
							</g>
						</svg>',
		        ],
		        [
		            'label' => 'Inventory',
		            'url' => route('index.SchoolsInventory'),
		            'active' => request()->routeIs('index.SchoolsInventory'),
		            'icon' => '<svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
							<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
							<g id="SVGRepo_iconCarrier">
								<path
									d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
									stroke="currentColor" stroke-width="2"></path>
								<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
								<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
								<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
							</g>
						</svg>',
		        ],
		        [
		            'label' => 'Product Condition',
		            'url' => url('/Admin/ItemConditions/0'),
		            'active' => Request::is('Admin/ItemConditions/0'),
		            'icon' => '<svg viewBox="0 0 24 24" class="w-10 h-10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
							<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
							<g id="SVGRepo_iconCarrier">
								<path
									d="M4 15.8294V15.75V8C4 7.69114 4.16659 7.40629 4.43579 7.25487L4.45131 7.24614L11.6182 3.21475L11.6727 3.18411C11.8759 3.06979 12.1241 3.06979 12.3273 3.18411L19.6105 7.28092C19.8511 7.41625 20 7.67083 20 7.94687V8V15.75V15.8294C20 16.1119 19.8506 16.3733 19.6073 16.5167L12.379 20.7766C12.1451 20.9144 11.8549 20.9144 11.621 20.7766L4.39267 16.5167C4.14935 16.3733 4 16.1119 4 15.8294Z"
									stroke="currentColor" stroke-width="2"></path>
								<path d="M12 21V12" stroke="currentColor" stroke-width="2"></path>
								<path d="M12 12L4 7.5" stroke="currentColor" stroke-width="2"></path>
								<path d="M20 7.5L12 12" stroke="currentColor" stroke-width="2"></path>
							</g>
						</svg>',
		        ],
		    ],
		    'Data Operations' => [
		        [
		            'label' => 'Products',
		            'url' => route('index.crud'),
		            'active' => request()->routeIs('index.crud'),
		            'icon' =>
		                '<svg viewBox="-0.5 0 25 25" class="w-6 h-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 3.32001H16C14.8954 3.32001 14 4.21544 14 5.32001V8.32001C14 9.42458 14.8954 10.32 16 10.32H19C20.1046 10.32 21 9.42458 21 8.32001V5.32001C21 4.21544 20.1046 3.32001 19 3.32001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8 3.32001H5C3.89543 3.32001 3 4.21544 3 5.32001V8.32001C3 9.42458 3.89543 10.32 5 10.32H8C9.10457 10.32 10 9.42458 10 8.32001V5.32001C10 4.21544 9.10457 3.32001 8 3.32001Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M19 14.32H16C14.8954 14.32 14 15.2154 14 16.32V19.32C14 20.4246 14.8954 21.32 16 21.32H19C20.1046 21.32 21 20.4246 21 19.32V16.32C21 15.2154 20.1046 14.32 19 14.32Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8 14.32H5C3.89543 14.32 3 15.2154 3 16.32V19.32C3 20.4246 3.89543 21.32 5 21.32H8C9.10457 21.32 10 20.4246 10 19.32V16.32C10 15.2154 9.10457 14.32 8 14.32Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
		        ],
		        [
		            'label' => 'Internet',
		            'url' => route('isp.index.list'),
		            'active' => request()->routeIs('isp.index.list'),
		            'icon' =>
		                '<svg viewBox="0 0 20 20" fill="none" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M8.763 13.58a1.75 1.75 0 1 1 2.473 2.477 1.75 1.75 0 0 1-2.473-2.478v.001zM3.4 10.825c3.64-3.64 9.56-3.64 13.2 0l-1.65 1.65a7.007 7.007 0 0 0-9.9 0l-1.65-1.65zm-3.3-3.3c5.46-5.459 14.34-5.459 19.8 0l-1.65 1.65c-4.55-4.55-11.95-4.55-16.5 0L.1 7.526v-.001z" fill="currentColor"></path></g></svg>',
		        ],
		        [
		            'label' => 'Employee',
		            'url' => route('employee.index'),
		            'active' => request()->routeIs('employee.index'),
		            'icon' =>
		                '<svg fill="currentColor" class="w-6 h-6 mr-2" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>employee_solid</title> <g id="aad88ad3-6d51-4184-9840-f392d18dd002" data-name="Layer 3"> <circle cx="16.86" cy="9.73" r="6.46"></circle> <rect x="21" y="28" width="7" height="1.4"></rect> <path d="M15,30v3a1,1,0,0,0,1,1H33a1,1,0,0,0,1-1V23a1,1,0,0,0-1-1H26V20.53a1,1,0,0,0-2,0V22H22V18.42A32.12,32.12,0,0,0,16.86,18a26,26,0,0,0-11,2.39,3.28,3.28,0,0,0-1.88,3V30Zm17,2H17V24h7v.42a1,1,0,0,0,2,0V24h6Z"></path> </g> </g></svg>',
		        ],
		        [
		            'label' => 'Equipment',
		            'url' => route('admin.schoolEquipment.index'),
		            'active' => request()->routeIs('admin.schoolEquipment.index'),
		            'icon' =>
		                '<svg fill="currentColor"  class="w-6 h-6 mr-2" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M11.405 5.34a.554.554 0 1 1-.996.485 5.563 5.563 0 0 0-1.375-1.782 1.201 1.201 0 0 0-1.786 1.05v.61a.476.476 0 0 1-.475.475h-2.48a.476.476 0 0 1-.475-.475v.07a1.194 1.194 0 0 0-.196-.657 2.145 2.145 0 0 1-.084-.113 1.202 1.202 0 0 0-1.94.134.554.554 0 0 1-1.06-.23v-2.28a.554.554 0 0 1 1.07-.202 1.2 1.2 0 0 0 1.902.148 2.176 2.176 0 0 1 .137-.186l.007-.011h.003a2.167 2.167 0 0 1 1.668-.781h.03a.516.516 0 0 1 .058-.003 6.662 6.662 0 0 1 5.993 3.748zM6.768 7.455a.476.476 0 0 0-.475-.475H4.578a.477.477 0 0 0-.475.475V16.9a.476.476 0 0 0 .475.475h1.715a.476.476 0 0 0 .475-.475z"></path></g></svg>',
		        ],
		        [
		            'label' => 'CCTV & Biomertrics',
		            'url' => route('equipment.index.list'),
		            'active' => request()->routeIs('equipment.index.list'),
		            'icon' =>
		                '<svg viewBox="0 0 24 24" class="w-6 h-6 mr-2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>fingerprint_line</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-48.000000, -288.000000)"> <g id="fingerprint_line" transform="translate(48.000000, 288.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,4 C8.13401,4 5,7.13401 5,11 L5,13 C5,13.5523 4.55228,14 4,14 C3.44772,14 3,13.5523 3,13 L3,11 C3,6.02944 7.02944,2 12,2 C16.9706,2 21,6.02944 21,11 L21,14 C20.9998,14.2621 20.9888,14.5244 20.9752,14.786 C20.9508,15.2591 20.9018,15.913 20.8033,16.6351 C20.6145,18.0199 20.2178,19.8763 19.3,21.1 C18.9686,21.5418 18.3418,21.6314 17.9,21.3 C17.4582,20.9686 17.3686,20.3418 17.7,19.9 C18.2822,19.1237 18.6355,17.7301 18.8217,16.3649 C18.9107,15.712 18.9555,15.1159 18.9779,14.6827 C18.9897,14.4553 18.9996,14.2273 19,13.9996 L19,11 C19,7.13401 15.866,4 12,4 Z M12,8 C10.3431,8 9,9.34315 9,11 L9,12 C9,12.9403 8.69626,14.1008 8.13235,15.1581 C7.56532,16.2213 6.68336,17.2764 5.44721,17.8944 C4.95324,18.1414 4.35256,17.9412 4.10557,17.4472 C3.85858,16.9532 4.05881,16.3526 4.55279,16.1056 C5.31664,15.7236 5.93468,15.0287 6.36765,14.2169 C6.80374,13.3992 7,12.5597 7,12 L7,11 C7,8.23858 9.23858,6 12,6 C14.7614,6 17.0000161,8.23858 17.0000161,11 L17.0000161,12 L17.0000161,12.1166 C17.0006,15.0415 17.0014,18.9672 13.6402,21.7682 C13.2159,22.1218 12.5853,22.0645 12.2318,21.6402 C11.8782,21.2159 11.9355,20.5853 12.3598,20.2318 C14.9537,18.0702 15,15.0635 15,12 L15,11 C15,9.34315 13.6569,8 12,8 Z M13,11.5 C13,10.9477 12.5523,10.5 12,10.5 C11.4477,10.5 11,10.9477 11,11.5 C11,12.6974 10.8785,14.2023 10.4263,15.5588 C9.97506,16.9125 9.2319,18.016 8.05279,18.6056 C7.55881,18.8526 7.35858,19.4532 7.60557,19.9472 C7.85256,20.4412 8.45324,20.6414 8.94721,20.3944 C10.7681,19.484 11.7749,17.8375 12.3237,16.1912 C12.8715,14.5477 13,12.8026 13,11.5 Z" id="形状" fill="currentColor"> </path> </g> </g> </g> </g></svg>',
		        ],
		    ],
		];

		$topLinks = [
		    [
		        'label' => 'Dashboard',
		        'url' => route('admin.dashboard'),
		        'active' => request()->routeIs('admin.dashboard'),
		        'icon' =>
		            '<svg  class="w-6 h-6 mr-2" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M7 1H1V7H7V1ZM7 9H1V15H7V9ZM9 1H15V7H9V1ZM15 9H9V15H15V9Z" fill="currentColor"></path> </g></svg>',
		    ],
		    [
		        'label' => 'Product Search',
		        'url' => route('index.page.search'),
		        'active' => request()->routeIs('index.page.search'),
		        'icon' =>
		            '<svg fill="currentColor"  class="w-6 h-6 mr-2" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"></path> </g></svg>',
		    ],
		    [
		        'label' => 'Scan & Monitor',
		        'url' => route('admin.scan.monitor'),
		        'active' => request()->routeIs('admin.scan.monitor'),
		        'icon' =>
		            '<svg viewBox="0 0 24 24" class="w-6 h-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 16C13.6569 16 15 14.6569 15 13C15 11.3431 13.6569 10 12 10C10.3431 10 9 11.3431 9 13C9 14.6569 10.3431 16 12 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3 16.8V9.2C3 8.0799 3 7.51984 3.21799 7.09202C3.40973 6.71569 3.71569 6.40973 4.09202 6.21799C4.51984 6 5.0799 6 6.2 6H7.25464C7.37758 6 7.43905 6 7.49576 5.9935C7.79166 5.95961 8.05705 5.79559 8.21969 5.54609C8.25086 5.49827 8.27836 5.44328 8.33333 5.33333C8.44329 5.11342 8.49827 5.00346 8.56062 4.90782C8.8859 4.40882 9.41668 4.08078 10.0085 4.01299C10.1219 4 10.2448 4 10.4907 4H13.5093C13.7552 4 13.8781 4 13.9915 4.01299C14.5833 4.08078 15.1141 4.40882 15.4394 4.90782C15.5017 5.00345 15.5567 5.11345 15.6667 5.33333C15.7216 5.44329 15.7491 5.49827 15.7803 5.54609C15.943 5.79559 16.2083 5.95961 16.5042 5.9935C16.561 6 16.6224 6 16.7454 6H17.8C18.9201 6 19.4802 6 19.908 6.21799C20.2843 6.40973 20.5903 6.71569 20.782 7.09202C21 7.51984 21 8.0799 21 9.2V16.8C21 17.9201 21 18.4802 20.782 18.908C20.5903 19.2843 20.2843 19.5903 19.908 19.782C19.4802 20 18.9201 20 17.8 20H6.2C5.0799 20 4.51984 20 4.09202 19.782C3.71569 19.5903 3.40973 19.2843 3.21799 18.908C3 18.4802 3 17.9201 3 16.8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
		    ],
		    [
		        'label' => 'School',
		        'url' => route('index.schools'),
		        'active' => request()->routeIs('index.schools'),
		        'icon' =>
		            '<svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 10L12 5L3 10L6 11.6667M21 10L18 11.6667M21 10V10C21.6129 10.3064 22 10.9328 22 11.618V16.9998M6 11.6667L12 15L18 11.6667M6 11.6667V17.6667L12 21L18 17.6667L18 11.6667" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
		    ],
		    [
		        'label' => 'School Accounts',
		        'url' => route('user.schools'),
		        'active' => request()->routeIs('user.schools'),
		        'icon' =>
		            '<svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
		    ],
		];
	@endphp

	<div
		class="sidebar-title relative flex items-center gap-3 text-sm md:text-base px-4 py-3 mt-10 mx-2 rounded-xl font-semibold">

		<span class="title-icon">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M9.75 17L4.5 12l5.25-5M14.25 17l5.25-5-5.25-5" />
			</svg>
		</span>
		DCP Admin Portal
	</div>
	<div id="current-time-date" class="w-full text-center font-medium tracking-wide mt-2"></div>

	<hr class="my-5 border-gray-200">

	<nav class="mt-4 space-y-1 sidebar-nav">
		@foreach ($topLinks as $link)
			<div class=" tracking-wider mt-3">
				<a href="{{ $link['url'] }}"
					class="nav-link relative font-medium flex justify-start text-sm md:text-base  mx-2 rounded-md transition-all
					{{ $link['active'] ? 'active' : '' }}">
					{!! $link['icon'] !!}

					{{ $link['label'] }}
				</a>
			</div>
		@endforeach
		@foreach ($navCategories as $category => $links)
			<div class="tracking-wider mt-3">

				<div class="category-label flex items-center gap-2 px-4 py-2 mx-2 mt-4 rounded-lg"> <span class="category-icon">
						<!-- example icon -->
						<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
							<path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7l-6-4H4z" />
						</svg>
					</span>
					{{ $category }}
				</div>
				@foreach ($links as $link)
					<a href="{{ $link['url'] }}" style="letter-spacing:0.05rem;"
						class="flex flex justify-start font-medium text-sm nav-link rounded-md md:text-base px-4 py-2   
						{{ $link['active'] ? 'active' : '' }}">
						{!! $link['icon'] !!}
						{{ $link['label'] }}

					</a>
				@endforeach
			</div>
		@endforeach

	</nav>
</div>
