@extends('layout.SchoolSideLayout')

@section('title', 'School Profile')

@section('content')

    <style>
        .custom-btn-active {
            background-color: #2563eb;
            /* blue */
            color: white;
            padding: 6px 16px;
            border-radius: 6px;
        }

        .custom-btn-inactive {
            background-color: #e5e7eb;
            /* gray */
            border: 1px solid #ccc;
            color: #374151;
            padding: 6px 16px;
            border-radius: 6px;
        }
    </style>
    <div class="  justify-center px-5">
        <div class="max-w-full shadow-lg mt-8 mb-4">
            <div style="border:1px solid #ccc"
                class="bg-white rounded-md tracking-wider  overflow-hidden p-6 flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Logo and School Name (Left) -->
                <div class="flex flex-col items-center md:items-start">
                    <img class="w-40 h-40 max-w-full rounded-full object-cover shadow-lg mb-0" style="border: 1px solid #ccc;"
                        src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
                        alt="Profile Photo">
                    <h2 class="text-2xl font-bold text-gray-800 mt-2 mb-1 md:text-left text-center">
                        {{ Auth::guard('school')->user()->school->SchoolName }}</h2>
                    <div class="text-gray-600  text-base mb-2">School ID: <span
                            class="font-semibold">{{ Auth::guard('school')->user()->school->SchoolID }}</span></div>
                    <div class="text-gray-600  text-base mb-2">Level: <span
                            class="font-semibold">{{ Auth::guard('school')->user()->school->SchoolLevel }}</span></div>
                </div>
                <style>
                    #school-map {
                        position: relative;
                        z-index: 1;
                    }
                </style>
                <!-- Map and location (Right) -->
                <div class="flex flex-col md:block hidden items-center md:items-end justify-start"
                    style="min-width: 240px;">
                    <div id="school-map"
                        style="width: 220px; height: 180px; border-radius: 8px; border: 1px solid #e5e7eb;">
                    </div>
                    <div id="location-name" class="mt-2 text-sm text-gray-700 text-right w-full"></div>
                </div>
            </div>
        </div>
        <div class="flex  flex-row justify-center w-full gap-2 mb-4">
            <button class="custom-btn-active font-medium shadow tracking-wider rounded" onclick="openDiv(1, this)">
                <span class="md:hidden inline-block">1</span>
                <span class="md:block hidden"> School
                    Information
                </span></button>
            <button class="custom-btn-inactive font-medium shadow tracking-wider rounded" onclick="openDiv(2, this)">
                <span class="md:hidden inline-block">2</span>
                <span class="md:block hidden"> School Officials
                </span>
            </button>
            <button class="custom-btn-inactive font-medium shadow tracking-wider rounded" onclick="openDiv(3, this)">

                <span class="md:hidden inline-block">3</span>
                <span class="md:block hidden">School Learners
                </span>
            </button>
        </div>

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
        <div id="div1" class="content-div mb-5 tracking-wide">
            @include('SchoolSide.SchoolsInfo.partials._displaySchoolInfo')
        </div>

        <div id="div2" class="content-div hidden mb-5 tracking-wide">
            @include('SchoolSide.SchoolsInfo.partials._displaySchoolOfficials')

        </div>
        <div id="div3" class="content-div hidden mb-5 tracking-wide">
            @include('SchoolSide.SchoolsInfo.partials._displaySchoolData')

        </div>

    </div>



    @include('SchoolSide.SchoolsInfo.partials._scripts')
    @include('SchoolSide.SchoolsInfo.partials._modalAddSchoolData')
    @include('SchoolSide.SchoolsInfo.partials._modalUpdateSchoolData')
@endsection
