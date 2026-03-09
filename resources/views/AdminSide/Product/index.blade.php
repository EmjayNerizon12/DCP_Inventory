@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <style>
        th {
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }

        td {
            letter-spacing: 0.05rem;
        }

        button {
            letter-spacing: 0.05rem;
            font-weight: 500 !important;
            border-radius: 5px !important;
        }
    </style>

    <div class="my-5 flex justify-start gap-2 items-center">
        <div class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
            <div class="text-white bg-blue-600 p-2 rounded-full">
                <svg fill="currentColor" class="w-10 h-10" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.12 4 8.62.85a1.28 1.28 0 0 0-1.24 0L1.88 4a1.25 1.25 0 0 0-.63 1.09V11a1.25 1.25 0 0 0 .63 1l5.5 3.11a1.28 1.28 0 0 0 1.24 0l5.5-3.11a1.25 1.25 0 0 0 .63-1V5.05A1.25 1.25 0 0 0 14.12 4zm-6.74 9.71-2.13-1.2v-5.3l2.13 1.16zM8 7.29 5.92 6.15l4.81-2.67 2.09 1.18zm0-5.35 1.46.82-4.84 2.69-1.44-.79zM2.5 5.71l1.5.82v5.27L2.5 11zm6.12 8V8.37l4.88-2.66V11z"/>
                </svg>
            </div>
        </div>

        <div>
            <div class="text-2xl font-bold text-gray-700">DCP Products Details</div>
            <div class="text-lg font-normal text-gray-600">Create, View, Edit and Remove Details</div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 grid-cols-1 gap-2 my-5">
        @php
            $lookupCards = [
                ['type' => 'delivery_mode', 'title' => 'Delivery Mode'],
                ['type' => 'delivery_condition', 'title' => 'Item Condition Upon Delivery'],
                ['type' => 'supplier', 'title' => 'Supplier Name'],
                ['type' => 'brand', 'title' => 'Brand Name'],
                ['type' => 'current_condition', 'title' => 'Item Current Condition'],
                ['type' => 'assigned_user_type', 'title' => 'Assigned User Types for DCP Items'],
                ['type' => 'assigned_location', 'title' => 'Assigned Location for DCP Items'],
            ];
        @endphp

        @foreach ($lookupCards as $card)
            @include('AdminSide.Product.Crud._lookupCrud', [
                'type' => $card['type'],
                'title' => $card['title'],
                'items' => $itemsByType[$card['type']] ?? collect(),
            ])
        @endforeach
    </div>
@endsection
