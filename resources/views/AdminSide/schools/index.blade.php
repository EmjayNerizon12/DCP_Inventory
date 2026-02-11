@extends('layout.Admin-Side')

<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        button {
            letter-spacing: 0.05rem;
            font-weight: 500 !important;
        }

        input[type="text"] {
            border: 1px solid #ccc;
            width: 100%;
            min-width: 0;
            box-sizing: border-box;
            font-size: 0.95rem;
            padding: 0.5rem 0.75rem;
        }

        .add-school-flex {
            display: flex;
            flex-direction: row;

            align-items: stretch;
            justify-content: center;
            width: 100%;
        }

        .add-school-col {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 220px;
            flex: 1 1 0;
        }

        .add-school-logo {

            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e5e7eb;
            box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.08);
            margin-bottom: 1rem;
        }

        @media (max-width: 900px) {
            .add-school-flex {
                flex-direction: column;

            }

            .add-school-col {
                min-width: unset;
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('school_add_form').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Hide previous errors
                        const errorDiv = document.getElementById('school-errors');
                        const errorList = document.getElementById('school-errors-list');
                        errorDiv.classList.add('hidden');
                        errorList.innerHTML = '';

                        if (data.success) {
                            // Show styled success message
                            const resultDiv = document.getElementById('school-result');
                            const resultMsg = document.getElementById('school-result-message');
                            resultMsg.innerText = data.message || "School added successfully!";
                            resultDiv.classList.remove('hidden');
                            form.reset();
                        } else if (data.errors) {
                            // Show validation errors
                            errorDiv.classList.remove('hidden');
                            for (const key in data.errors) {
                                data.errors[key].forEach(msg => {
                                    const li = document.createElement('li');
                                    li.textContent = msg;
                                    errorList.appendChild(li);
                                });
                            }
                        } else {
                            alert('Error adding school: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while adding the school.');
                    });
            });
        });

        function deleteSchool(schoolId) {
            if (confirm('Are you sure you want to delete this school?')) {
                fetch(`/schools/${schoolId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const resultDiv = document.getElementById('school-result');
                            const resultMsg = document.getElementById('school-result-message');
                            resultMsg.innerText = data.message || "School deleted successfully!";
                            resultDiv.classList.remove('hidden');


                            const row = document.getElementById(`row-${schoolId}`);
                            if (row) {
                                row.innerHTML = `
                            <td colspan="100%" class="bg-green-100 text-green-700 text-center py-4    rounded">
                           
                                <svg class="w-6 h-6 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            School deleted successfully!
                            </td>
                        `;
                            }



                        } else if (data.errors) {
                            const errorDiv = document.getElementById('school-errors');
                            const errorList = document.getElementById('school-errors-list');
                            errorDiv.classList.remove('hidden');
                            errorList.innerHTML = '';
                            for (const key in data.errors) {
                                data.errors[key].forEach(msg => {
                                    const li = document.createElement('li');
                                    li.textContent = msg;
                                    errorList.appendChild(li);
                                });
                            }

                        } else {
                            alert('Error deleting school: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the school.');
                    });
            }
        }
    </script>
    <div id="school-errors" class="hidden mt-2">
        <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-md" id="school-errors-list"></ul>


    </div>


    <div id="school-result" class="hidden mt-2">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center gap-2 text-md">
            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span id="school-result-message"></span>
        </div>
    </div>
    <div id="add-school-modal"
        class="modal fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">

        <div class="flex flex-col lg:flex-row-reverse gap-4 ">
            <!-- Add School Form -->
            <div class="w-full mx-auto p-0 flex-1 flex flex-col justify-stretch">




                <form id="school_add_form" action="{{ route('store.schools') }}" enctype="multipart/form-data"
                    class="bg-white px-4 py-2 border border-green-500  shadow-lg rounded-lg mt-5 w-full max-full mx-0">
                    @csrf
                    <div class="w-full flex justify-end">
                        <button type="button" onclick="document.getElementById('add-school-modal').classList.add('hidden')"
                            class="    text-gray-600 hover:text-gray-900 text-xl font-bold">
                            &times;
                        </button>
                    </div>
                    <div class=" flex flex-col md:flex-row gap-0 md:gap-4">


                        <!-- Left: Logo -->
                        <div class="add-school-col justify-start md:justify-center" style="flex:1">
                            <img src="{{ asset('icon/logo.png') }}" alt="School Logo"
                                class="w-40 h-40 md:w-80 md:h-80 object-contain" />

                        </div>
                        <!-- Center: School ID and School Name with Submit Button below -->
                        <div class="add-school-col" style="flex:1; align-items: stretch; justify-content: center;">
                            <div class="flex flex-col mb-4">
                                <h2 class="text-2xl font-bold text-blue-700 mb-2">Add School</h2>

                                <label for="SchoolID" class="mb-1 font-medium text-gray-700">School ID</label>
                                <input type="text" name="SchoolID" id="SchoolID"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required />
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="SchoolName" class="mb-1 font-medium text-gray-700">School Name</label>
                                <input type="text" name="SchoolName" id="SchoolName"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required />
                            </div>


                            <div class="flex flex-col mb-4">
                                <label for="SchoolEmailAddress" class="mb-1 font-medium text-gray-700">School Email
                                    Address</label>
                                <input type="email" name="SchoolEmailAddress" id="SchoolEmailAddress"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required />
                            </div>



                            <div class="flex flex-col items-end mt-2">
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition w-full">
                                    Submit
                                </button>
                            </div>
                        </div>

                        <!-- Right: Map and Coordinates -->
                        <div class="add-school-col" style="flex:1; align-items: stretch;">
                            <div class="flex flex-col mb-4">
                                <label for="SchoolLevel" class="mb-1 font-medium text-gray-700">School Level</label>
                                <select name="SchoolLevel" id="SchoolLevel"
                                    class="px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                                    <option value="" disabled selected>-- Select School Level --</option>
                                    <option value="Elementary School">Elementary School</option>
                                    <option value="Junior High School">Junior High School</option>
                                    <option value="Senior High School">Senior High School</option>
                                </select>
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="mb-1 font-medium text-gray-700">School Location (Select on Map)</label>
                                <div id="map"
                                    style="height: 180px; border-radius: 8px; margin-bottom: 8px; z-index: 0"></div>
                                <div class="flex gap-2">
                                    <div class="w-1/2 flex flex-col">
                                        <label for="Latitude" class="mb-1 font-medium text-gray-700">Latitude</label>
                                        <input type="text" name="Latitude" id="latitude"
                                            class="px-3 py-2 border border-gray-300 rounded" placeholder="Latitude" readonly
                                            required>
                                    </div>
                                    <div class="w-1/2 flex flex-col">
                                        <label for="Longitude" class="mb-1 font-medium text-gray-700">Longitude</label>
                                        <input type="text" name="Longitude" id="longitude"
                                            class="px-3 py-2 border border-gray-300 rounded" placeholder="Longitude"
                                            readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function openAddModal() {
            document.getElementById('add-school-modal').classList.remove('hidden');
        }
    </script>



    <!-- Add Leaflet.js for map selector -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Map selector logic
            var map = L.map('map').setView([15.928, 120.348], 12); // Centered on Pangasinan
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            var marker;

            function setLatLng(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }
            map.on('click', function(e) {
                if (marker) map.removeLayer(marker);
                marker = L.marker(e.latlng).addTo(map);
                setLatLng(e.latlng.lat, e.latlng.lng);
            });
            // Auto-search map when School Name changes
            var schoolNameInput = document.getElementById('SchoolName');
            if (schoolNameInput) {
                var schoolNameTimeout;
                schoolNameInput.addEventListener('input', function(e) {
                    clearTimeout(schoolNameTimeout);
                    var value = this.value.trim();
                    if (value.length > 2) {
                        schoolNameTimeout = setTimeout(function() {
                            var query = value + ', San Carlos Pangasinan';
                            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' +
                                    encodeURIComponent(query))
                                .then(function(response) {
                                    return response.json();
                                })
                                .then(function(data) {
                                    if (data && data.length > 0) {
                                        var lat = parseFloat(data[0].lat);
                                        var lon = parseFloat(data[0].lon);
                                        map.setView([lat, lon], 16);
                                        if (marker) map.removeLayer(marker);
                                        marker = L.marker([lat, lon]).addTo(map);
                                        setLatLng(lat, lon);
                                    }
                                })
                                .catch(function(err) {
                                    // Optionally handle error
                                    // console.error('Map search error:', err);
                                });
                        }, 600); // debounce
                    }
                });
            }
        });
    </script>
    <div class=" md:my-5 mx-0 my-0">
        <div class="flex md:flex-row flex-col md:justify-between justify-start items-center text-md mb-2"
            style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;letter-spacing:0.05rem">
            <div class="w-full">
                <div class=" flex justify-start gap-2 items-center ">
                    <div
                        class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                        <div class="text-white bg-blue-600 p-2 rounded-full">
                            <svg viewBox="0 0 24 24" class="h-10 w-10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M21 10L12 5L3 10L6 11.6667M21 10L18 11.6667M21 10V10C21.6129 10.3064 22 10.9328 22 11.618V16.9998M6 11.6667L12 15L18 11.6667M6 11.6667V17.6667L12 21L18 17.6667L18 11.6667"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div style="letter-spacing: 0.05rem  ">
                        <h2 class="text-2xl font-bold text-gray-700">School List</h2>
                        <div class="text-lg text-gray-600  ">List of Schools under DepEd Computerization Program
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex items-center md:justify-end justify-start w-full mb-2">
                <button class="bg-blue-600 hover:bg-blue-700 shadow-md text-md text-white py-2 px-4 rounded"
                    onclick="openAddModal()" type="button">
                    + Add New School
                </button>
            </div>
        </div>

        <input type="text" id="searchSchool" placeholder="Search School..."
            class="w-1/3 mb-4 px-3 py-2 border rounded shadow focus:outline-blue-400" />


        <!-- Card Grid -->
        <div id="schoolCardGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($schools as $school)
                <div id="row-{{ $school->pk_school_id }}"
                    class="bg-white border border-gray-300 shadow-md rounded-md p-4 hover:shadow-lg transition flex flex-col">

                    <!-- School Logo -->
                    <div class="flex justify-center">
                        <img class="object-cover rounded-full border w-28 h-28"
                            src="{{ $school->image_path ? asset('school-logo/' . $school->image_path) : asset('icon/logo.png') }}"
                            alt="">
                    </div>

                    <!-- School Info -->
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-bold text-gray-800">{{ $school->SchoolName }}</h3>
                        <p class="text-sm text-gray-500">{{ $school->SchoolID }} • {{ $school->SchoolLevel }}</p>
                        <p class="text-sm text-gray-600 mt-2">{{ $school->SchoolEmailAddress }}</p>
                        <p class="text-xs text-gray-400 mt-1">
                            Last Login:
                            @php
                                $user_login = App\Models\SchoolUser::where(
                                    'pk_school_id',
                                    $school->pk_school_id,
                                )->value('last_login');
                            @endphp
                            {{ $user_login ? \Carbon\Carbon::parse($user_login)->format('F j, Y, g:iA') : 'No login yet' }}
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4">
                        <form action="{{ route('notify.school', $school->pk_school_id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full bg-green-600  shadow-md text-md hover:bg-green-700 text-white py-1 px-4 rounded">
                                Notify School's ICT Coor.
                            </button>
                        </form>
                    </div>

                    <div class=" flex flex-row gap-2">

                        <a href="{{ route('schools.show', $school->pk_school_id) }}" style="letter-spacing:0.05rem"
                            class="w-full text-center px-3 py-1 text-md  shadow-md  font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                            Details
                        </a>

                        <button
                            onclick="showEditSchoolForm(
                        '{{ $school->pk_school_id }}',
                        '{{ $school->SchoolID }}',
                        '{{ $school->SchoolName }}',
                        '{{ $school->SchoolLevel }}',
                        '{{ $school->SchoolEmailAddress }}'
                         )"
                            class="w-full px-3 py-1 font-medium shadow-md text-md  text-white bg-yellow-500 rounded hover:bg-yellow-500">
                            Edit
                        </button>

                        <button type="button" onclick="deleteSchool('{{ $school->pk_school_id }}')"
                            class="w-full px-3 py-1 font-medium shadow-md   text-md text-white bg-red-600 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 mb-5">
            {{ $schools->links() }}
        </div>


    </div>
    <div id="school-edit-modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 border border-green-500 w-full max-w-4xl relative">
            <button type="button" onclick="cancelSchoolEdit()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

            <form id="school-edit-form" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="pk_school_id" id="edit_pk_school_id">

                <h2 class="text-2xl font-bold mb-4">
                    Edit School Information
                    <span class="bg-green-500 text-white py-1 px-2 rounded-xl text-sm font-normal">Edit</span>
                </h2>

                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="w-full md:w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">School ID</label>
                        <input type="text" name="SchoolID" id="edit_SchoolID"
                            class="shadow border border-gray-300 rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                    <div class="w-full md:w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">School Name</label>
                        <input type="text" name="SchoolName" id="edit_SchoolName"
                            class="shadow border border-gray-300 rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="w-full md:w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">School Level</label>


                        <select name="SchoolLevel" id="edit_SchoolLevel"
                            class="shadow border border-gray-300 rounded w-full py-2 px-3 text-gray-700" required>



                            <option value="Elementary School">Elementary School</option>
                            <option value="Junior High School">Junior High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" name="SchoolEmailAddress" id="edit_SchoolEmailAddress"
                            class="shadow border border-gray-300 rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                </div>


                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white py-1 px-4 rounded">Update</button>
                    <button type="button" onclick="cancelSchoolEdit()"
                        class="bg-gray-400 hover:bg-gray-600 text-white py-1 px-4 rounded ml-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function showEditSchoolForm(pk_school_id, schoolID, schoolName, schoolLevel, email, ) {
            // Fill form fields
            document.getElementById('edit_pk_school_id').value = pk_school_id;
            document.getElementById('edit_SchoolID').value = schoolID;
            document.getElementById('edit_SchoolName').value = schoolName;
            document.getElementById('edit_SchoolLevel').value = schoolLevel;
            document.getElementById('edit_SchoolEmailAddress').value = email;

            // Set action URL dynamically
            document.getElementById('school-edit-form').action = `/update-school/${pk_school_id}`;

            // Show modal
            document.getElementById('school-edit-modal').classList.remove('hidden');
        }

        function cancelSchoolEdit() {
            document.getElementById('school-edit-modal').classList.add('hidden');
            document.getElementById('school-edit-form').reset();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $('#searchSchool').on('keyup', function() {
            const keyword = $(this).val();

            $.ajax({
                url: '/Admin/schools/search',
                type: 'GET',
                data: {
                    query: keyword
                },
                success: function(data) {
                    let cards = '';
                    if (data.length > 0) {
                        data.forEach(school => {
                            cards += `
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 flex flex-col items-center text-center transition hover:shadow-lg">
                            <img class="w-24 h-24 object-cover rounded-full mb-3"
                                src="${school.image_path ? '/school-logo/' + school.image_path : '/icon/logo.png'}"
                                alt="School Logo">
                            <h3 class="text-lg font-semibold text-gray-800">${school.SchoolName}</h3>
                            <p class="text-sm text-gray-600">${school.SchoolLevel}</p>
                            <p class="text-sm text-gray-500">${school.SchoolEmailAddress ?? ''}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                ${school.school_user && school.school_user.last_login
                                    ? new Date(school.school_user.last_login).toLocaleString("en-US", {
                                        month: "long",
                                        day: "numeric",
                                        year: "numeric",
                                        hour: "numeric",
                                        minute: "2-digit",
                                        hour12: true
                                      })
                                    : 'No login yet'}
                            </p>
                            <div class="  mt-4 w-full">
                                 <form action="/send-mail/${school.pk_school_id}" method="POST" class="w-full">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <button type="submit"
                                        class="w-full bg-green-600 shadow-md  text-md hover:bg-green-700 text-white py-1 px-4 rounded">
                                        Notify School ICT Coor.
                                    </button>
                                </form>
                                 </div>
                            <div class=" flex flex-row gap-2 w-full">
                               
                                <a href="/schools/${school.pk_school_id}"
                                  style="letter-spacing:0.005rem;"  class="w-full px-3 py-1 text-white  shadow-md text-md font-medium bg-blue-600 rounded hover:bg-blue-700 text-center">
                                    Details
                                </a>
                                <button
                                    onclick="showEditSchoolForm(
                                        '${school.pk_school_id}',
                                        '${school.SchoolID}',
                                        '${school.SchoolName}',
                                        '${school.SchoolLevel}',
                                        '${school.SchoolEmailAddress}'
                                    )"
                                    class="w-full px-3 py-1 text-md text-white font-medium shadow-md  bg-yellow-500 rounded hover:bg-yellow-500">
                                    Edit
                                </button>
                                <button type="button" onclick="deleteSchool('${school.pk_school_id}')"
                                    class="w-full px-3 py-1 text-md text-white shadow-md font-medium bg-red-600 rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </div>
                        </div>`;
                        });
                    } else {
                        cards =
                            `<p class="col-span-full text-center text-gray-500">No results found.</p>`;
                    }

                    $('#schoolCardGrid').html(cards); // target your card grid container
                }
            });
        });
    </script>
@endsection
