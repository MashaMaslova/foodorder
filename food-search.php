
    <?php include('partials-front/menu.php'); ?>

    <!-- Здесь начинается раздел ПОИСК ЕДЫ -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //Получить ключевое слово
                // 
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>


            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Раздел ПОИСК ЕДЫ заканчивается здесь -->



    <!-- Раздел FOOD MENU начинается здесь -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //SQL-запрос для получения продуктов на основе ключевого слова поиска
                //$search = burger '; DROP имя бд;
                // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Выполнить запрос
                $res = mysqli_query($conn, $sql);

                //Подсчет строк
                $count = mysqli_num_rows($res);

                //Проверяем, доступна ли еда
                if($count>0)
                {
                    //доступна
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //подробности
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    // Проверяем, доступно ли имя изображения
                                    if($image_name=="")
                                    {
                                        //Не доступно
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //доступно
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php 

                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Еда не доступна
                    echo "<div class='error'>Food not found.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Здесь заканчивается раздел меню ЕДА -->

    <?php include('partials-front/footer.php'); ?>