@extends('layout.Admin-Side')
<title>@yield('title', 'DCP Inventory')</title>

@section('content')
    <div class="p-2">
        <div class=" flex justify-start gap-2 items-center ">

            <div
                class="h-10 w-10 bg-white p-3 mb-2 border border-gray-300 shadow-lg rounded-md flex items-center justify-center">
                <div class="text-white bg-blue-600 p-1 rounded-md">
                    <svg viewBox="0 0 24 24" class="h-8 w-8" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <form id="searchForm" class="my-2  max-w-md flex gap-2 items-center">

                <input type="text" name="searchInput" id="searchInput" placeholder="Product Code"
                    class="form-input">
                <button class="btn-submit px-4 py-1 rounded">Find
                    Product</button>
            </form>
            <div>
                <table style="letter-spacing: 0.05rem;" class="w-full border-collapse border bg-white shadow-sm">
                    <thead>
                        <tr>
                            <th class="top-header text-center" colspan="3">DCP Products</th>
                        </tr>
                        <tr>
                            <th class="sub-header">Product Code</th>
                            <th class="sub-header">Name</th>
                            <th class="sub-header text-center">View</th>
                        </tr>
                    </thead>
                    <tbody id="results-table">
                        <tr>
                            <td class="text-center py-2 td-cell" colspan="3"></td>
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

                fetch('Api/search-product', {
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
                        tableBody.innerHTML = '';
                        result.data.forEach(item => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td class="td-cell px-4 py-2">${item.generated_code}</td>
                                <td class="td-cell px-4 py-2">
                                    ${item.dcp_item_type.name}
                                </td>
                                <td class="td-cell px-4 py-2">
                                    <div class="flex justify-center items-center">
                                        <button class="btn-submit px-4 py-1 rounded"
                                            onclick="showItem('${item.generated_code}')">
                                                View
                                        </button>
                                    </div>
                            </td>
                            `;
                            tableBody.appendChild(row);
                        });
                        if(result.data.length === 0 ){
                            tableBody.innerHTML= `
                                <td class="text-center py-2 td-cell" colspan="3">No Product Found</td>
                            `;
                        }
                        
                        // Build pagination buttons
                        buildPagination(result.current_page, result.last_page);
                    })
                    .catch(err => console.error(err));
            }

            function showItem(code) {
                window.location.href = `Show/${code}`
            }

            function buildPagination(current, last) {
                paginationDiv.innerHTML = '';

                // Previous button
                const prev = document.createElement('button');
                prev.textContent = 'Previous';
                prev.disabled = current === 1;
                prev.className = 'px-3 py-1 btn-cancel shadow rounded disabled:opacity-50';
                prev.addEventListener('click', () => {
                    currentPage--;
                    fetchResults(currentPage);
                });
                paginationDiv.appendChild(prev);

                // Page numbers
                for (let i = 1; i <= last; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    btn.className = `px-3 py-1 rounded ${i === current ? 'btn-submit' : 'btn-cancel'}`;
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
                next.className = 'px-3 py-1 btn-cancel rounded disabled:opacity-50';
                next.addEventListener('click', () => {
                    currentPage++;
                    fetchResults(currentPage);
                });
                paginationDiv.appendChild(next);
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                currentPage = 1;
                fetchResults(currentPage);
            });
            fetchResults(1);

        </script>
    </div>
@endsection
