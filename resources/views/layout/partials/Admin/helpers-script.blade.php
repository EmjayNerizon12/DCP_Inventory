<script>
	function renderLoadingOnTable() {
		return `
		<div class="spinner-container my-10" id="spinner-container">
			<div class="spinner-md"></div>
		</div> 
	`;
	}

	function addOverflow() {
		document.body.classList.remove('overflow-hidden');
	}

	function removeOverflow() {
		document.body.classList.add('overflow-hidden');
	}

	function toggleCollapse(containerId, index) {
		const collapse = document.getElementById(containerId);
		const toggleButton = document.getElementById(`toggle-button-${index}`)
		if (!collapse) {
			return;
		}
		collapse.classList.toggle('hidden'); // just show/hide
		if (collapse.classList.contains('hidden')) {
			// Section is now hidden → show dashboard icon
			toggleButton.innerHTML = `@include('SchoolSide.components.svg.dashboard-sm')`;
		} else {
			// Section is now visible → show area icon
			toggleButton.innerHTML = `@include('SchoolSide.components.svg.cross-sm')`;
		}

	}

	function scrollTo(id) {
		const element = document.getElementById(id);
		if (element) {
			element.scrollIntoView({
				behavior: 'smooth', // smooth sliding
				block: 'start' // align element at top
			});
		}
	}

		function resetButton(button, text) {
			button.disabled = false;
			button.innerHTML = text;
		}

		function resetButtonText(button, text) {
			if (!button) return;
			button.disabled = false;
			button.textContent = text;
		}

		function buttonLoading(button) {
			button.disabled = true;

			button.innerHTML = `
		<div class="spinner-container w-full">
		<span class="spinner-xs">
			</span>
		</div>`;
		}

		function setLoadingText(button, loadingText = 'Loading...') {
			if (!button) return;
			button.disabled = true;
			button.textContent = loadingText;
		}

		function clearErrors() {
			document.querySelectorAll('.error').forEach(el => {
				el.textContent = '';
			});
			document.querySelectorAll('[data-error]').forEach(el => {
				el.textContent = '';
			});
		}

		function handleErrors(errors, scope = document) {
			scope.querySelectorAll('[data-error]').forEach(el => el.innerText = '');

			for (const field in errors) {
				const errorDiv = scope.querySelector(`[data-error="${field}"]`);
				if (errorDiv) {
					errorDiv.innerText = errors[field][0];
				}
			}
		}

			function handlesErrors(errors, scope = document) {
				return handleErrors(errors, scope);
			}

		function renderStatusNotification(data, options = {}) {
			const container = document.getElementById('status-notification-container');
			const autoCloseMs = typeof options.autoCloseMs === 'number' ? options.autoCloseMs : 4500;

			const isSuccess = !!data?.success;
			const message = (data?.message ?? data?.errors ?? '').toString();

			const wrapper = document.createElement('div');
			wrapper.className = 'flex items-icenter justify-between relative p-2 bg-white border border-gray-200 rounded-md shadow-lg';
			wrapper.setAttribute('role', 'status');
			wrapper.setAttribute('aria-live', 'polite');

			wrapper.innerHTML = `
				<div class="flex items-center gap-3 mr-5">
					<div class="flex items-center justify-center w-6 h-6 rounded-full ${isSuccess ? 'text-green-600' : 'text-red-600'} text-base">
						${isSuccess ? `
							<svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7 13L10 16L17 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
							</svg>
						` : `
							<svg viewBox="0 0 24 24" class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 8V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
								<path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
								<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
							</svg>
						`}
					</div>
					<p class="text-base font-medium text-gray-800" data-notification-message></p>
				</div>
				<button type="button" class="text-gray-800 hover:text-gray-600 w-6 h-6 shadow-none" aria-label="Close notification">
					<svg fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z"></path>
					</svg>
				</button>
			`;

			const messageEl = wrapper.querySelector('[data-notification-message]');
			if (messageEl) messageEl.textContent = message || (isSuccess ? 'Success.' : 'Something went wrong.');

			const closeBtn = wrapper.querySelector('button');
			if (closeBtn) {
				closeBtn.addEventListener('click', () => wrapper.remove());
			}

			if (container) {
				container.appendChild(wrapper);
			} else {
				document.body.appendChild(wrapper);
			}

			if (autoCloseMs > 0) {
				setTimeout(() => {
					if (wrapper && wrapper.isConnected) wrapper.remove();
				}, autoCloseMs);
			}

			return wrapper;
		}

		function renderStatusModal(data) {
			if (document.getElementById('status-notification-container')) {
				return renderStatusNotification(data);
			}

			const modal = document.getElementById('status-modal');
			const icon = document.getElementById('modal-icon');
			const titleEl = document.getElementById('modal-title');
			const messageEl = document.getElementById('modal-message');
		if (data.success) {
			messageEl.innerHTML = data.message;

			titleEl.textContent = 'SUCCESS';
			titleEl.className = 'text-lg font-bold text-green-600';
			icon.innerHTML = `
		<div class="flex justify-center">
			<div
				class="w-14 h-14 rounded-full bg-white  text-green-600 flex items-center justify-center success-icon">
				<svg class=" w-12 h-12" viewBox="0 0 600 600" version="1.1" id="svg9724"
					sodipodi:docname="check-circle.svg"
					inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)"
					xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
					xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
					xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"
					fill="currentColor">
					<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<defs id="defs9728"></defs>
						<sodipodi:namedview id="namedview9726" pagecolor="#ffffff" bordercolor="#666666"
							borderopacity="1.0" inkscape:showpageshadow="2" inkscape:pageopacity="0.0"
							inkscape:pagecheckerboard="0" inkscape:deskcolor="#d1d1d1" showgrid="true"
							inkscape:zoom="0.42059315" inkscape:cx="175.942" inkscape:cy="626.49618"
							inkscape:window-width="1920" inkscape:window-height="1009"
							inkscape:window-x="0" inkscape:window-y="1080" inkscape:window-maximized="1"
							inkscape:current-layer="g10449" showguides="true">
							<inkscape:grid type="xygrid" id="grid9972" originx="0" originy="0">
							</inkscape:grid>
						</sodipodi:namedview>
						<g id="g10449"
							transform="matrix(0.95173205,0,0,0.95115787,13.901174,12.168794)"
							style="stroke-width:1.05103">
							<g id="path10026" inkscape:transform-center-x="-0.59233046"
								inkscape:transform-center-y="-20.347403"
								transform="matrix(1.3807551,0,0,1.2700888,273.60014,263.99768)"></g>
							<g id="g11314"
								transform="matrix(1.5092301,0,0,1.3955555,36.774048,-9.4503933)"
								style="stroke-width:50.6951"></g>
							<path id="path501"
								style="color:currentColor;fill:currentColor;stroke-linecap:round;stroke-linejoin:round;-inkscape-stroke:none"
								d="m 573.78125,71.326172 c -11.14983,0.0041 -21.84136,4.437288 -29.72266,12.324219 L 269.17773,358.69727 201.88007,226.17417 c -16.41326,-16.42281 -43.03211,-16.43069 -59.45508,-0.0176 -16.42281,16.41326 -16.43068,43.03211 -0.0176,59.45508 l 97.034,162.277 c 16.42109,16.42734 43.05156,16.42734 59.47265,0 L 603.53125,143.08789 c 16.41439,-16.4232 16.40651,-43.04355 -0.0176,-59.457031 -7.88689,-7.88216 -18.58202,-12.308309 -29.73242,-12.304687 z M 297.41602,-12.826172 C 216.90703,-11.965911 137.45719,19.625316 77.640625,79.496094 -23.103069,180.33109 -43.683279,336.82447 27.546875,460.31055 98.777031,583.79662 244.53398,644.23617 382.17383,607.32227 519.81368,570.40835 615.82422,445.15088 615.82422,302.57422 c -1.6e-4,-23.21855 -18.82247,-42.04086 -42.04102,-42.04102 -23.21931,-9.2e-4 -42.04281,18.82171 -42.04297,42.04102 0,104.9608 -70.10118,196.38166 -171.34765,223.53515 C 259.14611,553.26287 152.80736,509.18649 100.38086,418.29883 47.954364,327.41117 62.989814,213.1262 137.12305,138.92578 211.25628,64.725365 325.35936,49.693075 416.14258,102.1543 c 20.1039,11.61703 45.81879,4.73687 57.43554,-15.367191 C 485.19415,66.68416 478.31507,40.97088 458.21289,29.353516 408.08311,0.38483622 352.50111,-13.414771 297.41602,-12.826172 Z"
								sodipodi:nodetypes="scccccccccsssssscccssscscs"></path>
						</g>
					</g>
				</svg>
			</div>
		</div>`;
		} else {
			titleEl.textContent = 'ERROR';
			messageEl.innerHTML = data.errors;

			titleEl.className = 'text-lg font-bold text-red-600';
			icon.innerHTML = `
		<div class="flex justify-center ">
			<div
				class="w-14 h-14 rounded-full text-red-600 bg-white flex items-center justify-center error-icon">
				<svg class="w-14 h-14" xmlns:dc="http://purl.org/dc/elements/1.1/"
					xmlns:cc="http://creativecommons.org/ns#"
					xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
					xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
					xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
					xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
					viewBox="0 0 400 400.00001" id="svg2" version="1.1"
					inkscape:version="0.91 r13725" sodipodi:docname="error.svg" fill="currentColor">
					<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<defs id="defs4"></defs>
						<sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="currentColor"
							borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2"
							inkscape:zoom="0.98994949" inkscape:cx="244.49048" inkscape:cy="180.68004"
							inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="false"
							units="px" showguides="true" inkscape:guide-bbox="true"
							inkscape:window-width="1920" inkscape:window-height="1056"
							inkscape:window-x="1920" inkscape:window-y="24"
							inkscape:window-maximized="1">
							<sodipodi:guide position="200.71429,121.42857" orientation="1,0"
								id="guide23298"></sodipodi:guide>
						</sodipodi:namedview>
						<metadata id="metadata7">
							<rdf:rdf>
								<cc:work rdf:about="">
									<dc:format>image/svg+xml</dc:format>
									<dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage">
									</dc:type>
									<dc:title> </dc:title>
								</cc:work>
							</rdf:rdf>
						</metadata>
						<g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1"
							transform="translate(0,-652.36216)">
							<path
								style="color:currentColor;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:currentColor;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;baseline-shift:baseline;text-anchor:start;white-space:normal;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:currentColor;solid-opacity:1;fill:currentColor;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:24.99999809;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
								d="M 200,652.36214 C 89.691101,652.36214 -5e-7,742.05324 -5e-7,852.36214 -5e-7,962.67104 89.691101,1052.3622 200,1052.3622 c 110.3089,0 200,-89.69116 200,-200.00006 0,-110.3089 -89.6911,-200 -200,-200 z m 0,25 c 96.7979,0 175,78.2021 175,175 0,96.7979 -78.2021,175.00006 -175,175.00006 -96.7979,0 -175,-78.20216 -175,-175.00006 0,-96.7979 78.2021,-175 175,-175 z m -92.4785,64.8438 -17.677799,17.6777 92.478499,92.4785 -92.478499,92.4785 17.677799,17.6778 92.4785,-92.4785 92.4785,92.4785 17.6777,-17.6778 -92.4785,-92.4785 92.4785,-92.4785 -17.6777,-17.6777 L 200,834.68444 Z"
								id="error" inkscape:connector-curvature="0"
								sodipodi:nodetypes="ssssssssssccccccccccccc">
								<title id="title23607">error</title>
							</path>
						</g>
					</g>
				</svg>
			</div>
		</div>`;
		}

		modal.classList.remove('hidden');
		modal.classList.add('flex');
	}

	function closeModal() {
		const modal = document.getElementById('status-modal');
		modal.classList.add('hidden');
		modal.classList.remove('flex');
	}


	function formatNumber(num, decimals = 2) {
		if (num === null || num === undefined || num === '0.00') return '0.00';

		return Number(num).toLocaleString(undefined, {
			minimumFractionDigits: decimals,
			maximumFractionDigits: decimals
		});
	}

	function formatDate(dateString) {
		if (!dateString) return '';

		const date = new Date(dateString);

		if (isNaN(date)) return 'Invalid Date';

		return date.toLocaleDateString('en-US', {
			year: 'numeric',
			month: 'long',
			day: 'numeric'
		});
	}

	function openComponentModal(id) {
		document.getElementById(id).classList.remove('hidden');
		document.body.classList.add('overflow-hidden');
	}

	function closeComponentModal(id) {
		document.getElementById(id).classList.add('hidden');
		document.body.classList.remove('overflow-hidden');
		clearErrors();
	}
</script>
