@extends('layout.SchoolSideLayout')

@section('title', 'Manual') 

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-8 mt-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Manual</h1>
    <p class="mb-2">Access the DCP System User Manual below:</p>
    <a href="#" class="text-blue-600 underline">Download User Manual (PDF)</a>
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Quick Start Guide</h2>
        <ol class="list-decimal ml-6 text-gray-700">
            <li>Login to your account.</li>
            <li>Update your school profile.</li>
            <li>Check your DCP inventory and submit reports as needed.</li>
        </ol>
    </div>
</div>
@endsection