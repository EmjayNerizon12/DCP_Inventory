<style>
    /* --- SIDEBAR BASE --- */
    .sidebar {
        position: fixed;
        top: 50;
        left: 0;
        width: 280px;
        height: 100vh;

        background-color: white;
        box-shadow: 0px 0 5px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        transition: left 0.5s ease;
        /* ONLY LEFT! */
        z-index: 50;
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
        padding: 80px 25px 25px;
        width: 100% !important;
        margin-left: 280px;
        transition: margin-left 0.55s ease;
        /* match sidebar */
    }

    .sidebar.hidden~.main-content {
        margin-left: 0;
        /* shift main content when hidden */
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
            /* main content doesn't move on mobile */
            transition: none;
        }
    }

    .nav-link {
        padding: 1rem 1.5rem;
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
        letter-spacing: 0.05rem !important;
        backdrop-filter: blur(10px);
        text-decoration: none;

    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(4px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        <?php
        if (session('mode') == 'dark') {
            echo 'color: white;';
        } else {
            echo 'color: #333;';
        }
        ?>
    }

    .nav-link:hover::before {
        height: 20px;
    }

    .nav-link.active {
        background: rgb(20, 135, 217);
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: bold;
        font-size: 1.1rem;
        letter-spacing: 0.05rem;
        box-shadow: 0 2px 2px rgba(37, 99, 235, 0.4);
        transform: translateX(4px);
    }
</style>
