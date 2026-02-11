<div id="school_others" class=" col-span-4 flex md:flex-row max-w-xl md:mx-auto   flex-col gap-2 overflow-hidden ">
    <!-- Table of Submitted Data -->
    @if (isset($schoolData) && count($schoolData))
        <div>

            <div class="text-2xl font-bold tracking-wider my-2 text-center w-full text-blue-600 uppercase  ">School
                Learners Data
            </div>
            <div class="shadow-md border border-gray-300  rounded-sm p-4 ">
                <div
                    class="h-12 w-12  my-2  bg-white p-1 border border-gray-300  shadow-md rounded-full flex items-center justify-center">

                    <button type="button" onclick="addSchoolData()" class="btn-submit  p-1 rounded-full">
                        <svg class="w-8 h-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>



                @foreach ($schoolData as $data)
                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-5 border border-gray-800">

                            <!-- Grade Level -->
                            <div
                                class="flex flex-col text-center px-2 py-2 items-center justify-center bg-green-200
                    border-b md:border-b-0 md:border-r border-gray-800">
                                <label class="text-gray-700 font-normal">Grade Level</label>
                                <div class="text-gray-800 text-lg font-bold">
                                    {{ collect($gradeLevels)->firstWhere('id', $data->GradeLevelID)['name'] ?? $data->GradeLevelID }}
                                </div>
                            </div>

                            <!-- Learners -->
                            <div
                                class="flex flex-col text-center items-center justify-center p-2 bg-red-200
                 border-b md:border-b-0 md:border-r border-gray-800">
                                <label class="text-gray-700 font-normal">Learners</label>
                                <div class="text-gray-800 text-lg font-bold">{{ $data->RegisteredLearners }}
                                </div>
                            </div>

                            <!-- Teachers -->
                            <div
                                class="flex flex-col text-center items-center justify-center p-2 bg-blue-200
                  border-b md:border-b-0 md:border-r border-gray-800">
                                <label class="text-gray-700 font-normal">Teachers</label>
                                <div class="text-gray-800 text-lg font-bold">{{ $data->Teachers }}</div>
                            </div>

                            <!-- Sections -->
                            <div
                                class="flex flex-col text-center items-center justify-center p-2 bg-purple-200
                   border-b md:border-b-0 md:border-r border-gray-800">
                                <label class="text-gray-700 font-normal">Sections</label>
                                <div class="text-gray-800 text-lg font-bold">{{ $data->Sections }}</div>
                            </div>

                            <!-- Classrooms -->
                            <div
                                class="flex flex-col text-center items-center justify-center p-2 bg-yellow-200
                    border-b-0   border-gray-800">
                                <label class="text-gray-700 font-normal">Classrooms</label>
                                <div class="text-gray-800 text-lg font-bold">{{ $data->Classrooms }}</div>
                            </div>

                            <!-- Actions -->

                        </div>
                        <div class="gap-2 w-full p-2 flex justify-start items-center p-0 bg-white">

                            <div
                                class="h-12 w-12 bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                                <button title="Edit Data" class="btn-update p-1 rounded-full"
                                    onclick="showEditForm({{ $data->ID }}, '{{ $data->GradeLevelID }}',{{ $data->RegisteredLearners }},{{ $data->Teachers }},{{ $data->Sections }},{{ $data->Classrooms }})">
                                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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

                                <button type="button" title="Remove Data"
                                    onclick="delete_school_data({{ $data->ID }})"
                                    class="btn-delete p-1 rounded-full">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
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

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white w-full p-6 " style="border:1px solid #ccc">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-2xl font-semibold text-blue-700  ">Submitted School Data</h3>
                    <div class="text-gray-500 mb-4 text-sm">List of encoded data </div>
                    <button onclick="addSchoolData()"
                        class="bg-blue-600 hover:bg-blue-700  text-base text-white py-2 px-4  rounded tracking-wider font-medium shadow ">Encode
                        School Data</button>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-2 my-2">

                <div class="flex flex-col text-center px-2 py-2 items-center justify-center bg-green-200 "
                    style="border:1px solid #282828">
                    <label class="text-gray-700 font-normal">Grade Level</label>

                </div>
                <div
                    class="flex flex-col  text-center items-center justify-center p-2 bg-red-200"style="border:1px solid #282828">
                    <label class="text-gray-700 font-normal  font-xl">Learners</label>
                </div>

                <div
                    class="flex flex-col  text-center items-center justify-center p-2 bg-blue-200"style="border:1px solid #282828">
                    <label class="text-gray-700 font-normal  font-xl">Teachers</label>
                </div>
                <div
                    class="flex flex-col p-2 text-center  items-center justify-center text-center bg-purple-200"style="border:1px solid #282828">
                    <label class="text-gray-700 font-normal  font-xl">Sections</label>
                </div>
                <div
                    class="flex flex-col p-2  text-center items-center justify-center bg-yellow-200"style="border:1px solid #282828">
                    <label class="text-gray-700 font-normal  font-xl">Classrooms</label>

                </div>

            </div>
            <div class="text-center text-gray-500 text-lg mt-12 mb-12 font-[Verdana]">
                No school data found.
            </div>
        </div>
    @endif

</div>
