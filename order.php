
<?php include('partials-front/menu.php'); ?>

    <?php 
        //Проверяем, установлен ли идентификатор еды
        if(isset($_GET['food_id']))
        {
            //Получить идентификатор еды и информацию о выбранной еде
            $food_id = $_GET['food_id'];

            //получить информацию о выбранной еде
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //выполнить запрос
            $res = mysqli_query($conn, $sql);
            //подсчет строк
            $count = mysqli_num_rows($res);
            //проверяем доступность жанных
            if($count==1)
            {
                //есть данные
                //получить данные из бд
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //еда недоступна
                //перенаправление на домашнюю страницу
                header('location:'.SITEURL);
            }
        }
        else
        {
            //перенаправление на домашнюю страницу
            header('location:'.SITEURL);
        }
    ?>

    <!-- здесь начинается раздел Поиск Еды -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //проверка на доступность изображения
                            if($image_name=="")
                            {
                                //изображение недоступно
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //изображение доступно
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                //проверяем нажата ли кнопка отправки
                if(isset($_POST['submit']))
                {
                    // получить все данные из формы

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // итог = цена x кол-во 

                    $order_date = date("Y-m-d h:i:sa"); //дата заказа

                    $status = "Ordered";  // заказано, доставляется, доставленно, отменено

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //сохраняем заказ в бд
                    //создаем SQL для сохранения данных
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //выполнить запрос
                    $res2 = mysqli_query($conn, $sql2);

                    //проверка успешности запроса
                    if($res2==true)
                    {
                        //запрос выполнен и заказ сохранен
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //не удалось сохранить заказ
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- раздел поиска еды закончился -->

    <?php include('partials-front/footer.php'); ?>