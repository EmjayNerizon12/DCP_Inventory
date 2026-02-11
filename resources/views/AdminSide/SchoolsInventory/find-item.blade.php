@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <div class="  md:my-5 mx-0 my-0">
        <div class=" flex justify-start gap-2 items-center ">

            <div
                class="h-16 w-16 bg-white p-3 mb-2 border border-gray-300 shadow-lg rounded-full flex items-center justify-center">
                <div class="text-white bg-blue-600 p-2 rounded-full">
                    <svg viewBox="0 0 24 24" class="h-10 w-10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11ZM11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C13.125 20 15.078 19.2635 16.6177 18.0319L20.2929 21.7071C20.6834 22.0976 21.3166 22.0976 21.7071 21.7071C22.0976 21.3166 22.0976 20.6834 21.7071 20.2929L18.0319 16.6177C19.2635 15.078 20 13.125 20 11C20 6.02944 15.9706 2 11 2Z"
                                fill="currentColor"></path>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="w-full" style="letter-spacing: 0.05rem flex flex-col items-center">

                <h1 style="letter-spacing: 0.05rem" class="text-2xl font-bold text-gray-800 uppercase mb-4">Search Product
                </h1>
            </div>
        </div>

        <div style="letter-spacing: 0.05rem" class="mb-4 text-gray-600"
            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
            <form id="searchForm">

                <input type="text" name="searchInput" id="searchInput" placeholder="Product Code"
                    class="px-4 py-2 text-md border border-gray-300 shadow-sm">
                <button class="bg-blue-600 px-4 py-2 text-md shadow-sm rounded-sm text-white font-medium">Find
                    Product</button>
            </form>
            <div>
                <table style="letter-spacing: 0.05rem;" class="w-full border-collapse border bg-white shadow-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border uppercase">Product Code</th>
                            <th class="px-4 py-2 border uppercase">Name</th>
                            <th class="px-4 py-2 border uppercase">View</th>
                        </tr>
                    </thead>
                    <tbody id="results-table">
                        <tr>
                            <td class="text-center py-2 text-md" colspan="3">No Product Found</td>
                        </tr>
                    </tbody>
                </table>

                <div id="pagination-buttons" class="flex justify-center mt-4 gap-2"></div>
            </div>

        </div>
        <script>
            const form = document.getElementById('searchForm');
            const tableBody = document.getElementById('results-table');
            const paginationDiv = document.getElementById('pagination-buttons');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let currentPage = 1; // current page

            function fetchResults(page = 1) {
                const searchInput = document.getElementById('searchInput').value;

                fetch('/Admin/api-find-item', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            searchInput,
                            page
                        })
                    })
                    .then(res => res.json())
                    .then(result => {
                        // Clear previous table
                        tableBody.innerHTML = '';

                        // Populate table
                        result.data.forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td class="border px-4 py-2">${item.generated_code}</td>
                                <td class="border px-4 py-2">
                                        ${item.dcp_item_type.name}
                                    </td>
                                   <td class="border px-4 py-2">
                                <button class="bg-blue-600 px-4 py-2 text-md shadow-sm rounded-sm text-white font-medium"
                                    onclick="showItem('${item.generated_code}')">Show</button>

                            </td>
                            `;
                            tableBody.appendChild(row);
                        });

                        // Build pagination buttons
                        buildPagination(result.current_page, result.last_page);
                    })
                    .catch(err => console.error(err));
            }

            function showItem(code) {
                window.location.href = `/Admin/Product/${code}`
            }

            function buildPagination(current, last) {
                paginationDiv.innerHTML = '';

                // Previous button
                const prev = document.createElement('button');
                prev.textContent = 'Previous';
                prev.disabled = current === 1;
                prev.className = 'px-3 py-1 bg-gray-300 rounded disabled:opacity-50';
                prev.addEventListener('click', () => {
                    currentPage--;
                    fetchResults(currentPage);
                });
                paginationDiv.appendChild(prev);

                // Page numbers
                for (let i = 1; i <= last; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    btn.className = `px-3 py-1 rounded ${i === current ? 'bg-blue-500 text-white' : 'bg-gray-200'}`;
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        fetchResults(currentPage);
                    });
                    paginationDiv.appendChild(btn);
                }

                // Next button
                const next = document.createElement('button');
                next.textContent = 'Next';
                next.disabled = current === last;
                next.className = 'px-3 py-1 bg-gray-300 rounded disabled:opacity-50';
                next.addEventListener('click', () => {
                    currentPage++;
                    fetchResults(currentPage);
                });
                paginationDiv.appendChild(next);
            }

            // Initial fetch
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                currentPage = 1;
                fetchResults(currentPage);
            });
        </script>
    </div>
@endsection
