   <script>
       function printEquipment(id) {
           const table = document.getElementById('equipment-print-' + id);
           if (!table) return;

           const win = window.open('', '', 'width=900,height=700');

           const now = new Date().toLocaleString();

           win.document.write(`
<!DOCTYPE html>
<html>
<head>
    <title>Print Equipment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        /* ===== PRINT HEADER ===== */
        .print-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 8px;
        }

        .school-name {
            font-size: 20px;
            font-weight: bold;
        }
            .school-logo {
               width: 6rem;              /* w-24  (24 × 0.25rem) */
                height: 6rem;             /* h-24 */
                object-fit: cover;        /* object-cover */
                border-radius: 9999px;    /* rounded-full */
                border-width: 2px;        /* border-2 */
                border-style: solid;
                border-color: #D1D5DB;    /* border-gray-300 */
            }

        .print-date {
            font-size: 12px;
            color: #555;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            word-wrap: break-word;
            white-space: normal;
            font-size: 12px;
        }

        .top-header {
            background-color: #01378E;
            color: white;
            font-weight: bold;
        }

        .sub-header {
            background-color: #E5E7EB;
            font-weight: bold;
        }

        .secondary-header {
            background-color: #FDE68A;
            font-weight: bold;
        }

        /* PRINT COLOR FIX */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @media print {
            button {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- PRINT HEADER (OUTSIDE TABLE) -->
    <div class="print-header">
        <img class="school-logo" src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}">
        <div class="school-name"> {{ Auth::guard('school')->user()->school->SchoolName }}</div>
        <div class="print-date">
            School Report – Generated on ${now}
        </div>
    </div>

    <!-- TABLE -->
    ${table.outerHTML}

</body>
</html>
    `);

           win.document.close();
           win.focus();

           // Delay fixes missing images in Chrome
           setTimeout(() => {
               win.print();
               win.close();
           }, 500);
       }
   </script>
