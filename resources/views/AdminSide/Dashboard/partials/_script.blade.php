  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          schoolChartLoaded();
          packageChartLoaded();
          itemTypeChartLoaded();
          const tabs = {
              "btn-item": "tab-item",
              "btn-package": "tab-package",
              "btn-school": "tab-school"
          };

          Object.keys(tabs).forEach(btnId => {
              document.getElementById(btnId).addEventListener("click", () => {

                  // Hide all contents
                  document.querySelectorAll(".tab-content").forEach(div => {
                      div.classList.add("hidden");
                  });

                  // Reset button styles
                  document.querySelectorAll(".tab-btn").forEach(btn => {
                      btn.classList.remove("tab-active");
                      btn.classList.add("tab-inactive");
                  });

                  // Show selected content
                  document.getElementById(tabs[btnId]).classList.remove("hidden");

                  // Highlight clicked button
                  const button = document.getElementById(btnId);
                  button.classList.add("tab-active");
                  button.classList.remove("tab-inactive");
              });
          });
      });
      let totals = [];
      let labels = [];
      const bgColors = [
          "#16A34A", // green
          "#DC2626", // red
          "#3B82F6", // blue fair
          "#FACC15", // yellow
          "#4F46E5", // indigo
          "#4B5563", // light gray - missing
          "#9CA3AF ", // light gray
          "#9CA3AF ", // light gray
          "#9CA3AF ", // light gray


      ];

      fetch("api/item-conditions")
          .then(res => res.json())
          .then(results => {

              const cardContainer = document.getElementById("card-condition-container");
              const tableBody = document.getElementById("condition-table");

              // Compute maxCount for progress bar percentages
              const maxCount = Math.max(...results.map(d => d.count));

              results.forEach((data, index) => {

                  // Collect totals and labels
                  totals.push(data.count);
                  labels.push(data.condition);

                  // --- Create colored card ---
                  const wrapper = document.createElement("div");
                  wrapper.className = "bg-white p-1 rounded-md shadow-sm border border-gray-300";

                  const newCard = document.createElement("div");
                  newCard.id = `card-${index + 1}`;
                  newCard.className =
                      "max-w-full flex flex-col justify-center mx-auto w-full rounded-sm p-3 text-center";

                  newCard.innerHTML = `
                    <div style="letter-spacing:0.05rem;" class="md:text-lg text-md uppercase font-semibold text-dark">
                        ${data.condition}
                    </div>
                    <div>
                        <div onclick="toggleCard(${data.id})" class="bg-white transform scale-100 hover:scale-110 transition duration-300 ease-in-out p-1 rounded-full shadow-md inline-flex border border-gray-300 items-center justify-center">
                            <div style="background-color:${bgColors[data.id - 1]};" 
                                class="w-12 h-12 md:w-16 md:h-16 text-white font-semibold flex items-center justify-center rounded-full">
                                <span class="md:text-lg text-lg">${data.count}</span>
                            </div>
                        </div>
                    </div>
                      `;

                  wrapper.appendChild(newCard);
                  cardContainer.appendChild(wrapper);

                  // --- Create table row with progress bar ---
                  const percent = (data.count / maxCount) * 100;
                  const color = bgColors[data.id - 1];

                  const row = document.createElement("tr");
                  row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-2">${data.condition}</td>
                    <td class="border border-gray-300 px-4 py-2 font-semibold text-center">${data.count}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <div class="progress-container">
                            <div class="progress-bar" style="width: ${percent}%; background-color: ${color};"></div>
                        </div>
                    </td>
                `;
                  tableBody.appendChild(row);

              });

              console.log("Totals:", totals, "Labels:", labels);

          })
          .catch(error => console.error("Error fetching data:", error));



      fetch('/Admin/api/count-equipment')
          .then(response => response.json())
          .then(data => {
              document.getElementById("cctv_count").textContent = `${data.cctv_count}`;
              document.getElementById("biometric_count").textContent = `${data.biometric_count}`;
              document.getElementById("isp_count").textContent = `${data.isp_count}`;
              document.getElementById("total_schools").textContent = `${data.total_schools}`;
          })
          .catch(error => console.error('Error fetching data:', error));





      document.querySelectorAll('.folder-btn').forEach(btn => {
          btn.addEventListener('click', () => {
              const targetId = btn.dataset.target;
              const target = document.getElementById(targetId);
              const arrow = btn.querySelector('.arrow');
              const isHidden = target.classList.contains('hidden');

              // Close others
              document.querySelectorAll('.folder-content').forEach(c => c.classList.add('hidden'));
              document.querySelectorAll('.arrow').forEach(a => a.textContent = '▶');

              // Open selected
              if (isHidden) {
                  target.classList.remove('hidden');
                  arrow.textContent = '';
                  // Initialize charts once
                  setTimeout(() => {
                      if (targetId === 'folder-item-type' && !window.itemTypeChartLoadedOnce) {}
                      if (targetId === 'folder-package' && !window.packageChartLoadedOnce) {}
                      if (targetId === 'folder-school' && !window.schoolChartLoadedOnce) {}
                  }, 150);
              }
          });
      });

      function toggleCard(cardId) {
          console.log(cardId);
          window.location.href = `/Admin/ItemConditions/${cardId}`
      }

      function itemTypeChartLoaded() {
          fetch('api/item-categories')
              .then(response => response.json())
              .then(data => {
                  data.sort((a, b) => b.total - a.total);

                  const labels = data.map(item => item.dcp_item_type.code);
                  const counts = data.map(item => item.total);

                  // ✅ Define your bar colors once
                  const colors = [
                      '#E94B3C',
                      '#F7931E',
                      '#8DC63F',
                      '#4CAF50',
                      '#F7931E',
                      '#E94B3C',
                      '#4CAF50',
                      '#8DC63F',
                  ];

                  let rows = '';
                  if (data.length > 0) {
                      data.forEach((item, index) => {
                          const color = colors[index % colors.length]; // cycle colors if more items
                          rows += `
                        <tr>
                            <td class="px-4 py-1 border border-gray-300 break-words" style="max-width: 300px>${item.dcp_item_type.code}</td>
                            <td class="px-4 py-1 border border-gray-300">${item.dcp_item_type.name}</td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-semibold" 
                                style="background-color: ${color}; color: #fff;">
                                ${item.total}
                            </td>
                        </tr>
                    `;
                      });
                  } else {
                      rows += `
                    <tr>
                        <td colspan="3" class="px-4 py-1 border border-gray-300 text-center font-semibold">
                            No Data Found
                        </td>
                    </tr>
                `;
                  }

                  document.getElementById('item-type-table').innerHTML = rows;

                  // Create Bar Chart
                  // Get canvas and parent container
                  const canvas = document.getElementById("myPieChart");
                  const parentDiv = canvas.parentElement;

                  // Dynamic height based on data length
                  parentDiv.style.height = `${labels.length * 40}px`;

                  // Get 2D context
                  const ctx = canvas.getContext("2d");

                  // Initialize Chart.js
                  new Chart(ctx, {
                      type: "bar",
                      data: {
                          labels: labels,
                          datasets: [{
                              label: "Items Count",
                              data: counts,
                              // Map colors dynamically to match labels length
                              backgroundColor: labels.map((_, i) => colors[i % colors.length]),
                              borderColor: "#ccc",
                              borderWidth: 1
                          }]
                      },
                      options: {
                          indexAxis: 'y',
                          responsive: true,
                          maintainAspectRatio: false, // fill parent container
                          plugins: {
                              legend: {
                                  display: false
                              },
                              title: {
                                  display: true,
                                  text: 'Items Count per Category'
                              },
                              datalabels: {
                                  anchor: 'end',
                                  align: 'right',
                                  color: '#000',
                                  font: {
                                      weight: 'bold',
                                      size: 12
                                  },
                                  formatter: v => v
                              }
                          },
                          scales: {
                              x: {
                                  beginAtZero: true,
                                  title: {
                                      display: true,
                                      text: 'Total Items'
                                  },
                                  ticks: {
                                      precision: 0
                                  }
                              },
                              y: {
                                  ticks: {
                                      autoSkip: false
                                  },
                                  title: {
                                      display: true,
                                      text: 'Item Category'
                                  }
                              }
                          }
                      },
                      plugins: [ChartDataLabels]
                  });

              })
              .catch(error => console.error('Error fetching data:', error));
      }

      function packageChartLoaded() {
          fetch('api/package-categories')
              .then(response => response.json())
              .then(data => {
                  data.sort((a, b) => b.total - a.total);

                  const labels = data.map(item => item.dcp_package_type.code);
                  const counts = data.map(item => item.total);

                  // ✅ Define bar colors (same used in chart)
                  const colors = [
                      '#E94B3C',
                      '#F7931E',
                      '#8DC63F',
                      '#4CAF50',
                      '#F7931E',
                      '#E94B3C',
                      '#4CAF50',
                      '#8DC63F',
                  ];

                  let rows = '';
                  if (data.length > 0) {
                      data.forEach((item, index) => {
                          const color = colors[index % colors.length]; // cycle colors if needed
                          rows += `
                        <tr>
                            <td class="px-4 py-1 border border-gray-300">${item.dcp_package_type.code}</td>
                            <td class="px-4 py-1 border border-gray-300">${item.dcp_package_type.name}</td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-semibold"
                                style="background-color: ${color}; color: #fff;">
                                ${item.total}
                            </td>
                        </tr>
                    `;
                      });
                  } else {
                      rows += `
                    <tr>
                        <td colspan="3" class="px-4 py-1 border border-gray-300 text-center font-semibold">
                            No Data Found
                        </td>
                    </tr>
                `;
                  }

                  // 🧱 Update table content
                  document.getElementById('package-type-table').innerHTML = rows;

                  // 🎨 Setup canvas + chart
                  const canvas = document.getElementById("pie_package");

                  const parentDiv = canvas.parentElement;

                  // Dynamic height based on data length
                  parentDiv.style.height = `${labels.length * 40}px`;

                  const ctx = canvas.getContext("2d");

                  new Chart(ctx, {
                      type: "bar",
                      data: {
                          labels: labels,
                          datasets: [{
                              label: "Total Package Acquired",
                              data: counts,
                              backgroundColor: colors,
                              borderColor: "#333",
                              borderWidth: 1
                          }]
                      },
                      options: {
                          indexAxis: 'y',
                          responsive: true,
                          maintainAspectRatio: false,
                          plugins: {
                              legend: {
                                  display: false
                              },
                              title: {
                                  display: true,
                                  text: 'Total Package Acquired per Category'
                              },
                              datalabels: {
                                  anchor: 'end',
                                  align: 'right',
                                  color: '#000',
                                  font: {
                                      weight: 'bold',
                                      size: 12
                                  },
                                  formatter: value => value
                              }
                          },
                          scales: {
                              x: {
                                  beginAtZero: true,
                                  title: {
                                      display: true,
                                      text: 'Total Packages'
                                  },
                                  ticks: {
                                      precision: 0
                                  }
                              },
                              y: {
                                  ticks: {
                                      autoSkip: false
                                  },
                                  title: {
                                      display: true,
                                      text: 'Package Type'
                                  }
                              }
                          }
                      },
                      plugins: [ChartDataLabels]
                  });
              })
              .catch(error => console.error('Error fetching data:', error));
      }

      function schoolChartLoaded() {
          fetch('api/school-categories')
              .then(response => response.json())
              .then(data => {
                  const labels = data.map(item => item.school.SchoolName);
                  const counts = data.map(item => item.total);
                  let rows = '';
                  data.sort((a, b) => b.total - a.total);



                  const canvas = document.getElementById("school_pie");
                  const parentDiv = canvas.parentElement;

                  // Dynamic height based on data length
                  parentDiv.style.height = `${labels.length * 40}px`;


                  const ctx = canvas.getContext("2d");

                  new Chart(ctx, {
                      type: "bar",
                      data: {
                          labels: labels,
                          datasets: [{
                              label: "Total DCP Batch Received",
                              data: counts,
                              backgroundColor: [
                                  '#E94B3C',
                                  '#F7931E',
                                  '#8DC63F',
                                  '#4CAF50',
                                  '#F7931E',
                                  '#E94B3C',
                                  '#4CAF50',
                                  '#8DC63F',
                              ],
                              borderColor: "#ccc",
                              borderWidth: 1
                          }]
                      },
                      options: {
                          indexAxis: 'y', // Horizontal bar chart
                          responsive: true,
                          maintainAspectRatio: false,
                          plugins: {
                              legend: {
                                  display: false
                              },
                              title: {
                                  display: true,
                                  text: 'Total DCP Batch Received per School'
                              },
                              datalabels: { // 👇 Show count value on each bar
                                  anchor: 'end',
                                  align: 'right',
                                  color: '#000',
                                  font: {
                                      weight: 'bold'
                                  },
                                  formatter: function(value) {
                                      return value;
                                  }
                              }
                          },
                          scales: {
                              x: {
                                  beginAtZero: true,
                                  ticks: {
                                      precision: 0
                                  }
                              },
                              y: {
                                  ticks: {
                                      autoSkip: false // 🔹 Ensures all labels show
                                  }
                              }
                          }
                      },
                      plugins: [ChartDataLabels] // ✅ Enable datalabels plugin
                  });

              })
              .catch(error => console.error('Error fetching data:', error));

      }
  </script>
