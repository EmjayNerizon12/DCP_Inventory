 <x-modal id="info-modal" size="medium-modal" type="add" icon="wifi-sm">
     <div class="grid grid-cols-1 gap-2  ">
         <form id="ispForm" action="{{ route('ISP-Question.store') }}" method="POST">
             <div class="flex flex-col items-center justify-center gap-0">
                 <div class="text-center">
                     <div class="page-title">Insert Internet Connectivity Information</div>
                     <div class="page-subtitle">School Information</div>
                 </div>
             </div>
             @csrf
             <div id="formContainer"></div>
             {{-- POPULATE THE FORM (JAVASCRIPT) --}}
             <div class="my-2 flex md:flex-row  gap-2 justify-end">
                 <!-- SUBMIT BUTTON -->
                 <button onclick="document.getElementById('info-modal').classList.add('hidden')" title="Close"
                     type="button" class="btn-cancel md:w-auto w-full h-8 py-1 px-4 rounded">
                     Cancel
                 </button>
                 <button type="submit" id="submit-report-button"
                     class="theme-button md:w-auto  w-full  h-8 py-1 px-4 rounded">
                     Submit
                 </button>
             </div>
         </form>
     </div>
 </x-modal>


 <script>
     const schoolId = document.getElementById('school_id').value;
     const reportContainer = document.getElementById('report-container');
     const token = localStorage.getItem('token');
     const actionContainer = document.getElementById('actionContainer');

     function openInsert() {
         document.getElementById('info-modal').classList.remove('hidden');
     }
     async function fetchAnswers(schoolId) {
         reportContainer.innerHTML = '';
         const response = await fetch(`/api/School/ispQuestionWithAnswer/${schoolId}`, {
             method: 'GET',
             headers: {
                 'Authorization': `Bearer ${token}`,
                 'Accept': 'application/json'
             }
         });
         const res = await response.json();

         if (res.data.isAnswered) {
             actionContainer.innerHTML = `
             <div>
                    <div
                        class="h-10 w-auto hidden flex items-center justify-center">

                        <button title="Show Info Modal" type="button" onclick="openEdit()"
                            class="btn-green h-8 py-1 px-4 rounded">
                            Edit the Following
                        </button>
                    </div>
                            <div class="flex gap-2 my-2">
                                <div
                                    class="h-10 w-auto flex items-center justify-center">
                                        <button type="button" onclick="clearAnswers()" class="btn-delete h-8 py-1 px-4 rounded">
                                            Clear Answers
                                        </button>                       
                                </div>
                                <div
                                    class="h-10 w-auto flex items-center justify-center">
                                        <button type="button" onclick="window.print()" class="theme-button h-8 py-1 px-4 rounded">
                                            Print
                                        </button>                       
                                </div>
                            </div>
                </div>`;
         } else {
             actionContainer.innerHTML = `    
             <div class="flex justify-start my-2 ">
                    <div
                        class="h-10 w-auto   flex items-center justify-center">

                        <button title="Show Info Modal" type="button" onclick="openInsert()"
                            class="theme-button h-8 py-1 px-4 rounded">
                            Answer Form
                        </button>
                    </div>
                </div>`;
         }
         renderTable(res.data.questions);
     }

     function renderTable(data) {

         const tableReport = document.createElement('table');
         tableReport.className =
             'w-full border';
         const tbodyReport = document.createElement('tbody');
         const theadReport = document.createElement('thead');
         theadReport.innerHTML = `<tr>
                    <td class="top-header" colspan="3">overall Internet Information</td>
                </tr>
                <tr>
                    <th class="sub-header text-center text-base">No.</th>
                    <th class="sub-header text-center text-base">Question</th>
                    <th class="sub-header text-center text-base">Answer(s)</th>
                </tr>`;

         let row = '';
         data.forEach((question, index) => {
             row += `
                <tr>
                    <td class="td-cell text-center"> 
                        ${index + 1}
                        </td>
                    <td class="td-cell ">
                        ${question.question_text}
                        </td>
                            <td class="td-cell">
                                ${answerDisplay(question.choices)}
                                ${question?.answers[0]?.text_value ?? ''}
                                ${ question?.answers[0]?.numeric_value ?? ''}
                                </td>
                    </tr>
            `;

         });
         tbodyReport.innerHTML = row;
         tableReport.appendChild(theadReport);
         tableReport.appendChild(tbodyReport);
         reportContainer.appendChild(tableReport);
     }

     function answerDisplay(choice) {
         const isChoiceArray = choice && Array.isArray(choice)
         const answer = [];
         if (isChoiceArray) {
             choice.forEach(choices => {

                 if (Array.isArray(choices.answers) && choices.answers.length > 0) {
                     if (choices.choice_text == 'Others') {
                         answer.push(choices.answers[0].other_value);
                     } else {

                         answer.push(choices.choice_text);
                     }
                 }
             });
             return answer;
         }

         // CASE 4: No answer
         return null;
     }

     function displayText(question) {
         if (question?.numeric_value) {
             return question?.numeric_value;
         }
         if (question?.text_value) {
             return question?.text_value;
         }
     }

     async function clearAnswers() {
         if (!confirm('Are you sure you want to clear all answers?')) {
             return;
         }
         try {
             const response = await fetch(`/api/School/ispQuestionWithAnswer/delete/${schoolId}`, {
                 method: 'DELETE',
                 headers: {
                     'Accept': 'application/json',
                     'X-CSRF-TOKEN': document
                         .querySelector('meta[name="csrf-token"]')
                         .getAttribute('content'),
                 },
             });
             const res = await response.json();
             alert(res.message);
             fetchAnswers(schoolId);
         } catch (error) {
             console.error(error)
         }
     }
     async function renderAddForm() {
         const response = await fetch(`/api/School/ispQuestionWithChoices`);
         const res = await response.json();
         const formContainer = document.getElementById('formContainer');
         const questions = res.data;
         formContainer.innerHTML = ''; // clear first
         questions.forEach((question, index) => {
             let html = `
                    <div class="w-full form-label mb-4">
                        ${index + 1}. ${question.question_text} 
                    <div class="grid grid-cols-1 gap-2 mt-2">
                `;
             /* MULTIPLE */
             if (question.question_type === 'multiple') {
                 question.choices.forEach(choice => {
                     html += `
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="answer[${question.id}][]"
                               value="${choice.id}"
                               class="mr-2">
                        ${choice.choice_text}
                `;

                     if (choice.is_other == 1) {
                         html += `
                        <input type="text"
                               name="other[${question.id}][${choice.id}]"
                               placeholder="Please specify"
                               class="border border-gray-300 rounded p-1 ml-2">
                    `;
                     }

                     html += `</label>`;
                 });
             }

             /* BOOLEAN */
             if (question.question_type === 'boolean') {
                 question.choices.forEach(choice => {
                     html += `
                    <label class="flex items-center">
                        <input type="radio"
                               required
                               name="answer[${question.id}]"
                               value="${choice.id}"
                               class="mr-2">
                        ${choice.choice_text}
                    </label>
                `;
                 });
             }

             /* NUMBER */
             if (question.question_type === 'number') {
                 html += `
      
                <x-input-field type="number" name="answer[${question.id}]" label="" :required="false" :edit="false" />
            `;
             }
             /* TEXT */
             if (question.question_type === 'text') {
                 html += `
                      <x-input-field type="text" name="answer[${question.id}]" label="" :required="false" :edit="false" />
            `;
             }
             /* SINGLE (dropdown) */
             if (question.question_type === 'single') {
                 html += `
                <select name="answer[${question.id}]"
                        class="border border-gray-300 rounded p-1"
                        required>
                `;
                 question.choices.forEach(choice => {
                     html += `
                    <option value="${choice.id}">
                        ${choice.choice_text}
                    </option>
                `;
                 });
                 html += `</select>`;
             }
             html += `
                            </div>
                        </div>
                    `;

             formContainer.insertAdjacentHTML('beforeend', html);
         });
     }
     const ispForm = document.getElementById('ispForm');
     const submitReportButton = document.getElementById('submit-report-button');

     ispForm.addEventListener('submit', async (e) => {
         e.preventDefault();
         buttonLoading(submitReportButton);
         const formData = new FormData(ispForm);
         const response = await fetch(ispForm.action, {
             method: 'POST',
             headers: {
                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                 'Accept': 'application/json'
             },
             body: formData
         });
         const data = await response.json();
         if (!response.ok) {
             handleErrors(data.errors);
             resetButton(submitReportButton, 'Submit')

             return;
         }
         closeComponentModal('info-modal');
         renderStatusModal(data);
         ispForm.reset();
         fetchAnswers(schoolId)
     });
     fetchAnswers(schoolId);
     renderAddForm();
 </script>
