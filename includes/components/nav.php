<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm p-3 mb-5 bg-white rounded">
    <div class="container-fluid">
        <a href="home" class="navbar-brand d-flex align-items-center" style="font-weight:bold;">
            <img src="assets/icons/favicon.svg" alt="logo" style="padding:5px; border-right:2px solid #ddd; margin-right: 10px;">
            বই
        </a>
        <span class="navbar-text d-none d-md-block" style="font-size: 12px;">বিকশিত হোক মনের দুয়ার</span>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="font-weight:bold">
                <li class="nav-item"><a class="nav-link" href="home">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="sell">SELL</a></li>
                <li class="nav-item"><a class="nav-link" href="contact">CONTACT US</a></li>
                <li class="nav-item"><a class="nav-link" href="instructions">INSTRUCTIONS</a></li>

                <?php if (!isset($_SESSION["username"])): ?>
                    <li class="nav-item"><a class="nav-link" href="login">LOGIN</a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PROFILE
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile">Profile</a></li>
                            <li><a class="dropdown-item" href="messages">Inbox</a></li>
                            <li><a class="dropdown-item" href="wishlist">Wishlist</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout">Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
