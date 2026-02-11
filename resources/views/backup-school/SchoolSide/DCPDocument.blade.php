@extends('layout.SchoolSideLayout')
@section('title', 'DCP Documents')


@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-8 mt-8">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">DCP Documents</h1>
    <p class="mb-2">Download and upload DCP-related documents here.</p>
    <ul class="list-disc ml-6 text-gray-700">
        <li><a href="#" class="text-blue-600 underline">DCP Guidelines.pdf</a></li>
        <li><a href="#" class="text-blue-600 underline">Inventory Template.xlsx</a></li>
    </ul>
    <form class="mt-6">
        <label class="block mb-2 font-semibold">Upload New Document:</label>
        <input type="file" class="mb-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Upload</button>
    </form>
</div>
@endsection