@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        th {
            text-transform: uppercase;
            letter-spacing: 0.05rem
        }

        td {
            letter-spacing: 0.05rem
        }

        button {
            letter-spacing: 0.05rem;
            font-weight: 500 !important;
            border-radius: 5px !important;
        }
    </style>
    <div class=" md:my-5 mx-0 my-0">

        <div class=" flex justify-start gap-2 my-2 items-center ">
            <div
                class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                <div class="text-white bg-blue-600 p-2 rounded-full">
                    <svg viewBox="0 -2 20 20" class="w-10 h-10" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <desc>Created with Sketch.</desc>
                            <defs> </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-60.000000, -3681.000000)"
                                    fill="currentColor">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path
                                            d="M11.9795939,3535.00003 C11.9795939,3536.00002 12.8837256,3537 14,3537 C15.1162744,3537 16.0204061,3536.00002 16.0204061,3535.00003 C16.0204061,3532.00008 11.9795939,3532.00008 11.9795939,3535.00003 M9.71370846,3530.7571 L11.1431458,3532.17208 C12.7180523,3530.6121 15.2819477,3530.6121 16.8568542,3532.17208 L18.2862915,3530.7571 C15.9183756,3528.41413 12.0816244,3528.41413 9.71370846,3530.7571 M4,3525.10019 L5.42842711,3526.51516 C10.1551672,3521.83624 17.8448328,3521.83624 22.5715729,3526.51516 L24,3525.10019 C18.4772199,3519.63327 9.52278008,3519.63327 4,3525.10019 M21.1431458,3527.92914 L19.7147187,3529.34312 C16.5638953,3526.22417 11.4361047,3526.22417 8.28528134,3529.34312 L6.85685423,3527.92914 C10.8016971,3524.0242 17.1983029,3524.0242 21.1431458,3527.92914"
                                            id="wifi-[currentColor]"> </path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div style="letter-spacing: 0.05rem">
                <h2 class="text-2xl font-bold text-gray-800 uppercase">Internet Service Providers Details</h2>
                <div class="text-lg text-gray-600 ">Create, View, Edit and Remove Details</div>

            </div>
        </div>



        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-4 gap-2  mb-10">
            {{-- INTERNET SERVICE PROVIDERS --}}
            @include('AdminSide.ISP.Crud.provider')


            {{-- ISP CONNECTION TYPE --}}

            @include('AdminSide.ISP.Crud.connectionType')

            {{-- ISP AREA LOCATION  --}}
            @include('AdminSide.ISP.Crud.area')

            {{-- ISP QUALITY TYPE  --}}
            @include('AdminSide.ISP.Crud.internetQuality')

        </div>
    </div>
    <br>
    <script>
        function deleteFunction(id, target_content) {
            if (target_content == 'ISPConnectionType') {
                if (confirm('Are you sure you want to delete this ISP?')) {
                    fetch('/Admin/ISP/delete-connection/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else if (target_content == 'ISP') {
                if (confirm('Are you sure you want to delete this ISP?')) {
                    fetch('/Admin/ISP/delete-list/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else if (target_content == 'Area') {
                if (confirm('Are you sure you want to delete this Area for ISP?')) {
                    fetch('/Admin/ISP/delete-area/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP Area deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            } else if (target_content == "Quality") {
                if (confirm('Are you sure you want to delete this Quality for ISP?')) {
                    fetch('/Admin/ISP/delete-quality/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                alert('ISP Quality deleted successfully!');
                                location.reload();
                            } else {
                                alert('Failed to delete ISP.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            }

        }

        function closeAddISPModal(target_content, type) {
            if (target_content == 'ISPConnectionType') {
                if (type == 'edit') {
                    document.getElementById('edit-connection-modal').classList.add('hidden');
                }

                document.getElementById('add-connection-modal').classList.add('hidden');

            } else if (target_content == 'ISP') {
                if (type == 'edit') {
                    document.getElementById('edit-isp-modal').classList.add('hidden');
                }

                document.getElementById('add-isp-modal').classList.add('hidden');
            } else if (target_content == 'Area') {
                if (type == 'edit') {
                    document.getElementById('edit-area-modal').classList.add('hidden');
                }

                document.getElementById('add-area-modal').classList.add('hidden');
            } else if (target_content == "Quality") {
                if (type == 'edit') {
                    document.getElementById('edit-quality-modal').classList.add('hidden');
                }
                document.getElementById('add-quality-modal').classList.add('hidden');
            }
        }

        function showAddISPModal(target_content) {
            if (target_content == 'ISPConnectionType') {

                document.getElementById('add-connection-modal').classList.remove('hidden');

            } else if (target_content == 'ISP') {

                document.getElementById('add-isp-modal').classList.remove('hidden');
            } else if (target_content == 'Area') {

                document.getElementById('add-area-modal').classList.remove('hidden');
            } else if (target_content == "Quality") {

                document.getElementById('add-quality-modal').classList.remove('hidden');
            }
        }

        function showEditISPModal(id, name, target_content) {
            if (target_content == 'ISP') {

                document.getElementById('edit-isp-modal').classList.remove('hidden');
                document.getElementById('isp_list_id').value = id;
                document.getElementById('isp_name').value = name;
            } else if (target_content == 'ISPConnectionType') {

                document.getElementById('edit-connection-modal').classList.remove('hidden');
                document.getElementById('isp_connection_type_id').value = id;
                document.getElementById('isp_connection_type_name').value = name;
            } else if (target_content == 'Area') {

                document.getElementById('edit-area-modal').classList.remove('hidden');
                document.getElementById('isp_area_id').value = id;
                document.getElementById('isp_area_name').value = name;
            } else if (target_content == "Quality") {
                document.getElementById('edit-quality-modal').classList.remove('hidden');
                document.getElementById('isp_quality_id').value = id;
                document.getElementById('isp_quality_name').value = name;
            }
        }
    </script>
@endsection
