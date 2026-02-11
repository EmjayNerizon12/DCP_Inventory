<div id="edit-info" class="bg-white border border-gray-300 shadow-md p-4 hidden">
    <form action="{{ route('ISP-Question.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col items-center justify-center gap-0">

            <div class="w-full flex flex-row items-center justify-center">
                <div
                    class="h-16 w-16 bg-white p-3 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                    <div class="text-white bg-green-600 p-2 rounded-full">
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
                <div class="text-md text-green-600 mb-4">School Information</div>
            </div>
        </div>
        @foreach ($isp_question as $index => $question)
            {{ $index + 1 }}. {{ $question->question_text }}
            @if ($question->question_type === 'multiple')
                @foreach ($question->choices as $choice)
                    @php
                        $answer = \App\Models\ISPQ\ISPAnswer::where('choice_id', $choice->id)
                            ->with('choice')
                            ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                            ->first();

                    @endphp

                    <label class="flex items-center mb-1">
                        <input type="checkbox" name="answer[{{ $question->id }}][{{ $answer ? $answer->id : '' }}][]"
                            value="{{ $choice->id }}" {{ $answer ? 'checked' : '' }} class="mr-2">

                        {{ $choice->choice_text }}

                        @if ($choice->is_other)
                            <input type="text"
                                name="other[{{ $question->id }}][{{ $answer ? $answer->id : '' }}][{{ $choice->id }}]"
                                class="border rounded p-1 ml-2" value="{{ $answer->other_value ?? '' }}">
                        @endif
                    </label>
                @endforeach
            @endif
            @if ($question->question_type === 'single')
                @php
                    $answer = \App\Models\ISPQ\ISPAnswer::where('question_id', $question->id)
                        ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                        ->first();
                @endphp

                <select name="answer[{{ $question->id }}][{{ $answer ? $answer->id : '' }}]"
                    class="border rounded p-1 w-full" required>
                    @foreach ($question->choices as $choice)
                        <option value="{{ $choice->id }}"
                            {{ $answer && $answer->choice_id == $choice->id ? 'selected' : '' }}>
                            {{ $choice->choice_text }}
                        </option>
                    @endforeach
                </select>
            @endif
            @if ($question->question_type === 'boolean')
                @php
                    $answer = \App\Models\ISPQ\ISPAnswer::where('question_id', $question->id)
                        ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                        ->first();
                @endphp

                <select name="answer[{{ $question->id }}][{{ $answer ? $answer->id : '' }}]"
                    class="border rounded p-1 w-full"required>
                    @foreach ($question->choices as $choice)
                        <option value="{{ $choice->id }}"
                            {{ $answer && $answer->choice_id == $choice->id ? 'selected' : '' }}>
                            {{ $choice->choice_text }}
                        </option>
                    @endforeach
                </select>
            @endif
            @if ($question->question_type == 'text')
                @php
                    $answer = \App\Models\ISPQ\ISPAnswer::where('question_id', $question->id)
                        ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                        ->first();
                @endphp

                <input type="text" name="answer[{{ $question->id }}][{{ $answer ? $answer->id : '' }}]"
                    class="border rounded p-1 w-full  " required value="{{ $answer->text_value ?? '' }}">
            @endif
            @if ($question->question_type == 'number')
                @php
                    $answer = \App\Models\ISPQ\ISPAnswer::where('question_id', $question->id)
                        ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                        ->first();
                @endphp

                <input type="number" step="0.01"
                    name="answer[{{ $question->id }}][{{ $answer ? $answer->id : '' }}]" required
                    class="border rounded p-1 w-full" value="{{ $answer->numeric_value ?? '' }}">
            @endif
        @endforeach
        <div class="my-2 flex md:flex-row flex-col gap-2 justify-start">
            <button
                class="bg-green-600 hover:bg-green-700 px-4 py-1 rounded shadow text-white  font-medium tracking-wider"
                type="submit">Update
                Information</button>

            <button onclick="document.getElementById('edit-info').classList.add('hidden')"
                class="bg-gray-400 hover:bg-gray-500 px-4 py-1 rounded shadow text-white  font-medium tracking-wider"
                type="button">Cancel</button>

        </div>
    </form>
</div>
<script>
    function openEdit() {
        document.getElementById('edit-info').classList.remove('hidden');
        document.getElementById('insert-info').classList.add('hidden');

    }

    function openInsert() {
        document.getElementById('insert-info').classList.remove('hidden');
        document.getElementById('edit-info').classList.add('hidden');
    }
</script>
