<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        html {
            scroll-behavior: smooth;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased bg-gray-100 flex min-h-screen" x-data="{ sidebarOpen: false }">

    @php
        $navCategories = [
            'DCP List' => [
                [
                    'label' => 'Product',
                    'url' => route('index.item_type'),
                    'active' => Request::is('item-type'),
                    'icon' =>
                        '<svg viewBox="0 0 24 24" class="h-6 w-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.73 16.52C20.73 16.52 20.73 16.45 20.73 16.41V7.58999C20.7297 7.47524 20.7022 7.36218 20.65 7.25999C20.5764 7.10119 20.4488 6.97364 20.29 6.89999L12.29 3.31999C12.1926 3.2758 12.0869 3.25293 11.98 3.25293C11.8731 3.25293 11.7674 3.2758 11.67 3.31999L3.67001 6.89999C3.54135 6.96474 3.43255 7.06303 3.35511 7.18448C3.27766 7.30592 3.23444 7.44603 3.23001 7.58999V16.41C3.23749 16.5532 3.28195 16.6921 3.35906 16.813C3.43617 16.9339 3.54331 17.0328 3.67001 17.1L11.67 20.68C11.7668 20.7262 11.8727 20.7501 11.98 20.7501C12.0873 20.7501 12.1932 20.7262 12.29 20.68L20.29 17.1C20.4055 17.0471 20.5061 16.9665 20.5829 16.8653C20.6597 16.7641 20.7102 16.6455 20.73 16.52ZM4.73001 8.73999L11.23 11.66V18.84L4.73001 15.93V8.73999ZM12.73 11.66L19.23 8.73999V15.93L12.73 18.84V11.66ZM12 4.81999L18.17 7.58999L12 10.35L5.83001 7.58999L12 4.81999Z" fill="currentColor"></path> </g></svg>',
                ],
                [
                    'label' => 'Package',
                    'url' => route('index.package_type'),
                    'active' => Request::is('package-type/create'),
                    'icon' =>
                        '<svg viewBox="0 0 24 24" class="h-6 w-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4856 1.12584C12.1836 0.958052 11.8164 0.958052 11.5144 1.12584L2.51436 6.12584L2.5073 6.13784L2.49287 6.13802C2.18749 6.3177 2 6.64568 2 7V16.9999C2 17.3631 2.19689 17.6977 2.51436 17.874L11.5022 22.8673C11.8059 23.0416 12.1791 23.0445 12.4856 22.8742L21.4856 17.8742C21.8031 17.6978 22 17.3632 22 17V7C22 6.64568 21.8125 6.31781 21.5071 6.13813C21.4996 6.13372 21.4921 6.12942 21.4845 6.12522L12.4856 1.12584ZM5.05923 6.99995L12.0001 10.856L14.4855 9.47519L7.74296 5.50898L5.05923 6.99995ZM16.5142 8.34816L18.9409 7L12 3.14396L9.77162 4.38195L16.5142 8.34816ZM4 16.4115V8.69951L11 12.5884V20.3004L4 16.4115ZM13 20.3005V12.5884L20 8.69951V16.4116L13 20.3005Z" fill="currentColor"></path> </g></svg>',
                ],
                [
                    'label' => 'Batch',
                    'url' => route('index.batch'),
                    'active' => Request::is('Admin/DCPBatch/index'),
                    'icon' =>
                        '<svg fill="currentColor" class="w-6 h-6 mr-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M495.817,239.818H392.092V52.156c0-8.937-7.246-16.183-16.183-16.183H136.091c-8.938,0-16.183,7.246-16.183,16.183 v187.661H16.183C7.246,239.817,0,247.063,0,256.001v203.844c0,8.937,7.246,16.183,16.183,16.183h239.817h239.817 c8.937,0,16.183-7.246,16.183-16.183V256.001C512,247.064,504.755,239.818,495.817,239.818z M239.817,443.663H32.366V272.185 h103.725h103.726V443.663z M152.275,239.817V68.34h87.543v21.709c0,8.938,7.246,16.183,16.183,16.183s16.183-7.246,16.183-16.183 V68.34h87.543v171.478H256.001H152.275z M479.635,443.663h-0.001h-207.45V272.185H375.91h103.725V443.663z"></path> </g> </g> </g></svg>',
                ],
                [
                    'label' => 'Inventory',
                    'url' => route('index.SchoolsInventory'),
                    'active' => request()->routeIs('index.SchoolsInventory'),
                    'icon' =>
                        '<svg fill="currentColor" class="w-6 h-6 mr-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_1014_" d="M475,355h-15V200c0-8.284-6.716-15-15-15h-85V30c0-8.284-6.716-15-15-15H145c-8.284,0-15,6.716-15,15v155 H45c-8.284,0-15,6.716-15,15v155H15c-8.284,0-15,6.716-15,15v90c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15v-15h110v15 c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15v-15h110v15c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15v-90 C490,361.716,483.284,355,475,355z M430,215v140H260V215H430z M160,45h170v140H160V45z M60,215h170v140H60V215z M460,445h-30v-15 c0-8.284-6.716-15-15-15H275c-8.284,0-15,6.716-15,15v15h-30v-15c0-8.284-6.716-15-15-15H75c-8.284,0-15,6.716-15,15v15H30v-60h430 V445z"></path> </g></svg>',
                ],
                [
                    'label' => 'Product Condition',
                    'url' => url('/Admin/ItemConditions/0'),
                    'active' => Request::is('Admin/ItemConditions/0'),
                    'icon' =>
                        '<svg fill="currentColor" class="w-6 h-6 mr-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_1014_" d="M475,355h-15V200c0-8.284-6.716-15-15-15h-85V30c0-8.284-6.716-15-15-15H145c-8.284,0-15,6.716-15,15v155 H45c-8.284,0-15,6.716-15,15v155H15c-8.284,0-15,6.716-15,15v90c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15v-15h110v15 c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15v-15h110v15c0,8.284,6.716,15,15,15h60c8.284,0,15-6.716,15-15v-90 C490,361.716,483.284,355,475,355z M430,215v140H260V215H430z M160,45h170v140H160V45z M60,215h170v140H60V215z M460,445h-30v-15 c0-8.284-6.716-15-15-15H275c-8.284,0-15,6.716-15,15v15h-30v-15c0-8.284-6.716-15-15-15H75c-8.284,0-15,6.716-15,15v15H30v-60h430 V445z"></path> </g></svg>',
                ],
            ],
            'Other Details' => [
                [
                    'label' => 'Items',
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
                    'label' => 'Equipment',
                    'url' => route('equipment.index.list'),
                    'active' => request()->routeIs('equipment.index.list'),
                    'icon' =>
                        '<svg fill="currentColor" class="w-6 h-6 mr-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 507.901 507.901" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M493.9,68.251H14.1c-7.8,0-14.1,6.3-14.1,14.1v126.4c0,7.8,6.3,14.1,14.1,14.1h9.6c7.2,120.8,107.8,216.8,230.3,216.8 s223-96,230.2-216.8h9.6c7.8,0,14.1-6.3,14.1-14.1v-126.4C508,74.551,501.7,68.251,493.9,68.251z M254,411.451 c-107,0-194.9-83.4-202-188.6h404C448.8,328.051,361,411.451,254,411.451z M479.6,194.651H28.2v-98.2h183.4v24.6 c0,7.8,6.3,14.1,14.1,14.1s14.1-6.3,14.1-14.1v-24.6H268v56.9c0,7.8,6.3,14.1,14.1,14.1c7.8,0,14.1-6.3,14.1-14.1v-56.9h183.4 V194.651z"></path> </g> </g> <g> <g> <path d="M254,263.951c-29.4,0-53.3,23.9-53.3,53.3c0,29.4,23.9,53.3,53.3,53.3c29.4,0,53.3-23.9,53.3-53.3 C307.3,287.851,283.4,263.951,254,263.951z M254,342.351c-13.9,0-25.1-11.2-25.1-25.1c0-13.9,11.3-25.1,25.1-25.1 s25.1,11.2,25.1,25.1C279.1,331.151,267.9,342.351,254,342.351z"></path> </g> </g> </g></svg>',
                ],
                [
                    'label' => 'Employee',
                    'url' => route('employee.index'),
                    'active' => request()->routeIs('employee.index'),
                    'icon' =>
                        '<svg fill="currentColor" class="w-6 h-6 mr-2" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>employee_solid</title> <g id="aad88ad3-6d51-4184-9840-f392d18dd002" data-name="Layer 3"> <circle cx="16.86" cy="9.73" r="6.46"></circle> <rect x="21" y="28" width="7" height="1.4"></rect> <path d="M15,30v3a1,1,0,0,0,1,1H33a1,1,0,0,0,1-1V23a1,1,0,0,0-1-1H26V20.53a1,1,0,0,0-2,0V22H22V18.42A32.12,32.12,0,0,0,16.86,18a26,26,0,0,0-11,2.39,3.28,3.28,0,0,0-1.88,3V30Zm17,2H17V24h7v.42a1,1,0,0,0,2,0V24h6Z"></path> </g> </g></svg>',
                ],
            ],
        ];

        $topLinks = [
            [
                'label' => 'Home',
                'url' => url('Admin/DCP-Dashboard'),
                'active' => Request::is('Admin/DCP-Dashboard'),
                'icon' =>
                    '<svg viewBox="0 0 16 16" fill="none" class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z" fill="currentColor"></path> </g></svg>',
            ],
            [
                'label' => 'Product Search',
                'url' => route('index.page.search'),
                'active' => Request::is('Admin/Search/Product'),
                'icon' =>
                    '<svg viewBox="0 0 24 24" class="w-6 h-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 16C13.6569 16 15 14.6569 15 13C15 11.3431 13.6569 10 12 10C10.3431 10 9 11.3431 9 13C9 14.6569 10.3431 16 12 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3 16.8V9.2C3 8.0799 3 7.51984 3.21799 7.09202C3.40973 6.71569 3.71569 6.40973 4.09202 6.21799C4.51984 6 5.0799 6 6.2 6H7.25464C7.37758 6 7.43905 6 7.49576 5.9935C7.79166 5.95961 8.05705 5.79559 8.21969 5.54609C8.25086 5.49827 8.27836 5.44328 8.33333 5.33333C8.44329 5.11342 8.49827 5.00346 8.56062 4.90782C8.8859 4.40882 9.41668 4.08078 10.0085 4.01299C10.1219 4 10.2448 4 10.4907 4H13.5093C13.7552 4 13.8781 4 13.9915 4.01299C14.5833 4.08078 15.1141 4.40882 15.4394 4.90782C15.5017 5.00345 15.5567 5.11345 15.6667 5.33333C15.7216 5.44329 15.7491 5.49827 15.7803 5.54609C15.943 5.79559 16.2083 5.95961 16.5042 5.9935C16.561 6 16.6224 6 16.7454 6H17.8C18.9201 6 19.4802 6 19.908 6.21799C20.2843 6.40973 20.5903 6.71569 20.782 7.09202C21 7.51984 21 8.0799 21 9.2V16.8C21 17.9201 21 18.4802 20.782 18.908C20.5903 19.2843 20.2843 19.5903 19.908 19.782C19.4802 20 18.9201 20 17.8 20H6.2C5.0799 20 4.51984 20 4.09202 19.782C3.71569 19.5903 3.40973 19.2843 3.21799 18.908C3 18.4802 3 17.9201 3 16.8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
            ],
            [
                'label' => 'Scan & Monitor',
                'url' => route('admin.scan.monitor'),
                'active' => Request::is('Admin/Camera'),
                'icon' =>
                    '<svg viewBox="0 0 24 24" class="w-6 h-6 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 16C13.6569 16 15 14.6569 15 13C15 11.3431 13.6569 10 12 10C10.3431 10 9 11.3431 9 13C9 14.6569 10.3431 16 12 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M3 16.8V9.2C3 8.0799 3 7.51984 3.21799 7.09202C3.40973 6.71569 3.71569 6.40973 4.09202 6.21799C4.51984 6 5.0799 6 6.2 6H7.25464C7.37758 6 7.43905 6 7.49576 5.9935C7.79166 5.95961 8.05705 5.79559 8.21969 5.54609C8.25086 5.49827 8.27836 5.44328 8.33333 5.33333C8.44329 5.11342 8.49827 5.00346 8.56062 4.90782C8.8859 4.40882 9.41668 4.08078 10.0085 4.01299C10.1219 4 10.2448 4 10.4907 4H13.5093C13.7552 4 13.8781 4 13.9915 4.01299C14.5833 4.08078 15.1141 4.40882 15.4394 4.90782C15.5017 5.00345 15.5567 5.11345 15.6667 5.33333C15.7216 5.44329 15.7491 5.49827 15.7803 5.54609C15.943 5.79559 16.2083 5.95961 16.5042 5.9935C16.561 6 16.6224 6 16.7454 6H17.8C18.9201 6 19.4802 6 19.908 6.21799C20.2843 6.40973 20.5903 6.71569 20.782 7.09202C21 7.51984 21 8.0799 21 9.2V16.8C21 17.9201 21 18.4802 20.782 18.908C20.5903 19.2843 20.2843 19.5903 19.908 19.782C19.4802 20 18.9201 20 17.8 20H6.2C5.0799 20 4.51984 20 4.09202 19.782C3.71569 19.5903 3.40973 19.2843 3.21799 18.908C3 18.4802 3 17.9201 3 16.8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
            ],
            [
                'label' => 'School Lists',
                'url' => route('index.schools'),
                'active' => Request::is('Schools/index'),
                'icon' =>
                    '<svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 10L12 5L3 10L6 11.6667M21 10L18 11.6667M21 10V10C21.6129 10.3064 22 10.9328 22 11.618V16.9998M6 11.6667L12 15L18 11.6667M6 11.6667V17.6667L12 21L18 17.6667L18 11.6667" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
            ],
            [
                'label' => 'School Accounts',
                'url' => route('user.schools'),
                'active' => Request::is('Admin/Schools-User'),
                'icon' =>
                    '<svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
            ],
        ];
    @endphp
    @include('layout.partials.admin-style')
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Header -->

        <div class="flex flex-col gap-2 items-center justify-center px-4 py-2 bg-white my-2 mt-5">
            <img class="w-40 h-40" src="{{ asset('icon/logo.png') }}" alt="">
            <h2 class="font-bold text-xl">DCP HUB</h2>
        </div>
        <hr class="my-2 border-gray-200">

        <!-- Navigation -->
        <nav class="mt-4 space-y-1 bg-gray-50 sidebar-nav">
            <!-- Top links -->
            @foreach ($topLinks as $link)
                <div class="  mt-3"
                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                letter-spacing:0.05rem;">
                    <a href="{{ $link['url'] }}"
                        style="padding: 1rem 1.5rem;border-radius: 12px;   font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                letter-spacing:0.05rem;"
                        class="flex items-center  nav-link text-lg    px-4 py-2 mx-2 rounded-md transition-all  
                {{ $link['active'] ? 'active' : ' ' }}">
                        {{ $link['label'] }}
                    </a>
                </div>
            @endforeach


            <!-- Categorized links -->
            @foreach ($navCategories as $category => $links)
                <div class="  mt-3" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; ">
                    <h4 class=" pl-5 text-lg font-normal text-gray-800 my-4">
                        {{ $category }}:
                    </h4>
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" style="letter-spacing:0.05rem;"
                            class="flex text-lg items-start justify-start nav-link  
                        {{ $link['active'] ? 'active' : '' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            @endforeach
            `
        </nav>
    </div>


    <header style="background-color:rgb(1, 55, 142); "
        class=" text-gray-700 bg-white shadow-md fixed top-0 left-0 right-0 z-50  ">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Menu Button (Mobile only) -->
            <div class="flex flex-row gap-2 justify-center items-center">

                <button class="hamburger-btn text-white md:hidden" id="sidebarToggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <img class="w-12 h-12" style="object-fit: cover;" src="{{ asset('icon/sdo-logo.png') }}"
                    alt="User Icon">
                <h1 class="text-lg font-medium text-white hidden md:block uppercase"
                    style="font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif;letter-spacing:0.05rem">
                    DepEd Computerization Program <b>(DCP)</b>
                </h1>
                <h1 class="text-lg font-semibold text-white md:hidden">
                    e-DCP Hub
                </h1>
            </div>
            <style>
                .user-profile-btn {
                    background: rgba(255, 255, 255, 0.15);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    border-radius: 30px;
                    color: white;
                    display: flex;
                    align-items: center;
                    padding: 5px 15px 5px 5px;
                    transition: all 0.2s;
                }

                .user-profile-btn:hover {
                    background: rgba(255, 255, 255, 0.25);
                }

                .user-profile-btn img {
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    margin-right: 10px;
                    border: 2px solid rgba(255, 255, 255, 0.5);
                }

                .user-profile-btn .user-name {
                    font-weight: 500;
                    margin-right: 5px;
                    max-width: 120px;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                /* Responsive adjustments */
                @media (max-width: 768px) {

                    .navbar-brand {
                        font-size: 1.2rem;
                    }

                    .user-profile-btn .user-name {
                        display: none;
                    }

                    .user-profile-btn {
                        padding: 5px;
                    }
                }
            </style>
            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">

                <button @click="open = !open" class="user-profile-btn dropdown-toggle flex  items-center" type="button"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img style="object-fit: cover;" src="{{ asset('icon/logo.png') }}" alt="User Icon">
                    <span class="user-name">NORMAN A. FLORES</span>
                    <svg class="w-6 h-6  text-white transform transition-transform duration-300"
                        :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-cloak @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg py-1 z-50">
                    <a href="{{ route('admin.account.index') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-green-50">Account</a>
                    <a href="{{ route('admin.reports.index') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-green-50">Reports</a>
                    <a href="{{ url('logout') }}" class="block px-4 py-2 text-red-600 hover:bg-red-50">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->


    <div class="main-content" id="content">
        {{-- Flash messages --}}
        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- Page-specific content --}}
        @yield('content')

    </div>



    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine loaded');
        });

        // document.addEventListener('click', (e) => {
        //     if (e.target.closest('[x-data]')) {
        //         console.log('Clicked inside Alpine scope:', e.target);
        //     }
        // });
    </script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {

            if (window.innerWidth <= 992) {
                // MOBILE
                sidebar.classList.toggle('show');
            } else {
                // DESKTOP
                sidebar.classList.toggle('hidden');
            }
        });
    </script>


</body>

</html>
