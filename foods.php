
    <?php include('partials-front/menu.php'); ?>

    <!-- Начало Поиск еды -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Конец -->



    <!-- Начало меню -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //Отображение продуктов, которые активны
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Выполнить запрос
                $res=mysqli_query($conn, $sql);

                //Подсчет строк
                $count = mysqli_num_rows($res);

                //Проверяем, доступны ли продукты
                if($count>0)
                {
                    //Доступные продукты
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //получить значение
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //проверка изображения
                                    if($image_name=="")
                                    {
                                        //не доступно 
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

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //еда не доступна
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>

            

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- меню заканчивается -->

    <?php include('partials-front/footer.php'); ?>