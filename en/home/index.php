<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/glass.css">
    <link rel="stylesheet" href="../../css/nav.css">

</head>

<body>
    <div class="container">

    <?php require_once "../../components/nav.php"; ?>

        <!-- <div class="bg1">
            <div class="bg1_c">
                <img class="bottom" src="../../assets/bottom.png" alt="">

            </div>

            <div class="text_section">
                <h4>Launch Your Business On The Web</h4>
                <h6>Professional, Ready-Made Websites Built for Success.</h6>
                <div class="cards">
                    <div class="card" onclick="location.href='../templates/'">
                        <h1 class="title" >Business Website</h1>
                        <button class="btn">Get Started</button>
                    </div>
                       <div class="card ml3">
                        <h1 class="title">Mobile Application</h1>
                         
                        <button class="btn">Get Started</button>
                      </div>
                      <div  class="blob"></div>
                </div>
                
            </div>
            
        </div>
        <div class="bg2">
            <div class="bg1_c">
                <img class="bottom" src="../../assets/bottom.png" alt="">

            </div>

            <div class="text_section">
                <h4>Launch Your Business On The Web</h4>
                <h6>Professional, Ready-Made Websites Built for Success.</h6>
                <div class="cards">
                    <div class="card" onclick="location.href='../templates/'">
                        <h1 class="title" >Business Website</h1>
                        <button class="btn">Get Started</button>
                    </div>
                       <div class="card ml3">
                        <h1 class="title">Mobile Application</h1>
                         
                        <button class="btn">Get Started</button>
                      </div>
                      <div  class="blob"></div>
                </div>
                
            </div>
            
        </div> -->


        <div class="new_hero">
            <div class="f_image">
            <img src="../../assets/divinethedeveloper_hero_2.png" alt="" srcset="">


            </div>
            <div class="t_left">

            </div>
            <div class="b_left">

            </div>
            <div class="hero_text">
                <div class="ft">
                    <span>WEB</span> DEVELOPMENT
                </div>
                <h1>
                We're equally excited about corporate
                </h1>
                <div class="line"></div>
                <div class="p">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur doloribus reiciendis alias debitis.
                </div>
                <button class="btn" onclick="location.href='../templates/'">Browse Templates</button>

            </div>


        </div>
        <div class="mockup">
            <img src="../../assets/iPhone-App-Screen-Mockups.png" alt="">
            <div class="sec">
                <h1>Your Online Presence, Ready <span>Within 3 Days.</span> </h1>
                <button class="btn" onclick="location.href='../templates/'">Browse Templates</button>
            </div>
        </div>

        <?php

           require_once "../../backend/conn.php";
            

            // Fetch latest 10 templates
            $sql = "SELECT id, name, main_image FROM templates ORDER BY id DESC LIMIT 10";
            $result = $conn->query($sql);
            ?>

            <div class="templates">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="template" onclick="location.href='../checkout/?id=<?= $row['id'] ?>'">
                            <div class="gif">
                                <img src="../../assets/gif.gif" alt="">
                            </div>
                            <div class="t_scroll">
                                <img src="../../backend/<?= htmlspecialchars($row['main_image']) ?>" alt="Template Image">
                            </div>
                            <h4><?= htmlspecialchars($row['name']) ?></h4>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No templates available.</p>
                <?php endif; ?>
            </div>

            <?php
            // Close connection
            $conn->close();
            ?>
        <div class="see_more cen">
            <button class="btn" onclick="location.href='../templates/'">See More</button>
        </div>

        <?php require_once "../../components/footer.php";?>

        
         
        

    </div>


    <script src="../../scripts/script.js"></script>
    
</body>
</html>