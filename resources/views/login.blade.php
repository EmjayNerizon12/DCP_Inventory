<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>Login - DCP Inventory Management System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<meta name="school-logo" content="{{ asset('icon/logo.png') }}">
		<meta name="school-name" content="Admin Access">
        
		<link
			href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"
			rel="stylesheet">
		<style>
			.login-body-font {
				font-family: "Plus Jakarta Sans", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
			}

			.login-title-font {
				font-family: "Space Grotesk", "Plus Jakarta Sans", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
			}
		</style>
		@vite(['resources/css/app.css','resources/css/admin.css'])
	</head>

		<body class="min-h-screen bg-gray-200 text-gray-800 antialiased login-body-font">
		<div class="min-h-screen flex items-center justify-center px-4 py-8">
			<div class="w-full max-w-md bg-white border border-gray-300 rounded-xl shadow-md p-6 sm:p-8">
				<div class="flex items-center justify-center gap-3 mb-5">
					<img src="{{ asset('icon/logo.png') }}"
						class="h-20 w-20 sm:h-30 sm:w-30 rounded-full border border-gray-300 bg-white p-1 shadow-sm" alt="eDCP Hub Logo">
				</div>

				<div class="text-center mb-7">
						<h1
							class="text-[1.85rem] sm:text-[2.1rem] leading-tight font-semibold tracking-tight text-gray-900 login-title-font">
						eDCP Hub
					</h1>
					<p class="mt-2 sm:text-lg text-sm leading-6 text-gray-600 font-medium">
						A Centralized ICT Package Management<br>
						for SDO San Carlos City Public Schools
					</p>
				</div>

				@if ($errors->any())
					<div class="mb-4 rounded-md border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
						Incorrect login credentials, please try again.
						<ul class="mt-2 list-disc pl-5">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form class="space-y-5" onsubmit="event.preventDefault(); login();">
					<div>
						<label for="username"
							class="block text-[0.86rem] font-semibold tracking-wide text-gray-700 mb-1.5">Username</label>
						<input type="text" id="username" name="username" required
							class="w-full rounded-md border border-gray-300 bg-white px-3.5 py-2.5 text-[0.95rem] text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500"
							placeholder="Enter your username">
					</div>

					<div>
						<label for="password"
							class="block text-[0.86rem] font-semibold tracking-wide text-gray-700 mb-1.5">Password</label>
						<div class="relative">
							<input type="password" id="password" name="password" required
								class="w-full rounded-md border border-gray-300 bg-white pl-3.5 pr-10 py-2.5 text-[0.95rem] text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500"
								placeholder="Enter your password">
							<button type="button" id="togglePassword"
								class="absolute shadow-none inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700">
								<svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0">
									</path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z">
									</path>
								</svg>
							</button>
						</div>
					</div>

					<button id="login-button-submit" type="submit"
						class="w-full rounded-md bg-gray-800 text-white text-[0.92rem] font-semibold tracking-[0.04em] py-2.5 hover:bg-gray-900 disabled:opacity-60 disabled:cursor-not-allowed">
						Sign In
					</button>
				</form>
			</div>
		</div>

		<div id="login-modal" class="fixed inset-0 z-50 hidden">
			<div class="fixed inset-0 bg-gray-500/60 transition-opacity"></div>
			<div class="fixed inset-0 flex items-center justify-center p-4">
				<div
					class="w-full max-w-md transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all border border-gray-200">
					<div class="px-6 py-5">
						<div id="status-text" class="text-[0.94rem] leading-6 text-gray-700"></div>
					</div>
					<div class="px-6 py-3 flex justify-end">
						<button id="modal-button"
							class="shadow inline-flex justify-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-[0.9rem] font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
							Continue
						</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			const togglePassword = document.getElementById('togglePassword');
			const passwordInput = document.getElementById('password');
			const eyeIcon = document.getElementById('eyeIcon');
			const loginButton = document.getElementById('login-button-submit');
			const usernameInput = document.getElementById('username');

			togglePassword.addEventListener('click', () => {
				const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
				passwordInput.setAttribute('type', type);

				if (type === 'password') {
					eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"></path>
                `;
				} else {
					eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
				}
			});

			async function login() {
				const modal = document.getElementById('login-modal');
				const modalButton = document.getElementById('modal-button');
				const statusText = document.getElementById('status-text');
				const successButtonClasses =
					'inline-flex justify-center shadow rounded-md border border-transparent bg-gray-800 px-4 py-2 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2';
				const errorButtonClasses =
					'inline-flex justify-center shadow rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';

				try {
					loginButton.disabled = true;
					loginButton.textContent = 'Signing In...';

					const response = await fetch('/login-submit', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
						},
						body: JSON.stringify({
							username: usernameInput.value,
							password: passwordInput.value,
						}),
					});

					const data = await response.json();

					modal.classList.remove('hidden');

					if (data.success) {
						statusText.innerHTML = `
                            <div class="flex gap-4 items-start">
                                
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100 shrink-0">
                                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12.5l2.5 2.5L16 9"></path>
                                    </svg>
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-base sm:text-2xl font-semibold text-gray-900">
                                    ${data.message}
                                    </h3>

                                    <p class="mt-1 text-sm sm:text-base text-gray-600 leading-relaxed">
                                          You have successfully logged into your account.
                                    </p>
                                </div>

                            </div>
                            `;
						modalButton.className = successButtonClasses;
						modalButton.textContent = 'Continue';
						modalButton.onclick = function() {
							window.location.href = data.redirect_url;
						};
					} else {
						statusText.innerHTML = `
                            <div class="flex gap-4 items-start">

                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 shrink-0">
                                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l6 6"></path>
                                    </svg>
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-gray-900">
                                        Login Failed
                                    </h3>

                                    <p class="mt-1 text-sm sm:text-base text-gray-600 leading-relaxed">
                                        ${data.message ?? "Invalid username or password. Please try again."}
                                    </p>
                                </div>

                            </div>
                            `;
						modalButton.className = errorButtonClasses;
						modalButton.textContent = 'Try Again';
						modalButton.onclick = function() {
							modal.classList.add('hidden');
						};
					}
				} catch (error) {
					modal.classList.remove('hidden');
					statusText.innerHTML =
						`<div class="flex items-start gap-3">
                        <div class="mt-0.5 h-10 w-10 rounded-full bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v5"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 16h.01"></path>
                                <circle cx="12" cy="12" r="9" stroke-width="2"></circle>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[0.98rem] font-semibold text-gray-900">Login failed</p>
                            <p class="mt-1 text-[0.92rem] text-gray-600">Something went wrong.</p>
                        </div>
                    </div>`;
					modalButton.className = errorButtonClasses;
					modalButton.textContent = 'Try Again';
					modalButton.onclick = function() {
						modal.classList.add('hidden');
					};
				} finally {
					loginButton.disabled = false;
					loginButton.textContent = 'Sign In';
				}
			}
		</script>
	</body>

</html>
