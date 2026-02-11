<style>
    html {
        scroll-behavior: smooth;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    [x-cloak] {
        display: none !important;
    }

    /* Target the element you want to scroll */
    .scrollable-element {
        overflow-y: auto;
        /* enable vertical scrolling */
        max-height: 400px;
        /* optional, for demo */
    }

    /* WebKit scrollbar styles */
    .scrollable-element::-webkit-scrollbar {
        width: 4px;
        /* super thin width */
        height: 4px;
        /* for horizontal scrollbar if needed */
    }

    .scrollable-element::-webkit-scrollbar-track {
        background: transparent;
        /* optional: track background */
    }

    .scrollable-element::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.5);
        /* thumb color */
        border-radius: 10px;
        /* rounded edges */
    }

    .scrollable-element::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.7);
        /* hover effect */
    }


    .division-name {
        font-family: 'Trajan Pro', 'Times New Roman', serif;

        letter-spacing: 2px;

        margin: 0;
        line-height: 1.2;
    }

    .san-carlos {
        font-family: 'Times New Roman', serif;
        letter-spacing: 1px;
        text-align: left;

        line-height: 1.2;
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

    /* Responsive adjustments */

    /* --- SIDEBAR BASE --- */
    .sidebar {

        position: fixed;
        top: 50;
        left: 0;
        height: 100vh;
        width: 280px;
        box-shadow: 0px 0 5px rgba(0, 0, 0, 0.4);
        overflow-y: auto;
        transition: left 0.5s eas e;
        /* ONLY LEFT! */
        z-index: 50;
        background-color: #192563;
        color: white;
        overflow-y: scroll;
        /* keeps scroll functionality */
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE/Edge */
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar {
        display: none;
        /* Chrome/Safari */
    }

    .sidebar.hidden {
        left: -280px;
        /* slide out */
    }

    .main-content {
        padding: 90px 40px 40px;
        width: 100% !important;
        margin-left: 250px;
        transition: margin-left 0.55s ease;
        /* match sidebar */
    }

    .sidebar.hidden~.main-content {
        margin-left: 0;
        /* shift main content when hidden */
    }

    .sidebar-title {
        background: rgba(20, 135, 217, 0.25);
        color: #0f172a;

        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);

        border: 1px solid rgba(20, 135, 217, 0.35);
        color: white;
        box-shadow: 0 0 20px rgba(20, 135, 217, 0.35),
            inset 0 0 0 1px rgba(255, 255, 255, 0.25);

        letter-spacing: 0.05rem;
    }

    .title-icon {
        width: 35px;
        height: 35px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(20, 135, 217, 0.6);
        color: #ffffff;

        border-radius: 8px;

        box-shadow:
            0 0 10px rgba(20, 135, 217, 0.6);

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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        background: rgba(20, 135, 217, 0.15);
        color: #0f172a;

        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);

        border: 1px solid rgba(20, 135, 217, 0.25);
        letter-spacing: 0.06rem;
        color: #ffffff;

        box-shadow:
            0 0 18px rgba(20, 135, 217, 0.25),
            inset 0 0 0 1px rgba(255, 255, 255, 0.3);

        transform: translateX(4px);
    }

    .category-icon {
        width: 24px;
        height: 24px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(20, 135, 217, 0.6);
        color: #ffffff;

        border-radius: 6px;

        box-shadow:
            0 0 8px rgba(20, 135, 217, 0.5);

        flex-shrink: 0;
    }


    .nav-link.active {
        background: rgba(20, 135, 217, 0.55);
        /* translucent blue */
        color: #ffffff;

        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: 0.05rem;

        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);

        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 10px;

        box-shadow:
            0 8px 24px rgba(20, 135, 217, 0.35),
            inset 0 0 0 1px rgba(255, 255, 255, 0.2);

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

    .sidebar.collapsed .nav-link svg {
        margin-right: 0;
    }

    .nav-link:hover svg,
    .nav-link.active svg {
        opacity: 1;
        transform: scale(1.1);
    }




    @media (max-width: 768px) {

        .navbar-brand {
            font-size: 1.2rem;
        }

        .user-profile-btn .user-name {
            display: none;
        }

        .user-profile-btn {
            padding: 5px;
        }
    }


    /* --- MOBILE --- */
    @media (max-width: 992px) {
        .sidebar {
            left: -280px;
            transition: left 0.55s ease;
            /* same speed */
        }

        .sidebar.show {
            left: 0;
            /* slide in */
        }

        .main-content {
            margin-left: 0;
            padding: 90px 0px 0px;

            /* main content doesn't move on mobile */
            transition: none;
        }
    }
</style>
