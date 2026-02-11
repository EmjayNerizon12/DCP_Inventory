<style>
    .modal {
        @apply fixed inset-0 z-50 flex justify-center overflow-y-auto py-10 items-start md:items-center bg-black/40;
    }
</style>
<div id="add-info-modal" class="modal hidden">
    <div class=" modal-content super-large-modal  thin-scroll">
        <form action="{{ route('ISP-Info.store') }}" method="POST" class="mt-2">
            @csrf
            @method('POST')
            <div class="flex flex-col items-center justify-center gap-0">

                <div class="w-full flex flex-row items-center justify-center">
                    <div
                        class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                        <div class="text-white bg-blue-600 p-2 rounded-full">
                            <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <title></title>
                                    <g>
                                        <path d="M48,60A12,12,0,1,0,60,72,12.0081,12.0081,0,0,0,48,60Z"></path>
                                        <path
                                            d="M22.6055,46.6289A5.9994,5.9994,0,1,0,31.1133,55.09a24.2258,24.2258,0,0,1,33.7734,0,5.9512,5.9512,0,0,0,4.2539,1.77,6,6,0,0,0,4.2539-10.23C59.7773,32.918,36.2227,32.918,22.6055,46.6289Z">
                                        </path>
                                        <path
                                            d="M90.27,29.7773a59.1412,59.1412,0,0,0-84.539,0,5.9994,5.9994,0,1,0,8.5312,8.4375c18.1172-18.3281,49.3594-18.3281,67.4766,0A5.9994,5.9994,0,1,0,90.27,29.7773Z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="page-title">Additional Information for Internet Service</div>
                    <div class="page-subtitle">Information of School's Internet</div>
                </div>
            </div>
            <input type="hidden" name="school_internet_id" id="school_internet_id">
            <div class="grid md:grid-cols-3 grid-cols-1 gap-2 mb-4">

                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal  w-full text-left text-gray-800  ">Cost Per Month <span
                            class="text-red-600">required
                            *</span></div>
                    <input class="px-2 py-1 border border-gray-300 rounded-sm w-full" required type="number"
                        name="cost_per_month">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal  w-full text-left text-gray-800  ">Account Number <span
                            class="text-red-600">required
                            *</span></div>
                    <input class="px-2 py-1 border border-gray-300 rounded-sm w-full" required type="text"
                        name="account_number">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal  w-full text-left text-gray-800 ">Description of Package Purchased
                    </div>
                    <input class="px-2 py-1 border border-gray-300 rounded-sm w-full" type="text" name="description">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal  w-full text-left text-gray-800 ">Subscription Type <span
                            class="text-red-600">required *</span></div>
                    <select name="subscription_type" id="" required
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        <option value="Prepaid">Prepaid</option>
                        <option value="Postpaid">Postpaid</option>
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="warranty_start" class=" w-full text-left">Start of Contract <span
                            class="text-red-600">required *</span></div>
                    <input type="date" name="contract_start" id="" required
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="warranty_end" class=" w-full text-left">End of Contract <span
                            class="text-red-600">required *</span></div>
                    <input type="date" name="contract_end" id="" required
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base  w-full text-left font-normal text-gray-800 ">Is Inactive/Contract Ended ?
                        <span class="text-red-600">required *</span>
                    </div>
                    <select name="inactive_contract" id="" required
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left ">
                    <div class="text-base  w-full text-left font-normal text-gray-800 w-full text-left">Mode of
                        Acquisition</div>
                    <select name="mode_of_acq_id" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        @foreach (App\Models\ISPInfo\ISPModeOfAcq::all() as $mode)
                            <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base  w-full text-left font-normal text-gray-800 ">Source of Acquisition</div>
                    <select name="source_of_acq_id" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        @foreach (App\Models\ISPInfo\ISPSourceOfAcq::all() as $src)
                            <option value="{{ $src->id }}">{{ $src->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="donor" class=" w-full text-left">Donor</div>
                    <input type="text" name="donor" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base  w-full text-left font-normal text-gray-800 ">Source of Fund</div>
                    <select name="source_of_fund_id" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        @foreach (App\Models\ISPInfo\ISPSourceOfFund::all() as $src)
                            <option value="{{ $src->id }}">{{ $src->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="total_no_access_points" class=" w-full text-left">Total Access Point</div>
                    <input type="number" name="total_no_access_points" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="location_of_access_points" class=" w-full text-left">Location of Access Point</div>
                    <input type="text" name="location_of_access_points" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="total_admin_area_isps" class=" w-full text-left">Number of Admin Area Rooms covered by
                        ISP</div>
                    <input type="number" name="total_admin_area_isps" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal text-gray-800  w-full text-left">Rate ISP for AdminArea</div>
                    <select name="admin_area_rate_id" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        @foreach (App\Models\ISPInfo\ISPRating::all() as $rate)
                            <option value="{{ $rate->id }}">{{ $rate->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div for="total_classroom_isps" class=" w-full text-left">Number of Classrooms covered by ISP
                    </div>
                    <input type="number" name="total_classroom_isps" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal text-gray-800  w-full text-left">Rate ISP for AdminArea</div>
                    <select name="classroom_area_rate_id" id=""
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        @foreach (App\Models\ISPInfo\ISPRating::all() as $rate)
                            <option value="{{ $rate->id }}">{{ $rate->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-end justify-end h-full text-left">
                    <div class="text-base font-normal text-gray-800  w-full text-left">Rate the Overall ISP</div>
                    <select name="rate" id="" required
                        class="px-2 py-1 border border-gray-300 rounded-sm w-full">
                        <option value="">Select</option>
                        <option value="5">5 ★★★★★</option>
                        <option value="4">4 ★★★★</option>
                        <option value="3">3 ★★★</option>
                        <option value="2">2 ★★</option>
                        <option value="1">1 ★</option>
                    </select>
                </div>
            </div>




            <div class="flex md:justify-end justiffy-center gap-2">


                <button title="Show Edit Modal" type="button"
                    onclick="document.getElementById('add-info-modal').classList.add('hidden');document.body.classList.remove('overflow-hidden');"
                    class="btn-cancel md:w-auto w-full py-1 px-4 rounded">
                    Cancel
                </button>
                <button title="Show Info Modal" type="submit" class="btn-submit md:w-auto w-full py-1 px-4 rounded">
                    Save Information
                </button>



            </div>
        </form>
    </div>
</div>


<script>
    function showInfoModal(school_internet_id) {
        document.getElementById('school_internet_id').value = school_internet_id;
        document.getElementById('add-info-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
</script>
