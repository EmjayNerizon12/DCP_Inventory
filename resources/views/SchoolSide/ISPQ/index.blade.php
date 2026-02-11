@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Dashboard')</title>

@section('content')
    <div class="p-6 flex flex-col gap-3">
        @include('SchoolSide.ISPQ.partials._modalAddInfo')
        @include('SchoolSide.ISPQ.partials._modalEditInfo')
        @php
            $hasAnswers = \App\Models\ISPQ\ISPAnswer::where(
                'school_id',
                Auth::guard('school')->user()->pk_school_id,
            )->exists();
        @endphp
        <div class="flex gap-2  ">
            @if ($hasAnswers)
                <div class="flex justify-start  ">
                    <div
                        class="h-10 hidden w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                        <button title="Show Info Modal" type="button" onclick="openEdit()"
                            class="btn-green h-8 py-1 px-4 rounded-full">
                            Edit the Following
                        </button>
                    </div>
                    <div
                        class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">
                        <form
                            onsubmit="return confirm('Are you sure you want to clear all answers? This action cannot be undone.')"
                            action="{{ route('ISP-Question.destroy', Auth::guard('school')->user()->pk_school_id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete h-8 py-1 px-4 rounded-full">
                                Clear Answers
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex justify-start  ">
                    <div
                        class="h-10 w-auto bg-white p-1 border border-gray-300 shadow-md rounded-full flex items-center justify-center">

                        <button title="Show Info Modal" type="button" onclick="openInsert()"
                            class="btn-submit h-8 py-1 px-4 rounded-full">
                            Answer the Question
                        </button>
                    </div>
                </div>
            @endif
        </div>
        <div class="overflow-x-auto shadow-md">
            <table class=" border border-gray-300 tracking-wider bg-white w-full border border-gray-300 shadow-md p-4">
                <thead>
                    <tr>
                        <td class="top-header" colspan="3">overall Internet Information</td>
                    </tr>
                    <tr>
                        <th class="sub-header text-center text-base">No.</th>
                        <th class="sub-header text-center text-base">Question</th>
                        <th class="sub-header text-center text-base">Answer(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($isp_question as $question)
                        <tr>
                            <td class="td-cell text-center">
                                {{ $loop->iteration }}</td>
                            <td class="td-cell font-semibold">{{ $question->question_text }}</td>
                            <td class="td-cell">
                                @foreach ($question->choices as $choice)
                                    @if ($question->question_type == 'multiple')
                                        @php
                                            $answer = \App\Models\ISPQ\ISPAnswer::where('choice_id', $choice->id)
                                                ->with('choice')
                                                ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                                                ->first();

                                        @endphp

                                        @php
                                            $text = $answer ? $answer->choice->choice_text : null;

                                        @endphp

                                        @if ($text)
                                            {{ $text }}

                                            @if ($choice->is_other == 1 && $answer->other_value)
                                                ({{ $answer->other_value }})
                                            @endif

                                            <br>
                                        @endif
                                    @elseif ($question->question_type == 'single')
                                        @php
                                            $answer = \App\Models\ISPQ\ISPAnswer::where('choice_id', $choice->id)
                                                ->with('choice')
                                                ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                                                ->first();
                                        @endphp
                                        {{ $answer ? $answer->choice->choice_text : '' }}
                                    @elseif ($question->question_type == 'boolean')
                                        @php
                                            $answer = \App\Models\ISPQ\ISPAnswer::where('choice_id', $choice->id)
                                                ->with('choice')
                                                ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                                                ->first();
                                        @endphp
                                        {{ $answer ? $answer->choice->choice_text : '' }}
                                    @else
                                        <br>
                                    @endif
                                @endforeach
                                @if ($question->question_type == 'text')
                                    @php
                                        $answer = \App\Models\ISPQ\ISPAnswer::where('question_id', $question->id)
                                            ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                                            ->first();
                                    @endphp
                                    {{ $answer ? $answer->text_value : '' }}
                                @elseif ($question->question_type == 'number')
                                    @php
                                        $answer = \App\Models\ISPQ\ISPAnswer::where('question_id', $question->id)
                                            ->where('school_id', Auth::guard('school')->user()->pk_school_id)
                                            ->value('numeric_value');
                                    @endphp
                                    @if ($answer !== null)
                                        ₱{{ number_format($answer, 2) }}
                                    @endif
                                    <br>
                                @endif
                            <td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
