@extends('layout.SchoolSideLayout')

@section('title', 'School Profile')

@section('content')


    <div class="md:p-6 p-2">

        <div class="space-x-4 hidden">
            <div class="page-title">School Information Page </div>
            <div class="page-subtitle">School's Important Data and Information</div>

        </div>
        <div class="flex flex-col justify-center border border-gray-300 max-w-4xl p-2 w-full mx-auto">


            <div class="max-w-4xl w-full mx-auto shadow-md">
                <div class="h-50 overflow-hidden flex items-center justify-center rounded mb-4">

                    <img class="w-full shadow-md" src="{{ asset('icon/header.png') }}" alt="">

                </div>
                <div class="flex flex-row items-center justify-start gap-4">
                    <div class="relative group">
                        <!-- Profile Image -->
                        <div class="shadow-md p-1 border border-gray-300 rounded-full">
                            <img id="schoolPreview" class="md:w-40 md:h-40 h-20 w-20 rounded-full object-cover"
                                src="{{ Auth::guard('school')->user()->school->image_path
                                    ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
                                    : asset('icon/logo.png') }}"
                                alt="Profile Photo">
                        </div>
                        <div id="camera-button"
                            class="absolute bottom-2 right-2
                            text-white p-2 
                             md:h-12 h-8 md:w-12 w-8 bg-white p-1
                            border border-gray-300 
                            shadow-md rounded-full flex items-center justify-center">

                            <button type="button" onclick="document.getElementById('schoolImageInput').click()"
                                class="text-white bg-gray-600 hover:bg-gray-700 p-1 rounded-full">
                                <svg class="md:w-8 md:h-8 w-4 h-4" fill="currentColor" viewBox="0 -2 28 28"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="m13.846 9.692c2.293.004 4.15 1.862 4.154 4.154v.004c0 2.294-1.86 4.154-4.154 4.154s-4.154-1.86-4.154-4.154c0-1.148.466-2.187 1.218-2.939.728-.753 1.747-1.22 2.876-1.22h.063-.003zm10.154-6h.055c1.002 0 1.908.414 2.554 1.081l.001.001c.668.647 1.082 1.553 1.082 2.555v.058-.003 12.924c-.001 2.039-1.653 3.691-3.692 3.692h-20.308c-2.039-.001-3.691-1.653-3.692-3.692v-12.923c0-.016 0-.036 0-.055 0-1.002.414-1.908 1.081-2.554l.001-.001c.647-.668 1.553-1.082 2.555-1.082h.058-.003 3.23l.735-1.962c.212-.507.557-.922.993-1.213l.01-.006c.411-.311.929-.501 1.49-.512h.002 7.385c.564.011 1.081.201 1.499.517l-.006-.005c.445.297.791.712.996 1.201l.007.018.735 1.962zm-10.154 16.616c.027 0 .059.001.091.001 1.755 0 3.341-.727 4.472-1.896l.002-.002c1.171-1.133 1.897-2.719 1.897-4.474 0-.032 0-.064-.001-.096v.005c0-.027.001-.06.001-.092 0-1.755-.727-3.341-1.896-4.472l-.002-.002c-1.167-1.172-2.781-1.897-4.565-1.897s-3.398.725-4.565 1.896c-1.171 1.133-1.897 2.719-1.897 4.474 0 .032 0 .064.001.096v-.005c0 .028-.001.061-.001.094 0 1.755.726 3.34 1.894 4.471l.002.002c1.133 1.171 2.719 1.897 4.474 1.897.033 0 .065 0 .097-.001h-.005z">
                                        </path>
                                    </g>
                                </svg>
                            </button>

                        </div>
                        <!-- Hidden File Input -->
                        <input type="file" id="schoolImageInput" class="hidden" accept="image/*">
                        <!-- Action Buttons -->
                        <div id="imageActions" class="hidden mt-3 flex justify-center gap-2">
                            <button onclick="cancelImage()"
                                class="px-3 py-1 text-sm shadow font-medium text-gray-600 border border-gray-300 rounded hover:bg-gray-100">
                                Cancel
                            </button>
                            <button onclick="saveImage()"
                                class="px-3 py-1 text-sm text-white font-medium bg-blue-600 rounded hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </div>
                    <script>
                        let selectedFile = null;
                        const originalSrc = document.getElementById('schoolPreview').src;

                        document.getElementById('schoolImageInput').addEventListener('change', function(e) {
                            selectedFile = e.target.files[0];
                            if (!selectedFile) return;

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('schoolPreview').src = e.target.result;
                            };
                            reader.readAsDataURL(selectedFile);

                            document.getElementById('imageActions').classList.remove('hidden');
                            document.getElementById('camera-button').classList.add('hidden');
                        });

                        function cancelImage() {
                            document.getElementById('schoolPreview').src = originalSrc;
                            document.getElementById('schoolImageInput').value = '';
                            document.getElementById('imageActions').classList.add('hidden');
                            selectedFile = null;
                            document.getElementById('camera-button').classList.remove('hidden');

                        }

                        function saveImage() {
                            if (!selectedFile) return;

                            const formData = new FormData();
                            formData.append('school_image', selectedFile);
                            formData.append('_token', '{{ csrf_token() }}');

                            fetch('/School/upload-school-logo', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        document.getElementById('schoolPreview').src = data.image;
                                        document.getElementById('school-logo').src = data.image;
                                        document.getElementById('camera-button').classList.remove('hidden');

                                        document.getElementById('imageActions').classList.add('hidden');
                                        alert('Image uploaded successfully');
                                    } else {
                                        alert('Upload failed');
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    alert('Something went wrong');
                                });
                        }
                    </script>

                    <div>

                        <div class="page-title ">

                            {{ Auth::guard('school')->user()->school->SchoolName }}</h2>
                        </div>
                        <div class="page-subtitle">Level: <span>
                                {{ Auth::guard('school')->user()->school->SchoolLevel }}
                            </span></div>
                        <div
                            class="text-white w-fit text-center shadow-md my-2 bg-blue-600 rounded px-4 py-1 text-base font-medium ">
                            {{ Auth::guard('school')->user()->school->SchoolID }}
                        </div>
                    </div>
                </div>
                <hr class="my-4 mx-2 h-1 border border-gray-200 rounded bg-gray-700">
                <div class="flex  flex-row justify-start w-full gap-2 mb-2 ">
                    <div class="tab-btn px-4 py-1 text-base text-gray-400 border-b-2 font-medium border-transparent"
                        onclick="openDiv(1, this)">
                        <span class="md:hidden inline-block">1</span>
                        <span class="md:block hidden">School Information</span>
                    </div>
                    <div class="tab-btn px-4 py-1 text-base text-gray-400 border-b-2 font-medium  border-transparent"
                        onclick="openDiv(2, this)">
                        <span class="md:hidden inline-block">2</span>
                        <span class="md:block hidden">School Officials</span>
                    </div>
                    <div class="tab-btn px-4 py-1 text-base text-gray-400 border-b-2 font-medium  border-transparent"
                        onclick="openDiv(3, this)">
                        <span class="md:hidden inline-block">3</span>
                        <span class="md:block hidden">School Learners</span>
                    </div>


                </div>
            </div>
            <div class="hidden">
                <div style="border:1px solid #ccc"
                    class="bg-white rounded-md tracking-wider  overflow-hidden p-6 items-center justify-between gap-8">
                    <!-- Logo and School Name (Left) -->

                    <h2 class="text-2xl font-bold text-gray-800   md:text-left  ">
                        {{ Auth::guard('school')->user()->school->SchoolName }}</h2>
                    <div class="text-gray-600  text-base  ">School ID: <span
                            class="font-semibold">{{ Auth::guard('school')->user()->school->SchoolID }}</span></div>
                    <div class="text-gray-600  text-base  ">Level: <span
                            class="font-semibold">{{ Auth::guard('school')->user()->school->SchoolLevel }}</span></div>
                    <div class="flex gap-2 my-4">
                        <img class="md:w-20 md:h-20 h-14 w-14 max-w-full rounded-full object-cover shadow-md mb-0"
                            src="{{ asset('icon/sdo-logo.png') }}" alt="Profile Photo">
                        <img class="md:w-20 md:h-20 h-14 w-14 max-w-full rounded-full object-cover shadow-md mb-0"
                            src="{{ asset('icon/logo.png') }}" alt="Profile Photo">
                        <img class="md:w-20 md:h-20 h-14 w-14 max-w-full rounded-full object-cover shadow-md mb-0"
                            src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                            alt="Profile Photo">
                    </div>
                    <style>
                        #school-map {
                            position: relative;
                            z-index: 1;
                        }
                    </style>
                    <!-- Map and location (Right) -->
                    <div class="flex flex-col md:block hidden  items-center md:items-end justify-start my-4"
                        style="min-width: 240px;">
                        <div id="school-map" class="border border-gray-300 shadow-md" style="width: 220px; height: 180px; ">
                        </div>
                        <div id="location-name" class="mt-2 text-sm text-gray-700 text-left w-full"></div>
                    </div>
                </div>

            </div>

            <div class="max-h-full overflow-hidden">
                @php
                    $schoolLevel = Auth::guard('school')->user()->school->SchoolLevel ?? '';
                    $gradeLevels = [];
                    if ($schoolLevel === 'Elementary School') {
                        $gradeLevels = [
                            ['id' => 'K', 'name' => 'Kinder'],
                            ['id' => '1', 'name' => 'Grade I'],
                            ['id' => '2', 'name' => 'Grade II'],
                            ['id' => '3', 'name' => 'Grade III'],
                            ['id' => '4', 'name' => 'Grade IV'],
                            ['id' => '5', 'name' => 'Grade V'],
                            ['id' => '6', 'name' => 'Grade VI'],
                        ];
                    } elseif ($schoolLevel === 'Junior High School') {
                        $gradeLevels = [['id' => 'JHS', 'name' => 'Junior High School']];
                    } elseif ($schoolLevel === 'Senior High School') {
                        $gradeLevels = [['id' => 'SHS', 'name' => 'Senior High School']];
                    }
                @endphp
                <div id="div1" class="content-div  tracking-wide py-4 max-h-full overflow-y-auto thin-scroll">
                    @include('SchoolSide.SchoolsInfo.partials._displaySchoolInfo')
                </div>

                <div id="div2" class="content-div hidden tracking-wide  py-4  max-h-full overflow-y-auto thin-scroll">
                    @include('SchoolSide.SchoolsInfo.partials._displaySchoolOfficials')

                </div>
                <div id="div3" class="content-div hidden   py-4  tracking-wide max-h-full overflow-y-auto thin-scroll">
                    @include('SchoolSide.SchoolsInfo.partials._displaySchoolData')

                </div>
            </div>
        </div>
    </div>



    @include('SchoolSide.SchoolsInfo.partials._scripts')
    @include('SchoolSide.SchoolsInfo.partials._modalAddSchoolData')
    @include('SchoolSide.SchoolsInfo.partials._modalUpdateSchoolData')
@endsection
