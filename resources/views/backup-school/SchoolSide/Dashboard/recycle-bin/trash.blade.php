<div class="w-full">
    <div class="mt-4">
        <div class="text-lg font-medium uppercase tracking-wider">Packages Acquired</div>
        @php
            $bgColor = ['bg-blue-200', 'bg-green-200', 'bg-yellow-200', 'bg-pink-200'];
        @endphp
        <div style="letter-spacing: 0.05rem" class="  gap-2 grid md:grid-cols-5 grid-cols-2 mt-2">
            @foreach ($packagesWithCounts as $index => $package)
                <a href="{{ route('schools.packages.info', $package['id']) }}">
                    <div
                        class="  transform scale-100 hover:scale-105 flex items-center
                            py-1 px-4 rounded-sm text-gray-800 border border-gray-800 text-center
                            {{ $bgColor[$index % count($bgColor)] }}">
                        <b> {{ $package['count'] }} </b> - {{ $package['name'] }}
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</div>
<div class="flex gap-5 md:flex-row flex-col mt-5">
    <div class="md:w-1/2 w-full flex flex-col gap-1 ">
        <div class="uppercase font-medium tracking-wide">
            Conditions of Items
        </div>
        <div class="overflow-y-auto  ">
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4">
                <canvas id="conditionBarChart"></canvas>
            </div>
        </div>
    </div>
    <div class="md:w-1/2 w-full flex flex-col gap-1 " style="max-height: 450px;">
        <div class="uppercase font-medium tracking-wide">
            Item Received from DCP Batches
        </div>
        <div class="overflow-y-auto  ">
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4">
                <canvas id="itemBarChart"></canvas>
            </div>
        </div>
    </div>

