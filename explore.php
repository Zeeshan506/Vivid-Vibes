<?php

include("connection.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
} else {
    //echo "1";
}
$user_email = $_SESSION['email'];
$user_id = $_SESSION['Userid']; // Corrected variable name to match the session key

$sql1 = "SELECT fullname, username FROM users WHERE email='$user_email'";
$sql2 = "SELECT u.fullname, n.date, n.action
FROM users u
JOIN Notifications n ON u.Userid = n.user_id
 ";

$sql3 = "SELECT fullname FROM users";

$sql4 = "SELECT u.fullname, p.date, p.caption, ps.likes
FROM Users u
JOIN Posts p ON u.Userid = p.user_id
JOIN Post_stats ps ON p.post_id = ps.post_id;";

$sql5 = "SELECT u.fullname, m.content
FROM users u
JOIN messages m ON u.Userid = m.user_id;
";

$sql6 = "SELECT u.fullname, r.date
FROM users u
JOIN Requests r ON u.Userid = r.user_id
WHERE r.status = 'pending';
";

$num_images = 10;
$start_image_number = 2;
if ($user_id == 1) {
    // User 1 sees images with odd numbers
    $start_image_number = 2;
} else if ($user_id == 2) {
    // User 2 sees images with even numbers
    $start_image_number = 1;
}
// else{
//     $start_image_number = 2;
// }


// Loop to display half of the available images



$task1 = mysqli_query($conn, $sql1);
$task2 = mysqli_query($conn, $sql2);
$task3 = mysqli_query($conn, $sql3);
$task4 = mysqli_query($conn, $sql4);
$task5 = mysqli_query($conn, $sql5);
$task6 = mysqli_query($conn, $sql6);
// $task7 = mysqli_query($conn,$sql7);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Vivid Vibes</title>
    <!-- Style Sheet -->
    <link rel="stylesheet" href="style.css" />
    <!-- Icons Form inconScount using iconscout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
</head>

