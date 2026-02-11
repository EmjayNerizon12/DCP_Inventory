{{-- filepath: c:\Users\Em-jay\dcp_inventory_system\resources\views\SchoolSide\DCPBatch\Batch.blade.php --}}

@extends('layout.SchoolSideLayout')

@section('title', 'My DCP Batches')

@section('content')
    <div class=" overflow-hidden md:p-6 p-2  ">
        <div class="flex justify-start  mb-4  space-x-2">
            <div class="md:flex hidden justify-center items-start">
                {{-- <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg class="w-10 h-10" fill="currentColor" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 612 612" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path
                                        d="M1.659,484.737L1.001,206.595c-0.032-13.686,13.95-22.938,26.534-17.559l253.206,108.241 c6.997,2.991,11.542,9.859,11.56,17.468l0.658,278.142c0.032,13.687-13.95,22.939-26.534,17.56L13.219,502.206 C6.222,499.215,1.676,492.347,1.659,484.737z M581.805,219.687L348.142,320.883l0.608,257.406l233.664-101.196L581.805,219.687 M591.26,186.131c10.043-0.025,19.056,8.054,19.081,19.022l0.658,278.142c0.018,7.609-4.495,14.5-11.478,17.523l-252.69,109.438 c-2.493,1.079-5.047,1.583-7.534,1.59c-10.044,0.023-19.058-8.055-19.083-19.022l-0.658-278.143 c-0.019-7.609,4.495-14.5,11.479-17.523l252.69-109.437C586.218,186.64,588.771,186.137,591.26,186.131L591.26,186.131z M304.152,29.466L61.767,137.691l242.894,107.075l242.386-108.224L304.152,29.466 M304.083,0c2.632-0.006,5.266,0.533,7.728,1.618 l266.403,117.439c15.112,6.663,15.163,28.088,0.082,34.821L312.451,272.577c-2.456,1.097-5.088,1.648-7.721,1.655 c-2.632,0.006-5.266-0.533-7.728-1.618L30.6,155.175c-15.113-6.662-15.163-28.088-0.083-34.821L296.361,1.655 C298.818,0.558,301.449,0.006,304.083,0L304.083,0z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div> --}}
            </div>
            <div class="tracking-wide">
                <h1 class="page-title">
                    School DCP Batch Received
                </h1>
                <div class="page-subtitle">Here are the list of DCP Batches for your school.
                </div>
            </div>



        </div>
        <div class="overflow-x-auto rounded-sm md:border-none shadow-md md:shadow-none hidden">
            <table class="min-w-full border text-left  ">
                <thead>
                    <tr>
                        <td class="top-header" colspan="8">

                            DCP BATCH
                        </td>
                    </tr>
                    <tr>
                        <th class="sub-header whitespace-nowrap   ">
                            No.</th>
                        <th class="sub-header whitespace-nowrap   ">
                            Batch Label</th>
                        <th class="sub-header whitespace-nowrap   ">
                            DCP Items</th>
                        <th class="sub-header whitespace-nowrap   ">
                            DCP Files</th>
                        {{-- <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap   ">
                            Package Type</th> --}}
                        {{-- <th
                            class="px-4 py-2 font-semibold border-b border-gray-300 uppercase whitespace-nowrap  ">
                            Budget Year</th> --}}
                        <th class="sub-header    whitespace-nowrap  ">
                            Delivery Date</th>
                        <th class="sub-header    tracking-wider  ">
                            Supplier</th>
                        <th class="sub-header     ">
                            Status</th>
                        <th class="sub-header      ">
                            Submit</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @include('SchoolSide.DCPBatch.partials.Batch._tableList')
                </tbody>
            </table>


        </div>
        <div>
            @include('SchoolSide.DCPBatch.partials.Batch._cardList')
        </div>
    </div>
@endsection
