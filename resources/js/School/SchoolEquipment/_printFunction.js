export function printEquipment(id) {
    const table = document.getElementById('equipment-print-' + id);
    const printHeader = document.getElementById('print-header');
    if (!table) return;
    const win = window.open('', '', 'width=900,height=700');
    const now = new Date().toLocaleString();
    const elements = document.querySelectorAll('.get-date');

    var currentDate = new Date();
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    var formattedDate = currentDate.toLocaleDateString(undefined, options);
    elements.forEach(el => {
        el.innerHTML = formattedDate;
    });


    win.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print Equipment</title>
                <style>

                    @media print {
                        button {
                            display: none !important;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            table-layout: fixed;
                        }
                        table,
                        th,
                        td {
                            -webkit-print-color-adjust: exact;
                            /* Chrome, Safari */
                            print-color-adjust: exact;
                            /* Firefox */
                        }

                        /* Optional: ensure borders and text colors are printed */
                        th,
                        td {
                            border: 1px solid #333;
                            color: #000;
                            /* text color */
                            background-color: #f5f5f5;
                            /* cell background */
                        }

                        * {
                            -webkit-print-color-adjust: exact;
                            /* Chrome/Safari */
                            print-color-adjust: exact;
                            /* Firefox */
                        }

                    .school-name {
                        font-size: 2.25rem;       /* text-4xl */
                        line-height: 2.5rem;
                        font-weight: 700;         /* font-bold */
                        color: #374151; 
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
                        font-size: 1rem;          /* text-md */
                        line-height: 1.5rem;
                        color: #6b7280;   
                    }
                        .top-header {
                            background-color: #01378E;  /* custom dark blue */
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            color: #ffffff;             /* text-white */
                            text-align: left;           /* text-left */
                            border: 1px solid #1F2937;  /* border-gray-800 */
                            text-transform: uppercase;  /* uppercase */
                            font-weight: 700;           /* font-bold */
                            font-size: 1.125rem;        /* text-lg */
                            padding: 0.25rem 1rem;      /* py-1 px-4 */
                        }

                        .sub-header {
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            background-color: #E5E7EB;  /* bg-gray-200 */
                            color: #000000;             /* text-black */
                            text-align: left;           /* text-left */
                            letter-spacing: 0.05em;    /* tracking-wide */
                            border: 1px solid #1F2937;  /* border-gray-800 */
                            font-weight: 500;           /* font-medium */
                            font-size: 1rem;            /* text-base */
                            padding: 0.25rem 1rem;      /* py-1 px-4 */
                        }

                        .secondary-header {
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            background-color: #FDE68A;  /* bg-amber-200 */
                            color: #000000;             /* text-black */
                            text-align: center;           /* text-left */
                            letter-spacing: 0.05em;     /* tracking-wide */
                            border: 1px solid #1F2937;  /* border-gray-800 */
                            font-weight: 500;           /* font-medium */
                            font-size: 1rem;            /* text-base */
                            padding: 0.25rem 1rem;      /* py-1 px-4 */
                        }
                        .td-cell {
                            padding: 0.5rem 0.75rem;     /* py-2 px-3 */
                            font-size: 1rem;             /* text-base */
                            color: #000000;              /* text-black */
                            border: 1px solid #1F2937;   /* border-gray-800 */
                            letter-spacing: 0.05rem;     /* from your code */
                        }
                            #print-header-individual {
                            display: flex !important;
                            flex-direction: column !important;
                            justify-content:center !important;
                            text-align: center !important;
                        margin-bottom: 10px !important;

                        }
                            .logo-container{
                            
                            width:100% !important;
                            flex-direction: column !important;
                            justify-content:center !important;
                            text-align: center !important;
                            }

                    }
                </style>
            </head>
            <body>

                <!-- PRINT HEADER (OUTSIDE TABLE) -->
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

window.printEquipment = printEquipment;