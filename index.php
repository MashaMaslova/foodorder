    <?php include('partials-front/menu.php'); ?>

    <!-- Поиск еды начало -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Поиск еды конец -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- Категории начало -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //Создаем SQL-запрос для отображения категорий из базы данных
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Выполнить запрос
                $res = mysqli_query($conn, $sql);
                //Подсчитываем строки, чтобы проверить, доступна ли категория 
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Доступные категории
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Получить такие значения, как id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Проверяем, доступно ли изображение
                                    if($image_name=="")
                                    {
                                        //отобразить сообщение
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Изображение доступно
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Категории недоступны
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Раздел категорий заканчивается здесь -->



    <!-- Раздел FOOD MENU начинается здесь -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            //Получение продуктов из базы данных, которые активны и представлены
            //SQL запрос
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Выполнить запрос
            $res2 = mysqli_query($conn, $sql2);

            //Подсчет строк
            $count2 = mysqli_num_rows($res2);

            //Проверяем есть еда
            if($count2>0)
            {
                //Еда доступна
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Получить все значения
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Проверяем, доступно ли изображение
                                if($image_name=="")
                                {
                                    //не доступно
                                    echo "<div class='error'>Image not available.</div>";
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

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Еда недоступна
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- Здесь заканчивается раздел меню ЕДА -->

    
    <?php include('partials-front/footer.php'); ?>