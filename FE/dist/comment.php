<?php 
    ob_start();    
    include 'connect.php';

    $product_id = $_GET['id'];
    if(isset($_SESSION["user_email"])){    
        $user_id = $_SESSION['user_id'];
        
        // echo $user_id . '  ' . $product_id;
        if(isset($_POST["btn-send"])){
            if(!empty('rating')){
                $stars = $_POST['rating'];
                $review_content = $_POST['review-content'];
                $sql = "INSERT INTO product_reviews(product_id, content, user_id, review_star) 
                    VALUES('$product_id', '$review_content', '$user_id', '$stars')";
            }
        
            
            $result = mysqli_query($connection, $sql);
        }
    }
    // $cmt_creater = "SELECT * FROM users where id = '$user_id' ";
   
?>
<style>
    .rating{
        visibility: hidden;
    }

    .review-rating-number{
        margin-left: 20px;
    }
</style>
<div class="containner-fluid">
    <div class="customer-review">
        <div class="customer-review-heading">
            <h3 class="tm-text-gray-dark mb-3 review-title">Customer's Comment</h3>
        </div>
        <div class="customer-review-inner">
            <div class="review-rating">
                <div class="review-rating-heading">
                    <h3 class="tm-text-gray-dark mb-3">Evaluations</h3>
                </div>
                <div class="review-rating-inner">
                    <div class="review-rating-summary">
                        <div class="review-rating-point">
                            <?php 
                                $avg_sql = "SELECT AVG(review_star) FROM product_reviews 
                                WHERE product_id='$product_id' ";
                                $avg = mysqli_query($connection, $avg_sql);
                                $avg_row = mysqli_fetch_array($avg);
                                echo $avg_stars = round($avg_row[0], 1);
                            ?>
                        </div>
                        <div class="review-rating-star"> 
                            <?php
                                for($i = 0; $i <$avg_stars; $i++){
                                    ?>
                                    <i class="fa fa-star checked"></i>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="review-rating-total">
                            <?php 
                                $avg_stars_sql = "SELECT COUNT(id) FROM product_reviews 
                                            WHERE product_id='$product_id' ";
                                $avg_stars = mysqli_query($connection, $avg_stars_sql);
                                $avg_stars_row = mysqli_fetch_array($avg_stars);
                                echo $avg_stars_row[0];
                            ?>
                            evaluations
                        </div>
                    </div>
                    <div class="review-rating-detail">
                        <div class="review-rating-level">
                            <div class="review-rating-star">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            </div>
                            <div class="review-rating-number">
                            <?php 
                                for($i = 1; $i <= 5; $i++){
                                    $count_sql = "SELECT COUNT(id) FROM product_reviews 
                                                 WHERE product_id='$product_id' AND review_star = '$i' ";
                                    $count = mysqli_query($connection, $count_sql);
                                    $count_row = mysqli_fetch_array($count);
                                    $count_arr[$i] = $count_row[0];
                                }
                               
                                echo $count_arr[5];
                            ?></div>
                        </div>

                        <div class="review-rating-level">
                        <div class="review-rating-star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="review-rating-number">
                            <?php 
                                echo $count_arr[4];
                            ?></div>
                        </div>

                        <div class="review-rating-level">
                        <div class="review-rating-star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="review-rating-number">
                        <?php 
                            echo $count_arr[3];
                        ?></div>
                        </div>

                        <div class="review-rating-level">
                        <div class="review-rating-star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <!-- <div class="review-process-bar"><div class="bar-2" style="background-color: orange; height: 100%;" ></div></div> -->
                        <div class="review-rating-number">
                            <?php echo $count_arr[2];
                            ?></div>
                        </div>

                        <div class="review-rating-level">
                        <div class="review-rating-star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <!-- <div class="review-process-bar"><div class="bar-1" style="background-color: orange; height: 100%;" ></div></div> -->
                        <div class="review-rating-number">
                        <?php echo $count_arr[1];
                            ?></div>
                        </div>


                    </div>
                </div>
            </div>

        <?php
            if(isset($_SESSION["user_email"])){    
        ?>
					
            <div class="customer-review-comment">
                <h3 class="tm-text-gray-dark mb-3 review-title">
                    Send your comment
                </h3>
                <div class="customer-comment-form">
                    <form action="" method="POST">
                    <div class="rating-wrapper">
                        <label>1. Rating for this product:</label>
                        <div class="rating-input" id="rating" style="background-color: transparent">
                            <input type="radio" id="star5" name="rating" value="5" class="rating" required="required"/> 
                            <label class = "fas fa-star" for="star5" title="Awesome - 5 stars"></label>
                            
                            <input type="radio" id="star4" name="rating" value="4"  class="rating" required="required"/>                                                       
                            <label class = "fas fa-star" for="star4" title="Pretty good - 4 stars"></label>

                            <input type="radio" id="star3" name="rating" value="3"  class="rating" required="required"/>
                            <label class = "fas fa-star" for="star3" title="Meh - 3 stars"></label>
                                                        
                            <input type="radio" id="star2" name="rating" value="2"  class="rating" required="required"/>
                            <label class = "fas fa-star" for="star2" title="Kinda bad - 2 stars"></label>
                                                        
                            <input type="radio" id="star1" name="rating" value="1"  class="rating" required="required"/>
                            <label class = "fas fa-star" for="star1" title="Sucks big time - 1 star"></label>
                            
                        
                        </div>
                    </div>

                    <div class="review-content">
                        <label>3. Left your comment below:</label>
                        <textarea name="review-content" id="review-content" cols="30" rows="10"
                        placeholder="Enter your comment" required="required"></textarea>
                    </div>

                    <div class="action">
                        <button class="btn-thao btn-primary buy-now-button right free-button btn-send" 
                        type="submit" name="btn-send" style="float: right; width: 100px"
                        >Send</button>
                    </div>
                    </form>
                </div>
            </div>
        <?php 
            }
        ?>
        </div>
        
       
        <?php 
        $cmt_sql = "SELECT * FROM product_reviews where product_id = '$product_id' 
                    ORDER BY created_date DESC";
        $cmt = mysqli_query($connection, $cmt_sql);
        if ($cmt->num_rows > 0){
        ?>
            <div>
            <?php
                $curr_cmt = 0;
                // $cmt_row = mysqli_fetch_array($cmt);
                // echo $cmt_row[1];
            while($cmt_row = $cmt->fetch_assoc() and $curr_cmt < 2) {
                // for($curr_cmt = 0; $curr_cmt < 2; $curr_cmt++){
                    $id = $cmt_row['id'];
                    $content = $cmt_row['content'];
                    $cmt_createdDate = $cmt_row['created_date'];
                    $rating_stars = $cmt_row['review_star'];
                    $user_id = $cmt_row['user_id'];
                    $likes = $cmt_row['likes'];
                ?>
                <div class="review-comment"> 
                    <div class="review-comment-avatar">
                
                        <i class="fas fa-user-circle"></i>
                        <div class="review-comment-avatar-info">
                            <div class="review-comment-avatar-name">
                                <span>
                                    <?php 
                                    $user_sql ="SELECT firstname, lastname 
                                                FROM users WHERE id= '$user_id'";
                                    $user = mysqli_query($connection, $user_sql);
                                    $user_row = mysqli_fetch_array($user);
                                    echo $user_row['firstname'] . ' ' . $user_row['lastname'];
                                    ?>
                                </span>
                            </div>
                            <div class="review-comment-avatar-date">
                                <?php echo 'Commented at ' . $cmt_createdDate; ?>
                            </div>
                        </div>
                        </div>
                            <div class="review-rating-star">
                                <?php 
                                    for($i = 0; $i < $rating_stars; $i++){
                                        ?>
                                        <i class="fa fa-star checked"></i>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="review-comment-content">
                                <?php echo $content;  ?>
                            </div>
                            <!-- <form method="post"> -->
                                <button class="fa fa-thumbs-o-up btn-thao btn-primary buy-now-button right free-button"
                                        name="btn-like" onclick="like()">                                    
                                    <?php echo '(' . $likes . ' ' . $id  . ')'; ?>                                
                                </button>  
                                <?php
                                // if(isset($_POST['btn-like'])){
                                //     $new_likes = $likes + 1;
                                //     $update_like_sql = "UPDATE product_reviews SET likes='$new_likes'
                                //                         WHERE id='$id'";
                                //     $update_like = mysqli_query($connection, $update_like_sql);
                                //     // header("location:account.php")
                                // }
                                ?>
                            <!-- </form> -->
                            
                        </div>
                    </div>
                </div>
                <?php
                    $curr_cmt++;
                }
            
        // }   
                ?>   
            </div>   
        <?php
        }
        ?>    
    
    </div>
</div>
<script>
    function like(){
        
    }
</script>