<body>
    <nav>
        <div class="container">
            <h2 class="logo">Vivid Vibes</h2>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Search For Influencesors and Creators" />
            </div>
            <div class="create">
                <label class="btn btn-primary" for="create-post">Create</label>
                <div class="profile-photo">
                    <img src="profile-1.jpg" alt="" />
                </div>
            </div>
        </div>
    </nav>
    <!--------------------  MAIN  -------------------->
    <main>
        <div class="container">
            <!--------------------  Left  ------------------->
            <div class="left">
                <a class="profile-1" href="profile.php">
                    <div class="profile-photo">
                        <img src="profile-1.jpg" />
                    </div>
                    <?php
                    $row = mysqli_fetch_assoc($task1);
                    ?>
                    <div class="handle">
                        <h4><?php echo $row['fullname'] ?></h4>
                        <p class="text-muted">@<?php echo $row['username'] ?></p>
                    </div>
                </a>
                <!--============================================== SIDEBAR ===========-->
                <div class="sidebar">
                    <a class="menu-item " href="home.php">
                        <span><i class="uil uil-home"></i></span>
                        <h3>Home</h3>
                    </a>
                    <a class="menu-item active" href="explore.php"><span><i class="uil uil-compass"></i></span>
                        <h3>Explore</h3>
                    </a>
                    <a class="menu-item" id="notifications"><span><i class="uil uil-bell"><small class="notifications-count">6</small></i></span>
                        <h3>Notifications</h3>
                    </a>
                    <!-----------------------------------------------  POP-UP ------------------->
                    <?php
                    $row = mysqli_fetch_assoc($task2);
                    ?>
                    <div class="notifications-popup">
                        <div>
                            <div class="profile-photo">
                                <img src="profile-3.jpg" />
                            </div>
                            <div class="notification-body">
                                <b><?php echo $row['fullname'] ?></b> <?php echo $row['action'] ?>
                                <small class="text-muted"><?php echo $row['date'] ?></small>
                            </div>
                        </div>
                        <div>
                            <?php
                            $row = mysqli_fetch_assoc($task2);
                            ?>
                            <div class="profile-photo">
                                <img src="profile-4.jpg" />
                            </div>
                            <div class="notification-body">
                                <b><?php echo $row['fullname'] ?></b> <?php echo $row['action'] ?>
                                <small class="text-muted"><?php echo $row['date'] ?></small>
                            </div>
                        </div>
                        <?php
                        $row = mysqli_fetch_assoc($task2);
                        ?>
                        <div>
                            <div class="profile-photo">
                                <img src="profile-5.jpg" />
                            </div>
                            <div class="notification-body">
                                <b><?php echo $row['fullname'] ?></b> <?php echo $row['action'] ?>
                                <small class="text-muted"><?php echo $row['date'] ?></small>
                            </div>
                        </div>
                        <div>
                            <div class="profile-photo">
                                <img src="profile-6.jpg" />
                            </div>
                            <?php
                            $row = mysqli_fetch_assoc($task2);
                            ?>
                            <div class="notification-body">
                                <b><?php echo $row['fullname'] ?></b> <?php echo $row['action'] ?>
                                <small class="text-muted"><?php echo $row['date'] ?></small>
                            </div>
                        </div>
                        <div>
                            <?php
                            $row = mysqli_fetch_assoc($task2);
                            ?>
                            <div class="profile-photo">
                                <img src="profile-7.jpg" />
                            </div>
                            <div class="notification-body">
                                <b><?php echo $row['fullname'] ?></b> <?php echo $row['action'] ?>
                                <small class="text-muted"><?php echo $row['date'] ?></small>
                            </div>
                        </div>
                    </div>
                    <!-- --------------------------------  End Notification Popup-------------------- -->
                    <a class="menu-item" id="message-notification"><span><i class="uil uil-envelope"><small class="notifications-count">9</small></i></span>
                        <h3>Message</h3>
                    </a>

                    <a class="menu-item" id="theme"><span><i class="uil uil-palette"></i></span>
                        <h3>Theme</h3>
                    </a>
                    <a class="menu-item " href="logout.php"><span><i class="uil uil-signout"></i></span>
                        <h3>Sign Out</h3>
                    </a>
                </div>
                <!--------------------=------------------------------   Create Button   ----------------->
                <label for="Create-post" class="btn btn-primary">Create Post</label>
            </div>
            <!-------------------- ------------------------------     End Of Left -------------------->



            <div class="middle">
                <!-- <div class="profile-card">
                <div class="profile-photo-profile">
                    <img src="profile-1.jpg" alt=""><br>
                </div>
                <div class="info">
                    <h3>Name</h3>
                    <small>@username</small>
                  </div><br>
                  <div class="bio">
                    Bio
                  </div>
            </div> -->


                <!-- ------------------------- FEEDS------------------------- -->
                <div class="feeds">
                    <!-- ------------------------- Feed 1----------------- -->
                    <?php
                    for ($i = $start_image_number; $i <= $num_images; $i += 2) {
                        $image_filename = "feed " . $i . ".jpg";
                    ?>
                        <?php
                        $row = mysqli_fetch_assoc($task4);
                        ?>
                        <div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                        <img src="profile-1.jpg" />
                                    </div>
                                    <div class="info">
                                        <h3><?php echo $row['fullname'] ?></h3>
                                        <small><?php echo $row['date'] ?></small>
                                    </div>
                                </div>
                                <span class="edit">
                                    <i class="uil uil-ellipsis-h"></i>
                                </span>
                            </div>
                            <div class="photo">
                                <img src="feeds/<?php echo $image_filename; ?>" />
                            </div>

                            <div class="action-buttons">
                                <div class="interaction-button">
                                    <span><i class="uil uil-heart"></i></span>
                                    <span><i class="uil uil-comment-alt-dots"></i></span>
                                    <span><i class="uil uil-share-alt"></i></span>
                                </div>
                            </div>
                            <div class="liked-by">
                                <span>
                                    <img src="profile-11.jpg" alt="" />
                                </span>
                                <span><img src="profile-12.jpg" alt="" />
                                </span>
                                <span><img src="profile-15.jpg" alt="" /></span>
                                <p>Liked by <b>Ahmed</b> and <b><?php echo $row['likes'] ?></b> others</p>
                            </div>
                            <div class="caption">
                                <p><b> <?php echo $row['fullname'] ?></b> <?php echo $row['caption'] ?></p>
                            </div>
                            <div class="text-muted">
                                <a href="">View All Comments</a>
                            </div>
                        </div>
                        <!-- Feed End -->

                        <!-- ------------------------- Feed 1 End----------------- -->
                    <?php
                    }
                    ?>




                </div>
                <!-- Feeds End  -->
                <!-- -------------------------------- End of Feeds -------------------------- -->
            </div>
            <!-- Middle  ENd -->
            <!-- ========================== End of Middle ========================== -->
            <?php
            $row = mysqli_fetch_assoc($task5);
            ?>
            <!-------------------- --------------------------------     Right  -------------------->
            <div class="right" style="position: sticky;">
                <div class="messages">
                    <div class="heading">
                        <h4>Messages</h4>
                        <i class="uil uil-edit"></i>
                    </div>
                    <!-- --- Messages catagory  --- -->
                    <div class="category">
                        <h6 class="active">Primary</h6>
                        <h6>General</h6>
                    </div>

                    <!-- ==== Message ====  -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="profile-14.jpg" />
                        </div>
                        <div class="message-body"></div>
                        <h5><?php echo $row['fullname'] ?></h5>
                        <p class="text-muted"><?php echo $row['content'] ?></p>
                    </div>
                    <!-- ==== Message End ====  -->
                    <?php
                    $row = mysqli_fetch_assoc($task5);
                    ?>
                    <!-- ==== Message ====  -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="profile-16.jpg" />
                        </div>
                        <div class="message-body"></div>
                        <h5><?php echo $row['fullname'] ?></h5>
                        <p class="text-muted"><?php echo $row['content'] ?></p>
                    </div>
                    <!-- ==== Message End ====  -->
                    <?php
                    $row = mysqli_fetch_assoc($task5);
                    ?>
                    <!-- ==== Message ====  -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="profile-3.jpg" />
                        </div>
                        <div class="message-body"></div>
                        <h5><?php echo $row['fullname'] ?></h5>
                        <p class="text-muted"><?php echo $row['content'] ?></p>
                    </div>
                    <!-- ==== Message End ====  -->
                    <?php
                    $row = mysqli_fetch_assoc($task5);
                    ?>
                    <!-- ==== Message ====  -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="profile-13.jpg" />
                        </div>
                        <div class="message-body"></div>
                        <h5><?php echo $row['fullname'] ?></h5>
                        <p class="text-muted"><?php echo $row['content'] ?></p>
                    </div>
                    <!-- ==== Message End ====  -->
                    <?php
                    $row = mysqli_fetch_assoc($task5);
                    ?>
                    <!-- ==== Message ====  -->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="profile-17.jpg" />
                        </div>
                        <div class="message-body"></div>
                        <h5><?php echo $row['fullname'] ?></h5>
                        <p class="text-muted"><?php echo $row['content'] ?></p>
                    </div>
                    <!-- ==== Message End ====  -->
                </div>
                <!-- Messages End -->
                <?php
                $row = mysqli_fetch_assoc($task6);
                ?>
                <!-- ==== Friend Requests ====  -->
                <div class="friend-request">
                    <h4>Request</h4>
                    <!-- ==== Request Start ==== -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="profile-14.jpg">
                            </div>
                            <div>
                                <h5><?php echo $row['fullname'] ?></h5>
                                <p class="text-muted"><?php echo $row['date'] ?></p>
                            </div>


                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!-- ==== Request End ==== -->
                    <?php
                    $row = mysqli_fetch_assoc($task6);
                    ?>

                    <!-- ==== Request Start ==== -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="profile-13.jpg">
                            </div>
                            <div>
                                <h5><?php echo $row['fullname'] ?></h5>
                                <p class="text-muted"><?php echo $row['date'] ?></p>
                            </div>


                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!-- ==== Request End ==== -->
                    <?php
                    $row = mysqli_fetch_assoc($task6);
                    ?>
                    <!-- ==== Request Start ==== -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="profile-20.jpg">
                            </div>
                            <div>
                                <h5><?php echo $row['fullname'] ?></h5>
                                <p class="text-muted"><?php echo $row['date'] ?></p>
                            </div>


                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!-- ==== Request End ==== -->

                    <?php
                    $row = mysqli_fetch_assoc($task6);
                    ?>
                    <!-- ==== Request Start ==== -->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="profile-19.jpg">
                            </div>
                            <div>
                                <h5><?php echo $row['fullname'] ?></h5>
                                <p class="text-muted"><?php echo $row['date'] ?></p>
                            </div>


                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn ">Decline</button>
                        </div>
                    </div>
                    <!-- ==== Request End ==== -->
                </div>
                <!-- ==== Friend Requests End ====  -->
            </div>
            <!-- === End OF Right === -->
        </div>
        <!-- === End of Container === -->
    </main>

    <!-- ============= Theme ============= -->
    <div class="customize-theme">
        <div class="card">
            <h2>Customize Your View</h2>
            <p class="text-mutedb">Manage Your Font Size, And Theme</p>
            <!-- Font Sizes -->
            <div class="font-size">
                <h4>Font Size</h4>
                <div>
                    <h6>Aa</h6>
                    <div class="choose-size">
                        <span class="font-size-1 active"></span>
                        <span class="font-size-2"></span>
                        <span class="font-size-3"></span>
                        <span class="font-size-4"></span>
                        <span class="font-size-5"></span>
                    </div>
                    <h3>Aa</h3>
                </div>

            </div>

            <!-- Primary Colors -->
            <div class="color">
                <h4>Color</h4>
                <div class="choose-color">
                    <span class="color-1 active"></span>
                    <span class="color-2"></span>
                    <span class="color-3"></span>
                    <span class="color-4"></span>
                    <span class="color-5"></span>
                </div>
            </div>

            <!-- Background Color -->
            <div class="background">
                <h4>Background</h4>
                <div class="choose-bg">
                    <div class="bg-1 active">
                        <span></span>
                        <h5 for="bg-1">Light</h5>
                    </div>
                    <div class="bg-2">
                        <span></span>
                        <h5 for="bg-2">Dim</h5>
                    </div>
                    <div class="bg-3">
                        <span></span>
                        <h5 for="bg-3">Lights Out</h5>
                    </div>

                </div>
            </div>


        </div> <!-- Card End -->


    </div>
    <!-- Customize Theme End -->





    <script src="./index.js"></script>
</body>

</html>