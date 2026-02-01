  <style>
      /* Hide everything by default when printing */
      @media print {
          body * {
              visibility: hidden;
              /* hide everything */
          }

          #printableArea,
          #fullPrintable,
          #printableArea *,
          #fullPrintable * {
              visibility: visible;
              /* show only the target element */
          }

          #printableArea,
          #fullPrintable {
              position: absolute;
              top: 0;
              left: 0;
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

          .top-header {
              background-color: #01378E !important;
              color: white !important;
          }

          .sub-header {
              background-color: #E5E7EB !important;
              color: black !important;
          }

          #print-header {
              display: flex !important;
          }

          .secondary-header {
              background-color: #FDE68A !important;
              color: black !important;
          }

          .td-cell {
              background-color: white !important;
              color: black !important;

          }

          .button-container {
              display: none !important;
          }

      }
  </style>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
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
          document.getElementById('current-time-date').textContent = formattedDate;
      });
  </script>
