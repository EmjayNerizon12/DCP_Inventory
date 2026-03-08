<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - DCP Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('icon/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="min-h-screen bg-blue-500 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 opacity-10">
        <div
            class="absolute top-0 -left-4 w-52 h-52 sm:w-72 sm:h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl animate-float">
        </div>
        <div class="absolute top-0 -right-4 w-52 h-52 sm:w-72 sm:h-72 bg-green-400 rounded-full mix-blend-multiply filter blur-xl animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-10 w-52 h-52 sm:w-72 sm:h-72 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl animate-float"
            style="animation-delay: 4s;"></div>
    </div>

    <div class="z-10 relative flex items-center justify-center p-2  ">
        <div
            class="w-full max-w-full grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-12 items-center md:my-10 my-0 md:mx-10    ">

            <!-- LEFT: Hero -->
            <div class="text-center lg:text-left md:space-y-6 space-y-1  ">
                <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold leading-tight md:inline    hidden">
                    <img class="h-40 md:block  hidden shadow-md" src="{{ asset('icon/header.png') }}" alt="">
                    <span style="font-family:Verdana, Geneva, Tahoma, sans-serif;"
                        class="
                        
                        text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-400 drop-shadow-lg">eDCP
                        Hub</span>
                    <br>
                    <span class="text-white md:block hidden text-xl sm:text-2xl lg:text-4xl font-medium mt-4 block">
                        A Centralized ICT Package Management <br class="hidden sm:block">for SDO San Carlos City Public
                        Schools
                    </span>
                </h1>

                <p
                    class="text-green-100 text-base sm:text-lg lg:text-xl max-w-2xl leading-relaxed hidden md:block  hidden ">
                    Welcome to the Inventory Management System – your dedicated companion for tracking inventory and
                    fostering a productive environment!
                </p>
            </div>



            <!-- RIGHT: Login -->
            <div class="flex justify-center lg:justify-end   ">
                <div class="w-full max-w-md">
                    <div class="bg-white/95   rounded-lg  p-6 sm:p-8 border border-white/20  ">

                        <!-- Logo -->
                        <div class="flex justify-center mb-2 sm:mb-8">
                            <div class="relative md:block hidden">
                                <div
                                    class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                    <img src="{{ asset('icon/logo.png') }}" class="w-20 h-20 sm:w-24 sm:h-24 "
                                        alt="">
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-7 h-7 sm:w-8 sm:h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-800" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                            <img class="h-40 md:hidden block shadow-md" src="{{ asset('icon/header.png') }}"
                                alt="">

                        </div>

                        <!-- Header -->
                        <div class="text-center mb-2 sm:mb-8">
                            <h2 class="text-xl sm:text-2xl font-semibold font-[Verdana] text-gray-700 mb-1 sm:mb-2">
                                Welcome Back</h2>
                            <p class="text-gray-600 font-[Verdana] text-sm sm:text-base">Please sign in to your account
                            </p>
                        </div>
                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                    Incorrect Login Credentials, Please Try Again<br>
                                    <ul class="mt-2 list-disc list-inside text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <!-- Login Form -->
                        <form class="space-y-5">

                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" id="username" name="username" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg  bg-gray-50"
                                    placeholder="Enter your username">
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg   bg-gray-50"
                                        placeholder="Enter your password">
                                    <button type="button" id="togglePassword"
                                        class="absolute shadow-none inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>



                            <button id="login-button-submit" type="button" onclick="login()"
                                class="w-full bg-gradient-to-r uppercase from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition transform hover:scale-[1.02] focus:ring-2 focus:ring-green-500">
                                Sign In
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-xs sm:text-sm text-gray-500">
                                Secured by <span class="font-semibold text-blue-600">eDCP Hub</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .success-icon {
            animation: scaleIn 0.5s ease-out, pulse 2s infinite 0.5s;
        }

        .checkmark {
            stroke-dasharray: 16;
            stroke-dashoffset: 16;
            animation: checkmark 0.6s ease-in-out 0.3s forwards;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0) rotate(-180deg);
                opacity: 0;
            }

            50% {
                transform: scale(1.2) rotate(-10deg);
            }

            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 16;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
            }
        }

        /* Error icon animation */
        .error-icon {
            animation: shake 0.6s ease-in-out, errorPulse 2s infinite 0.6s;
        }

        .warning-lines {
            stroke-dasharray: 12;
            stroke-dashoffset: 12;
            animation: drawLine 0.4s ease-out 0.2s forwards;
        }

        .warning-dot {
            opacity: 0;
            animation: fadeInDot 0.3s ease-out 0.6s forwards;
        }

        @keyframes shake {

            0%,
            20%,
            40%,
            60%,
            80%,
            100% {
                transform: translateX(0) scale(1);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-3px) scale(1.05);
            }
        }

        @keyframes drawLine {
            0% {
                stroke-dashoffset: 12;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes fadeInDot {
            0% {
                opacity: 0;
                transform: scale(0);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes errorPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
            }
        }

        /* Modal entrance animation */
        .modal-enter {
            animation: modalSlideIn 0.4s ease-out;
        }

        @keyframes modalSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
    <div class="modal hidden" id="login-modal">
        <div class="modal-content small-modal flex flex-col justify-center modal-enter space-y-4">
            <div id="status-icon"> </div>
            <div id="status-text" class="page-subtitle w-full text-center">
            </div>
            <div class="w-full flex justify-center items-center">

                <button id="modal-button" class="btn-green px-4 py-1 rounded-full">
                    Continue
                </button>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        if (type === 'password') {
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"></path>
                `;
        } else {
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
        }
    });
    const loginButton = document.getElementById('login-button-submit');
    const usernameInput = document.getElementById('username');
    async function login() {
        try {

            loginButton.disabled = true;
            loginButton.innerHTML = `<div class="spinner-container">
                <div class="spinner-sm" id="spinner"></div>
                </div>`;

            const username = usernameInput.value;
            const password = passwordInput.value;
            await loginMethod(username, password);
            await loginController(username, password);
        } catch (error) {

        } finally {
            loginButton.disabled = false;
            loginButton.innerHTML = 'Sign In';
        }
    }
    async function loginMethod(username, password) {
        const modal = document.getElementById('login-modal');
        const modalButton = document.getElementById('modal-button');
        const statusText = document.getElementById('status-text');
        const statusIcon = document.getElementById('status-icon');

        try {

            const response = await fetch('api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    username: username,
                    password: password
                })
            });
            const data = await response.json();
            console.log(data);
            if (data.success) {
                console.log(data.access_token)
                localStorage.setItem('token', data.access_token);
                modal.classList.remove('hidden');
                modalButton.classList.remove('btn-delete');
                modalButton.classList.add('btn-green');
                modalButton.addEventListener('click', function() {
                    window.location.href = data.redirect_url
                });
                statusText.innerHTML =
                    `<span class="text-green-500 text-xl font-bold text-center font-bold uppercase">SUCCESS </span> <br> <span class="text-center text-gray-500 text-base"> ${data.message} </span>`;


                statusIcon.innerHTML = `
                  <div class="flex justify-center  ">
                        <div class="w-16 h-16 rounded-full bg-green-600 flex items-center justify-center success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    `;
            } else {
                modal.classList.remove('hidden');
                modalButton.textContent = 'Try Again';
                statusText.innerHTML =
                    `<span class="text-red-500 text-xl font-bold text-center uppercase"> Something went wrong </span> <br> <span class="text-center text-gray-500 text-base"> ${data.message} </span>`;
                modalButton.classList.add('btn-delete');
                modalButton.classList.remove('btn-green');
                modalButton.onclick = function() {
                    modal.classList.add('hidden');
                }
                statusIcon.innerHTML = `
                
                 <div class="flex justify-center  ">
                               <div
                            class="w-16 h-16 rounded-full text-red-600 bg-white flex items-center justify-center error-icon">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 64 64" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xml:space="preserve" xmlns:serif="http://www.serif.com/"
                                style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <rect id="Icons" x="-704" y="-64" width="1280" height="800"
                                        style="fill:none;"></rect>
                                    <g id="Icons1" serif:id="Icons">
                                        <g id="Strike"> </g>
                                        <g id="H1"> </g>
                                        <g id="H2"> </g>
                                        <g id="H3"> </g>
                                        <g id="list-ul"> </g>
                                        <g id="hamburger-1"> </g>
                                        <g id="hamburger-2"> </g>
                                        <g id="list-ol"> </g>
                                        <g id="list-task"> </g>
                                        <g id="trash"> </g>
                                        <g id="vertical-menu"> </g>
                                        <g id="horizontal-menu"> </g>
                                        <g id="sidebar-2"> </g>
                                        <g id="Pen"> </g>
                                        <g id="Pen1" serif:id="Pen"> </g>
                                        <g id="clock"> </g>
                                        <g id="external-link"> </g>
                                        <g id="hr"> </g>
                                        <g id="info"> </g>
                                        <g id="warning"> </g>
                                        <path id="error-circle"
                                            d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734l-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z">
                                        </path>
                                        <g id="plus-circle"> </g>
                                        <g id="minus-circle"> </g>
                                        <g id="vue"> </g>
                                        <g id="cog"> </g>
                                        <g id="logo"> </g>
                                        <g id="radio-check"> </g>
                                        <g id="eye-slash"> </g>
                                        <g id="eye"> </g>
                                        <g id="toggle-off"> </g>
                                        <g id="shredder"> </g>
                                        <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g>
                                        <g id="react"> </g>
                                        <g id="check-selected"> </g>
                                        <g id="turn-off"> </g>
                                        <g id="code-block"> </g>
                                        <g id="user"> </g>
                                        <g id="coffee-bean"> </g>
                                        <g id="coffee-beans">
                                            <g id="coffee-bean1" serif:id="coffee-bean"> </g>
                                        </g>
                                        <g id="coffee-bean-filled"> </g>
                                        <g id="coffee-beans-filled">
                                            <g id="coffee-bean2" serif:id="coffee-bean"> </g>
                                        </g>
                                        <g id="clipboard"> </g>
                                        <g id="clipboard-paste"> </g>
                                        <g id="clipboard-copy"> </g>
                                        <g id="Layer1"> </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    `;
            }
        } catch (error) {
            console.error(error);
            modal.classList.remove('hidden');
            statusText.textContent = 'Something went wrong';
            modalButton.textContent = 'Try Again';
            modalButton.classList.add('btn-delete');
            modalButton.classList.remove('btn-green');
            modalButton.onclick = function() {
                modal.classList.add('hidden');
            }
            statusIcon.innerHTML = `
                
                 <div class="flex justify-center  ">
                              <div
                            class="w-16 h-16 rounded-full text-red-600 bg-white flex items-center justify-center error-icon">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 64 64" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xml:space="preserve" xmlns:serif="http://www.serif.com/"
                                style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <rect id="Icons" x="-704" y="-64" width="1280" height="800"
                                        style="fill:none;"></rect>
                                    <g id="Icons1" serif:id="Icons">
                                        <g id="Strike"> </g>
                                        <g id="H1"> </g>
                                        <g id="H2"> </g>
                                        <g id="H3"> </g>
                                        <g id="list-ul"> </g>
                                        <g id="hamburger-1"> </g>
                                        <g id="hamburger-2"> </g>
                                        <g id="list-ol"> </g>
                                        <g id="list-task"> </g>
                                        <g id="trash"> </g>
                                        <g id="vertical-menu"> </g>
                                        <g id="horizontal-menu"> </g>
                                        <g id="sidebar-2"> </g>
                                        <g id="Pen"> </g>
                                        <g id="Pen1" serif:id="Pen"> </g>
                                        <g id="clock"> </g>
                                        <g id="external-link"> </g>
                                        <g id="hr"> </g>
                                        <g id="info"> </g>
                                        <g id="warning"> </g>
                                        <path id="error-circle"
                                            d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734l-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z">
                                        </path>
                                        <g id="plus-circle"> </g>
                                        <g id="minus-circle"> </g>
                                        <g id="vue"> </g>
                                        <g id="cog"> </g>
                                        <g id="logo"> </g>
                                        <g id="radio-check"> </g>
                                        <g id="eye-slash"> </g>
                                        <g id="eye"> </g>
                                        <g id="toggle-off"> </g>
                                        <g id="shredder"> </g>
                                        <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g>
                                        <g id="react"> </g>
                                        <g id="check-selected"> </g>
                                        <g id="turn-off"> </g>
                                        <g id="code-block"> </g>
                                        <g id="user"> </g>
                                        <g id="coffee-bean"> </g>
                                        <g id="coffee-beans">
                                            <g id="coffee-bean1" serif:id="coffee-bean"> </g>
                                        </g>
                                        <g id="coffee-bean-filled"> </g>
                                        <g id="coffee-beans-filled">
                                            <g id="coffee-bean2" serif:id="coffee-bean"> </g>
                                        </g>
                                        <g id="clipboard"> </g>
                                        <g id="clipboard-paste"> </g>
                                        <g id="clipboard-copy"> </g>
                                        <g id="Layer1"> </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    `;
        }

    }

    async function loginController(username, password) {
        const response = await fetch('/login-submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                username: username,
                password: password,
            })
        });
        const data = await response.json();
        console.log('FROM PHP CONTROLLER' + data);
    }
</script>
