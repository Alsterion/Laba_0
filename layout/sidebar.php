        
        <nav class="Sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img
                            class="avatar"
                            src="<?php echo $user['avatar'] ?>"
                            alt="<?php echo $user['nickname'] ?>"
                        >
                    </span>
                        <div class="text header-text">
                            <span class="name"><?php echo $user['nickname'] ?></span>
                            <span class="profession">Web developer</span>
                        </div>
                </div>

                
                <div class="toggle">
                    <div class="icon"></div>
                </biv>
            </header>

                <div class="menu-bar">
                    <div class="menu">
                        <ul class="menu-links">



                            <li class="nav-link">
                                <a href="home.php">
                                    <i class='bx bxs-id-card icon'></i>
                                    <span class="text nav-text">
                                        Profile
                                    </span>
                                </a>
                            </li>

                            <li class="nav-link">
                                <a href="test.php">
                                    <i class='bx bxs-id-card icon'></i>
                                    <span class="text nav-text">
                                        Test
                                    </span>
                                </a>
                            </li>

                            <li class="nav-link">
                                <a href="news.php">
                                    <i class='bx bx-news icon'></i>
                                    <span class="text nav-text">
                                        News
                                    </span>
                                </a>
                            </li>

                            <li class="nav-link">
                                <a href="gallery.php">
                                    <i class='bx bx-images icon'></i>
                                    <span class="text nav-text">
                                        Gallery
                                    </span>
                                </a>
                            </li>

                            <li class="nav-link">
                                <a href="setting.php">
                                    <i class='bx bxs-cog icon'></i>
                                    <span class="text nav-text">
                                        Setting
                                    </span>
                                </a>
                            </li>
                            

                        </ul>
                    </div>

                <div class="bottom-content">
                    <li class="">
                        <form action="src/actions/logout.php" method="post">
                            <button>
                                <a href="#">
                                    <i class='bx bxs-log-out icon'></i>
                                    <span class="text nav-text"  role="button">
                                        Logout
                                    </span>
                                </a>
                            </button>
                        </form>
                            <li class="mode">
                                <div class="moon-sun">
                                    <i class='bx bxs-notification-off icon moon'></i>
                                    <i class='bx bx-notification-off icon sun'></i>
                                </div>
                                    <span class="mode-text text">Dark Mode</span>
                                <div class="toggle-switch">
                                    <span class="switch"></span>
                                </div>
                            </li>
                    </li>
                </div>


            </div>
        </nav>