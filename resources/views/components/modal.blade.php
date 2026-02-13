<div id="{{ $id }}" class="modal hidden">
    <!-- Backdrop -->
    <!-- Modal -->
    @php

        $bgColor = '';
        if ($type == 'add') {
            $bgColor = 'bg-blue-600';
        } elseif ($type == 'edit') {
            $bgColor = 'bg-green-600';
        }

    @endphp
    <div class="modal-content {{ $size ?? 'max-w-md' }} thin-scroll relative">
        {{-- @if ($size !== 'small-modal' && $size !== 'medium-modal')
            <div class="bg-[#16247B] flex justify-between items-center w-full text-center text-white text-base p-2">
                <div>
                    <img id="school-logo" src="{{ asset('icon/sdo-logo.png') }}"
                        class="h-10 w-10 md:w-14 md:h-14 rounded-full border border-gray-300 object-cover shadow-lg">
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="text-sm font-medium text-white">DCP MIS @2026</div>
                    <div
                        class="division-name uppercase tracking-wide font-bold text-white md:text-lg truncate text-sm whitespace-nowrap">
                        Schools Division Office
                    </div>
                    <div class="san-carlos md:text-sm text-xs text-white font-normal uppercase">
                        San Carlos City
                    </div>
                </div>
                <div>
                    <img id="school-logo"
                        src="{{ Auth::guard('school')->user()->school->image_path
                            ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
                            : asset('icon/logo.png') }}"
                        class="h-10 w-10 md:w-14 md:h-14 rounded-full border border-gray-300 object-cover shadow-lg">
                </div>
            </div>
        @endif --}}
        <div class="mb-2 p-6">
            <div class="flex flex-col items-center justify-center ">
                <div class="flex justify-center  relative items-center">

                    <img id="school-logo"
                        src="{{ Auth::guard('school')->user()->school->image_path
                            ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path)
                            : asset('icon/logo.png') }}"
                        class="w-24 h-24 rounded-full border border-gray-300 object-cover shadow-lg">
                    <div
                        class="  absolute bottom-0 right-0 translate-x-1/2 w-14 h-14 action-button">
                        <div class="text-white {{ $bgColor }}  p-1 rounded-full">
                            @include('SchoolSide.components.svg.' . $icon)
                        </div>
                    </div>

                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
