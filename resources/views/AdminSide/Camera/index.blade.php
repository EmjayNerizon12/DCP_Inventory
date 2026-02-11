 @extends('layout.Admin-Side')
 <title> @yield('title', 'DCP Dashboard')</title>
 @section('content')
     <meta charset="UTF-8">
     <title>QR Code Scanner</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">

     {{-- Include the html5-qrcode library --}}
     <script src="https://unpkg.com/html5-qrcode"></script>

     {{-- Optional styling --}}
     <style>
         h2 {
             text-align: center;

         }

         #reader {
             width: 320px;
             margin: 20px auto;

             border-radius: 10px;
             background: #fff;
             padding: 10px;
         }

         #result-box {
             text-align: center;
             margin-top: 20px;
         }

         #scannedCode {
             font-size: 14px;
             font-weight: bold;
             color: #1a73e8;
             word-break: break-all;
         }

         #monitorBtn {
             margin-top: 15px;
             padding: 10px 20px;
             background-color: #1a73e8;
             border: none;
             border-radius: 5px;
             color: white;
             cursor: pointer;
         }

         #monitorBtn:disabled {
             background-color: #aaa;
             cursor: not-allowed;
         }

         #status {
             margin-top: 10px;
             font-weight: bold;
         }
     </style>
     <div class=" my-5 flex justify-start gap-2 items-center ">

         <div
             class="h-16 w-16 bg-white p-3 mb-2 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
             <div class="text-white bg-blue-600 p-2 rounded-full">
                 <svg viewBox="-3 0 32 32" class="w-10 h-10" version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                     fill="currentColor">
                     <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                     <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                     <g id="SVGRepo_iconCarrier">

                         <defs> </defs>
                         <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                             sketch:type="MSPage">
                             <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-259.000000, -203.000000)"
                                 fill="currentColor">
                                 <path
                                     d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z"
                                     id="trash" sketch:type="MSShapeGroup"> </path>
                             </g>
                         </g>
                     </g>
                 </svg>
             </div>
         </div>
         <div class="w-full" style="letter-spacing: 0.05rem flex flex-col items-center">

             <h1 style="letter-spacing: 0.05rem" class="text-2xl font-bold text-gray-800 uppercase mb-4">Product Monitoring
                 for Disposal Items
             </h1>
         </div>
     </div>
     <div class="  w-full flex justify-center">

         <div class="bg-white my-5  mx-auto max-w-lg   p-4 border border-gray-300 rounded-sm shadow-sm">


             <h2 class="text-2xl text-blue-600 font-bold"> Scan QR Code</h2>

             <div class="border border-gray-300 shadow-md" id="reader"></div>

             <div id="result-box">
                 <div>Scanned Code:</div>
                 <div id="scannedCode">—</div>
                 <button id="monitorBtn" disabled>Mark as Monitored</button>
                 <div class="text-lg font-medium text-gray-500" id="status">Waiting for scan...</div>
             </div>
         </div>
     </div>

     <script>
         const statusText = document.getElementById('status');
         const codeDisplay = document.getElementById('scannedCode');
         const monitorBtn = document.getElementById('monitorBtn');

         let scannedCode = "";

         // 1️⃣ When QR code is scanned
         function onScanSuccess(qrCodeMessage) {
             console.log("Scanned:", qrCodeMessage);
             statusText.innerText = "QR scanned successfully!";

             // Extract code from URL
             let parts = qrCodeMessage.split("/");
             scannedCode = parts.pop() || parts.pop(); // handles trailing slashes
             codeDisplay.innerText = scannedCode;

             // Enable the button
             monitorBtn.disabled = false;
         }

         function onScanError(errorMessage) {
             // ignore frequent errors
         }

         // 2️⃣ When "Mark as Monitored" button is clicked
         monitorBtn.addEventListener("click", () => {
             if (!scannedCode) {
                 statusText.innerText = "No QR code scanned yet.";
                 return;
             }

             statusText.innerText = "Updating record...";

             fetch("/Admin/update-record-status-of-item", {
                     method: "POST",
                     headers: {
                         "Content-Type": "application/json",
                         "X-CSRF-TOKEN": "{{ csrf_token() }}"
                     },
                     body: JSON.stringify({
                         code: scannedCode
                     })
                 })
                 .then(response => response.json())
                 .then(data => {
                     console.log("Server response:", data);
                     statusText.innerText = data.message;

                     if (data.message.includes("success")) {
                         monitorBtn.disabled = true;
                         codeDisplay.innerText = '';

                     }
                 })
                 .catch(err => {
                     console.error(err);
                     statusText.innerText = "Error: " + err.message;
                 });
         });

         // 3️⃣ Initialize the camera scanner
         const html5QrCode = new Html5Qrcode("reader");
         html5QrCode.start({
                 facingMode: "environment"
             }, {
                 fps: 10,
                 qrbox: 250
             },
             onScanSuccess,
             onScanError
         ).catch(err => {
             console.error("Unable to start camera:", err);
             statusText.innerText = "Camera access failed. Check permissions.";
         });
     </script>
 @endsection
