
<?php include('partials-front/menu.php'); ?>



    <!-- категории -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //показать все активные категории
                //Sql запрос
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //выполнить запрос
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                //есть категория?
                if($count>0)
                {
                    //есть
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //получить значение
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //изображ не доступно
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else
                                    {
                                        //достпно
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
                    //категор не достпна
                    echo "<div class='error'>Category not found.</div>";
                }
            
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- категории кон -->


    <?php include('partials-front/footer.php'); ?>