	<style>
		html {
			scroll-behavior: smooth;
		}

		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
	</style>

	<style>
		/* Main University Name */
		.division-name {
			font-family: 'Trajan Pro', 'Times New Roman', serif;
			/* fallback to Times New Roman */
			/* or 600 if using semi-bold */
			/* all caps */
			/* adjust between 48-72px depending on your layout */
			letter-spacing: 2px;
			/* slightly spread letters for a formal feel */
			/* black text */
			/* centered in layout */
			margin: 0;
			line-height: 1.2;
		}

		/* Tagline Text */
		.san-carlos {
			font-family: 'Times New Roman', serif;
			/* adjust between 12-18px */
			letter-spacing: 1px;
			text-align: left;
			line-height: 1.2;
		}

		[x-cloak] {
			display: none !important;
		}

		/* Success checkmark animation */
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

		/* Button hover effects */
		.btn-hover {
			transition: all 0.2s ease;
		}

		.btn-hover:hover {
			transform: translateY(-1px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}

		.user-profile-btn {
			background: rgba(255, 255, 255, 0.15);
			border: 1px solid rgba(255, 255, 255, 0.3);
			border-radius: 30px;
			color: white;
			display: flex;
			align-items: center;
			padding: 5px 15px 5px 5px;
			transition: all 0.2s;
		}

		.user-profile-btn:hover {
			background: rgba(255, 255, 255, 0.25);
		}

		.user-profile-btn img {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			margin-right: 10px;
			border: 2px solid rgba(255, 255, 255, 0.5);
		}

		.user-profile-btn .user-name {
			font-weight: 500;
			margin-right: 5px;
			max-width: 120px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.sidebar {
			position: fixed;
			top: 50px;
			left: 0;
			height: 100vh;
			width: 280px;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
			overflow-y: auto;
			transition: left 0.55s ease;
			z-index: 49;
			background-color: #20252c;
			color: white;
			scrollbar-width: none;
			-ms-overflow-style: none;
			border-right: 1px solid rgba(255, 255, 255, 0.1);
		}

		.sidebar::-webkit-scrollbar {	
			display: none;
		}

		.sidebar.hidden {
			left: -280px;
		}

		.main-content {
			padding: 90px 40px 40px;
			width: 100% !important;
			margin-left: 250px;
			transition: margin-left 0.55s ease;
		}

		.sidebar.hidden~.main-content {
			margin-left: 0;
		}

		.sidebar-title {
			background: rgba(107, 114, 128, 0.35);
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			border: 1px solid rgba(156, 163, 175, 0.35);
			color: white;
			box-shadow: 0 0 20px rgba(55, 65, 81, 0.35), inset 0 0 0 1px rgba(255, 255, 255, 0.2);
			letter-spacing: 0.05rem;
		}

		.title-icon {
			width: 35px;
			height: 35px;
			display: flex;
			align-items: center;
			justify-content: center;
			background: rgba(75, 85, 99, 0.75);
			color: #fff;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(31, 41, 55, 0.45);
			flex-shrink: 0;
		}

		.nav-link {
			padding: 0.7rem 1rem;
			border-radius: 12px;
			margin: 0.25rem 1rem;
			transition: all 0.3s ease;
			display: flex;
			font-size: 18px;
			align-items: center;
			white-space: nowrap;
			position: relative;
			font-weight: 400;
			letter-spacing: 0.05rem;
			backdrop-filter: blur(10px);
			text-decoration: none;
		}

		.nav-link:hover {
			background: rgba(255, 255, 255, 0.1);
			transform: translateX(4px);
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
			text-decoration: none;
		}

		.category-label {
			background: rgba(107, 114, 128, 0.28);
			backdrop-filter: blur(10px);
			-webkit-backdrop-filter: blur(10px);
			border: 1px solid rgba(156, 163, 175, 0.25);
			letter-spacing: 0.06rem;
			color: #fff;
			box-shadow: 0 0 18px rgba(55, 65, 81, 0.25), inset 0 0 0 1px rgba(255, 255, 255, 0.2);
			transform: translateX(4px);
		}

		.category-icon {
			width: 24px;
			height: 24px;
			display: flex;
			align-items: center;
			justify-content: center;
			background: rgba(75, 85, 99, 0.75);
			color: #fff;
			border-radius: 6px;
			box-shadow: 0 0 8px rgba(31, 41, 55, 0.4);
			flex-shrink: 0;
		}

		.nav-link.active {
			background: rgba(107, 114, 128, 0.6);
			color: #fff;
			font-weight: 700;
			font-size: 1.05rem;
			letter-spacing: 0.05rem;
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			border: 1px solid rgba(255, 255, 255, 0.25);
			border-radius: 10px;
			box-shadow: 0 8px 24px rgba(31, 41, 55, 0.35), inset 0 0 0 1px rgba(255, 255, 255, 0.2);
			transform: translateX(4px);
		}

		.nav-link svg {
			margin-right: 14px;
			width: 22px;
			height: 22px;
			opacity: 0.9;
			transition: all 0.3s ease;
			flex-shrink: 0;
		}

		.nav-link:hover svg,
		.nav-link.active svg {
			opacity: 1;
			transform: scale(1.1);
		}

		@media (max-width: 768px) {
			.user-profile-btn .user-name {
				display: none;
			}

			.user-profile-btn {
				padding: 5px;
			}
		}

		@media (max-width: 992px) {
			.sidebar {
				left: -280px;
				transition: left 0.55s ease;
			}

			.sidebar.show {
				left: 0;
			}

			.main-content {
				margin-left: 0;
				padding: 90px 0 0;
				transition: none;
			}
		}
	</style>
