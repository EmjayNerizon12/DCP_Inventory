@extends('layout.SchoolSideLayout')

@section('title', 'DCP Service Report')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-8 mt-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">DCP Service Report</h1>
    <p class="mb-2">View and submit service reports for your DCP equipment.</p>
    <div class="bg-blue-50 p-4 rounded mb-4">
        <strong>Sample Service Report:</strong>
        <ul class="list-disc ml-6 text-gray-700">
            <li>Date: 2025-06-27</li>
            <li>Equipment: Laptop</li>
            <li>Issue: Battery not charging</li>
            <li>Status: Pending</li>
        </ul>
    </div>
    <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit New Report</a>
</div>
@endsection