</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const ctx = document.getElementById('conditionBarChart').getContext('2d');

        // 🎨 Tailwind-like color palette
        const colors = [
            "#86efac", // green-300
            "#fca5a5", // red-300
            "#fde047", // yellow-300
            "#93c5fd", // blue-300
            "#f9a8d4", // pink-300
            "#c4b5fd", // purple-300
            "#67e8f9", // cyan-300
            "#fcd34d" // amber-300
        ];

        // 🧩 Fetch data from your Laravel route
        fetch('/School/get-current-conditions')
            .then(response => response.json())
            .then(data => {
                console.log("Condition data:", data); // Debugging output

                const conditionLabels = Object.keys(data);
                const conditionCounts = Object.values(data);
                const backgroundColors = conditionLabels.map((_, i) => colors[i % colors.length]);

                // Create Chart.js bar chart
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: conditionLabels,
                        datasets: [{
                            label: 'Total Items',
                            data: conditionCounts,
                            backgroundColor: backgroundColors,
                            borderColor: ' #1e293b',
                            borderWidth: 1,
                            borderRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Items by Condition',
                                color: '#1f2937',
                                font: {
                                    size: 20,
                                    weight: 'normal'
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' items';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#374151',
                                    stepSize: 1
                                },
                                title: {
                                    display: true,
                                    text: 'Count',
                                    color: '#4b5563'
                                },
                                grid: {
                                    color: '#e5e7eb'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#374151'
                                },
                                title: {
                                    display: true,
                                    text: 'Condition',
                                    color: '#4b5563'
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching condition data:', error);
            });
    });
</script>
<script>
    const itemsArray = @json($item_sorted->toArray());

    const itemLabels = Object.keys(itemsArray);
    const itemCounts = Object.values(itemsArray);

    // 🎨 Tailwind color palette
    const colors = [
        "#fca5a5", "#fde047", "#86efac", "#93c5fd",
        "#c4b5fd", "#fcd34d", "#f9a8d4", "#67e8f9"
    ];

    const backgroundColors = itemLabels.map((_, i) => colors[i % colors.length]);

    // 🧩 Fix: maintain readable bar size even if only 1 item
    const canvas = document.getElementById('itemBarChart');
    const fixedBarHeight = 35;
    const minChartHeight = 200; // ensures visible chart even for 1-2 items
    canvas.height = Math.max(itemLabels.length * fixedBarHeight, minChartHeight);

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: itemLabels,
            datasets: [{
                label: 'Item Count',
                data: itemCounts,
                borderWidth: 1,
                backgroundColor: backgroundColors,
                borderColor: '#1e293b',
                borderRadius: 0,
                barThickness: 25 // consistent bar thickness
            }]
        },
        options: {
            indexAxis: 'y', // horizontal bar chart
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Items Received from DCP Batches',
                    color: '#1f2937',
                    font: {
                        size: 20,
                        weight: '600'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: (context) => `${context.parsed.x} items`
                    }
                },
                // ✅ Optional: show values at end of bars
                datalabels: {
                    color: '#374151',
                    anchor: 'end',
                    align: 'right',
                    font: {
                        weight: 'bold'
                    },
                    formatter: (value) => value
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: '#374151',
                        stepSize: 1
                    },
                    title: {
                        display: true,
                        text: 'Count',
                        color: '#4b5563'
                    },
                    grid: {
                        color: '#e5e7eb'
                    }
                },
                y: {
                    ticks: {
                        color: '#374151'
                    },
                    title: {
                        display: true,
                        text: 'Item Name',
                        color: '#4b5563'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
<!-- Main Content -->
{{-- <div class="flex-grow flex flex-col items-center justify-center mx-5">

        <!-- Welcome Card -->
        <div class="bg-white rounded-lg shadow-lg p-8    max-w-xl w-full   text-center mt-16 mb-8"
            style="border:1px solid #ccc">
            <h1 class="text-2xl font-bold mb-4">Welcome to the<br>
                <span class="text-blue-900">DepEd, Region I - Ilocos Region,<br>DCP Monitoring System (DCPMS)</span>
            </h1>
            <p class="text-gray-700 text-base mb-2">
                This system is for the DCP Packages Batches Inventory of recipient schools and request for service repair of
                with and no warranty units or items to track the status of the DCP Packages.
            </p>
            <p class="text-gray-600 text-sm">
                Efficiently manage, monitor, and report your school's DCP inventory and service requests in one place.
            </p>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <!-- Acknowledgment Card with Image on the Right -->
        <div
            class="bg-white border border-blue-200 rounded-lg shadow-md p-6 max-w-4xl w-full flex flex-col md:flex-row items-center mb-8">
            <!-- Info Left -->
            <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left">
                <h2 class="text-lg font-bold text-blue-900 mb-1">Acknowledgment</h2>
                <p class="text-gray-700 text-center md:text-left mb-2">
                    This DCP Inventory System was proudly developed by
                </p>
                <div class="text-blue-800 font-semibold text-xl mb-1">Em-jay A. Nerizon</div>
                <div class="text-gray-500 text-sm mb-2">System Developer</div>
                <div class="flex flex-col items-center md:items-start mt-2">
                    <span class="text-gray-600 text-sm">Contact:</span>
                    <span class="text-blue-700 text-sm font-medium">emjay.nerizon@email.com</span>
                    <span class="text-gray-600 text-sm">Mobile:</span>
                    <span class="text-blue-700 text-sm font-medium">+63 912 345 6789</span>
                </div>
                <div class="mt-3 text-xs text-gray-400">
                    Credentials: BSIT, Web & Systems Developer
                </div>
            </div>
            <!-- Image Right -->
            <div class="flex-shrink-0 mt-6 md:mt-0 md:ml-8 flex justify-center">
                <img src="{{ asset('icon/mj.jpg') }}" alt="Em-jay A. Nerizon"
                    class="w-40 h-40 rounded-full shadow border-2 border-blue-300 object-cover">
            </div>
        </div>

        <!-- System Features Card -->
        <div class="bg-white rounded-lg shadow p-6 max-w-xl w-full mb-8">
            <h3 class="text-blue-800 font-semibold text-lg mb-2">System Features</h3>
            <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left">
                <li>Batch and itemized DCP inventory management</li>
                <li>Warranty and service request tracking</li>
                <li>Real-time status monitoring and reporting</li>
                <li>User-friendly dashboard for schools and admins</li>
                <li>Secure and role-based access</li>
            </ul>
        </div>

        <!-- Contact Support Card -->
        <div class="bg-blue-100 border border-blue-200 rounded-lg shadow p-6 max-w-xl w-full text-center">
            <h3 class="text-blue-900 font-semibold text-lg mb-2">Need Help?</h3>
            <p class="text-gray-700 text-sm mb-2">
                For support, suggestions, or technical issues, please contact the system developer.
            </p>
            <div class="text-blue-800 font-medium">Em-jay A. Nerizon</div>
            <div class="text-blue-700 text-sm">emjay.nerizon@email.com</div>
            <div class="text-blue-700 text-sm">+63 912 345 6789</div>
        </div>

    </div> --}}
