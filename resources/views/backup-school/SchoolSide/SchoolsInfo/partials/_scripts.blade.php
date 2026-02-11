<!-- Add Leaflet.js for map display -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@php
    $lat = optional(Auth::guard('school')->user()->school->schoolCoordinates)->Latitude ?? 15.928;
    $lon = optional(Auth::guard('school')->user()->school->schoolCoordinates)->Longitude ?? 120.348;
@endphp

<input type="hidden" name="latitude" id="latitude" value="{{ $lat }}">
<input type="hidden" name="longitude" id="longitude" value="{{ $lon }}">
<script>
    function openDiv(divNumber, btn) {
        // Hide all divs
        document.getElementById("div1").classList.add("hidden");
        document.getElementById("div2").classList.add("hidden");
        document.getElementById("div3").classList.add("hidden");

        // Show selected div
        document.getElementById("div" + divNumber).classList.remove("hidden");

        // Reset all buttons
        const allButtons = btn.parentElement.querySelectorAll("button");
        allButtons.forEach(b => {
            b.classList.remove("custom-btn-active");
            b.classList.add("custom-btn-inactive");
        });

        // Activate the clicked button
        btn.classList.add("custom-btn-active");
        btn.classList.remove("custom-btn-inactive");
    }

    function addSchoolData() {
        document.getElementById('add-schooldata-modal').classList.remove('hidden');
    }

    function closeAddSchoolData() {
        document.getElementById('add-schooldata-modal').classList.add('hidden');
    }

    function closeEditModal() {
        document.getElementById('school-data-form_update').classList.add('hidden');
    }

    function showEditForm(pk_id, gradeLevelId, registeredLearners, teachers, sections, classrooms) {

        const select = document.getElementById('GradeLevelID');

        // Set the selected value
        select.value = gradeLevelId;

        // Disable all other options
        for (let option of select.options) {
            option.disabled = option.value !== gradeLevelId;
        }
        document.getElementById('RegisteredLearners').value = registeredLearners;
        document.getElementById('Teachers').value = teachers;
        document.getElementById('Sections').value = sections;
        document.getElementById('Classrooms').value = classrooms;
        document.getElementById('pk').value = pk_id;
        document.getElementById('school-data-form_update').classList.remove('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // School map display
        const latitude = document.getElementById('latitude').value;
        const longitude = document.getElementById('longitude').value;
        var lat = parseFloat(latitude);
        var lon = parseFloat(longitude);
        var map = L.map('school-map').setView([lat, lon], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 14,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        L.marker([lat, lon]).addTo(map);
        // Reverse geocode to get location only
        fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lon)
            .then(response => response.json())
            .then(function(data) {
                var address = data.address || {};
                var street = address.road || address.pedestrian || address.cycleway || address.footway ||
                    '';
                var barangay = address.suburb || address.village || address.neighbourhood || address
                    .hamlet || address.barangay || '';
                var city = address.city || address.town || address.municipality || address.village ||
                    address.county || '';
                var province = address.state || address.region || address.province || '';
                var parts = [street, barangay, city, province].filter(Boolean);
                var location = parts.length ? parts.join(', ') : 'Location not found.';
                document.getElementById('location-name').textContent = 'Location: ' + location;
            })
            .catch(function() {
                document.getElementById('location-name').textContent = 'Unable to fetch location info.';
            });
    });


    function delete_school_data(id) {
        if (confirm('Are you sure you want to delete this school data?')) {
            window.location.href = '/School/delete-school-data/' + id;
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        // --- District Dropdown Logic ---
        const schoolLevelInput = document.getElementById('SchoolLevelInput');
        const district = document.getElementById('District');
        const elementaryDistricts = [
            '1A', '1B', '2A', '2B', '3A', '3B', '4A', '4B',
        ];
        const highSchoolDistricts = ['5A', '5B'];

        function populateDistricts(level) {
            district.innerHTML = '<option value="">Select District</option>';
            if (level === 'Elementary School') {
                elementaryDistricts.forEach(function(d) {
                    const opt = document.createElement('option');
                    opt.value = d;
                    opt.textContent = d;
                    district.appendChild(opt);
                });
                district.disabled = false;
            } else if (level === 'Junior High School' || level === 'Senior High School') {
                highSchoolDistricts.forEach(function(d) {
                    const opt = document.createElement('option');
                    opt.value = d;
                    opt.textContent = d;
                    district.appendChild(opt);
                });
                district.disabled = false;
            } else {
                district.disabled = true;
            }
        }

        // Use the actual school level value from the readonly input
        const currentLevel = schoolLevelInput ? schoolLevelInput.value : '';
        populateDistricts(currentLevel);

        // Set selected district if available
        const currentDistrict = "{{ Auth::guard('school')->user()->school->District }}";
        if (currentDistrict) {
            district.value = currentDistrict;
        }
        // No need for change event since school level is readonly
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Disable submit button if no grade level is selected
        const gradeLevelSelect = document.querySelector('select[name="GradeLevelID"]');
        const submitBtn = document.querySelector('#school-data-form button[type="submit"]');

        function toggleSubmitBtn() {
            if (gradeLevelSelect && submitBtn) {
                submitBtn.disabled = !gradeLevelSelect.value;
                submitBtn.classList.toggle('opacity-50', !gradeLevelSelect.value);
                submitBtn.classList.toggle('cursor-not-allowed', !gradeLevelSelect.value);
            }
        }

        if (gradeLevelSelect && submitBtn) {
            gradeLevelSelect.addEventListener('change', toggleSubmitBtn);
            toggleSubmitBtn(); // Initial check
        }
    });
</script>
