<div id="insert-info" class="grid grid-cols-1 gap-2 bg-white border border-gray-300 shadow-md p-4 hidden">
    <form action="{{ route('ISP-Question.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="flex flex-col items-center justify-center gap-0">

            <div class="w-full flex flex-row items-center justify-center">
                <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-blue-600 p-2 rounded-full">
                        <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg">
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
                <div class="text-2xl font-bold text-gray-700  ">Insert Internet Connectivity Information</div>
                <div class="text-base text-blue-600 mb-4">School Information</div>
            </div>
        </div>
        @forelse ($isp_question as $index => $question)
            <div class="w-full mb-4">
                <strong>{{ $index + 1 }}. {{ $question->question_text }}</strong>

                <div class="grid grid-cols-1 gap-2 mt-2">

                    {{-- MULTIPLE (check all that apply) --}}
                    @if ($question->question_type === 'multiple')
                        @foreach ($question->choices as $choice)
                            <label class="flex items-center">
                                <input type="checkbox" name="answer[{{ $question->id }}][]" value="{{ $choice->id }}"
                                    class="mr-2">
                                {{ $choice->choice_text }} @if ($choice->is_other == 1)
                                    <input type="text" name="other[{{ $question->id }}][{{ $choice->id }}]"
                                        placeholder="Please specify" class="border border-gray-300 rounded p-1 ml-2">
                                @endif
                            </label>
                        @endforeach
                    @endif


                    {{-- BOOLEAN / SINGLE --}}
                    @if ($question->question_type === 'boolean')
                        @foreach ($question->choices as $choice)
                            <label class="flex items-center">
                                <input type="radio" required name="answer[{{ $question->id }}]"
                                    value="{{ $choice->id }}" class="mr-2">
                                {{ $choice->choice_text }}
                            </label>
                        @endforeach
                    @endif


                    {{-- NUMBER --}}
                    @if ($question->question_type === 'number')
                        <input type="number" step="0.01" name="answer[{{ $question->id }}]"
                            class="border border-gray-300 rounded p-1" required>
                    @endif


                    {{-- TEXT --}}
                    @if ($question->question_type === 'text')
                        <input type="text" name="answer[{{ $question->id }}]"
                            class="border border-gray-300 rounded p-1" required>
                    @endif

                    @if ($question->question_type === 'single')
                        <select name="answer[{{ $question->id }}]" class="border border-gray-300 rounded p-1" required>
                            @foreach ($question->choices as $choice)
                                <option value="{{ $choice->id }}">{{ $choice->choice_text }}</option>
                            @endforeach
                        </select>
                    @endif

                </div>
            </div>


        @empty
        @endforelse
        <div class="my-2 flex md:flex-row flex-col gap-2 justify-start">

            <div
                class="h-10   w-auto bg-white p-1 border border-gray-300  shadow-md rounded-full flex items-center justify-center">

                <button title="Save Internet Report" type="submit" class="btn-submit h-8 py-1 px-4 rounded-full">
                    Save Information
                </button>
            </div>
            <div
                class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                <button onclick="document.getElementById('insert-info').classList.add('hidden')" title="Close"
                    type="button" class="btn-cancel h-8 py-1 px-4 rounded-full">
                    Cancel
                </button>
            </div>

        </div>
    </form>
</div>
