<?php
    require_once __DIR__ . '/src/core.php';
    checkAuth();
    $user = currentUser();
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Profile | Моя страница</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="assets/css/profile.css">
        <script src="/assets/script/profile.js"></script>
        <script src="/assets/script/menu-nav.js"></script>
    </head>
<body>


    <div class="Flex-container">
        <!-- <div class="SearchBar"></div> -->
        <?php include_once __DIR__ . '/layout/sidebar.php'?>
        


        <div class="home">
                <div class="Profile-Card">

                    <div class="Profile-background">
                        <div class="img-BX">
                            <img
                                src="<?php echo $user['fon'] ?>"
                                alt="fon"
                                style="
                                    position: absolute;
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                "
                            >
                        </div>
                    </div>



                    <div class="Profile-info-left close">
                        <div class="Profile-left-content">
                            <!-- <ul>
                                <li>Posts<span><?php echo countUserPosts();?></span></li>
                                <li>Followers<span><?php echo countFollowers();?></span></li>
                                <li>Following<span><?php echo countFollowing();?></span></li>
                            </ul> -->
                            <label class="switch-pulse">
                                <input type="checkbox" id="no-pulsate-switch">
                            </label>



                            <div class="PLB">
                                <div class="line"></div>
                                <i class='bx bx-chevrons-down icon'></i>
                            </div>
                        </div>
                    </div>



                        <div class="Profile-info-right close">
                                <div class="PRB">
                                    <div class="line-1"></div>
                                    <i class='bx bx-chevrons-down icon'></i>
                                </div>
                        </div>




                    <div class="Profile-Info-Bar"><!-- Profile-Info-Bar -->
                        <div class="left-decor-bar"><!-- Кнопка для раскрытия бокового меню справа от фотографии пользователя -->
                            <div class="left-decor-one"> </div><!-- Декоративный див -->
                            <div class="left-decor-two"> </div><!-- Декоративный див -->
                            <div class="left-decor-one-glow"></div> <!-- Копия для свечения -->
                            <div class="left-decor-two-glow"></div> <!-- Копия для свечения -->

                            <box-icon name='objects-horizontal-right'></box-icon>
                        </div> 
                        <div class="right-decor-bar"><!-- То самое меню -->
                            <div class="right-decor-one"> </div><!-- Декоративный див -->
                            <div class="right-decor-two"> </div><!-- Декоративный див -->
                            <div class="right-decor-one-glow"></div> <!-- Копия для свечения -->
                            <div class="right-decor-two-glow"></div> <!-- Копия для свечения -->
                        </div>


                        <div class="hexagon1"></div>
                        <div class="Profile-circle"><!-- Profile-img -->
                            <div class="shape-outer hexagon">
                                <div class="shape-inner hexagon">
                                    <img
                                        src="<?php echo $user['avatar'] ?>"
                                        alt="<?php echo $user['nickname'] ?>"
                                        style="
                                            width: 100%;
                                            height: 150%;
                                            object-fit: cover;
                                        "
                                    >
                                </div>
                            </div>
                            <div class="Block-Ind-Line">
                                <div class="Ind-Line" id="Ind-Line"></div>
                            </div>
                        </div>


                    </div>

                </div> <!-- Profile-block/End -->


                <div class="scroll-indicator"></div>

        </div>
    </div>
    </body>
</html>