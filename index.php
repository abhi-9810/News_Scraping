<?php
   $dbhost = 'localhost';
   $dbuser = '';
   $dbpass = '';
   $db='';
   $error="";
   $con = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
   $sql="SELECT * FROM news_data ORDER BY id DESC LIMIT 1";
   $result=mysqli_query($con,$sql);
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $total_news=$row['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>IRSC</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../gallery/fevicon1.ico">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <div class="box_wrapper">
    <header id="header">
      <div class="header_top">
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav custom_nav">
                <li><a href="index.html">Home</a></li>  
                <li><a href="#footer">Contact Us</a></li>   
              </ul>
            </div>
          </div>
        </nav>
        <div class="header_search">
          <button id="searchIcon"><i class="fa fa-search"></i></button>
          <div id="shide">
            <div id="search-hide">
              <form action="#">
                <input type="text" size="40" placeholder="Search here ...">
              </form>
              <button class="remove"><span><i class="fa fa-times"></i></span></button>
            </div>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="logo_area"><a class="logo" href="https://road-safety.co.in"><b>IRSC</b>News <span>News Related to Road-Safety</span></a></div>
        <div class="top_addarea"><a href="#"><img src="images/banner.jpg" alt=""></a></div>
      </div>
    </header>
    <?php 
      $sql="SELECT heading,news_link FROM news_data";
      $result=mysqli_query($con,$sql);
    ?>  
    <div class="latest_newsarea"> <span>Latest News</span>
      <ul id="ticker01" class="news_sticker">
        <?php
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $link=$row['news_link'];
                $heading=$row['heading'];
                $heading=mb_convert_encoding($heading, "UTF-8");
                $heading=str_replace("?"," ",$heading);
          ?>  
        <li><a href="<?php echo $link;?>"><?php echo $heading?></a></li>
        <?php
            }
        ?>
      </ul>
    </div>
    <div class="thumbnail_slider_area">
      <div class="owl-carousel">
      <?php
            $final=$total_news/10;
            $i=1;
            while($i<=$final){
                $i++;
                $id=($i-2)*10;
                $id1=$id+1;
                $id2=$id+2;
                $sql="SELECT * FROM news_data WHERE id='$id1' OR id='$id2'";
                $result=mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $img_src=$row['img_src'];
                    $link=$row['news_link'];
                    $heading=$row['heading'];
                    $heading=mb_convert_encoding($heading, "UTF-8");
                    $heading=str_replace("?"," ",$heading);
                    $date=date("Y/m/d")."(".$row['news_channel'].")";
                ?>
                <div class="signle_iteam">
                  <img src="<?php echo $img_src;?>" alt="" style="width:395px;height:396px;">
                  <div class="sing_commentbox slider_comntbox">
                    <p><i class="fa fa-calendar"></i><?php echo $date?></p>
                  </div>
                  <a class="slider_tittle" href="<?php echo $link?>"><?php echo $heading;?></a>
                </div>
            <?php }
            }
          ?>
      </div>
    </div>
    <section id="contentbody">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
          <div class="row">
            <div class="left_bar">
              <div class="single_leftbar">
                <h2><span>Recent Post</span></h2>
                <div class="singleleft_inner">
                  <ul class="recentpost_nav wow fadeInDown">
                      <?php
                        $final=$total_news/10;
                        $i=1;
                        while($i<=$final){
                            $i++;
                            $id=($i-2)*10;
                            $id1=$id+6;
                            $id2=$id+10;
                            $sql="SELECT * FROM news_data WHERE id>='$id1' AND id<='$id2'";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $img_src=$row['img_src'];
                                $link=$row['news_link'];
                                $heading=$row['heading'];
                                $heading=mb_convert_encoding($heading, "UTF-8");
                                $heading=str_replace("?"," ",$heading);
                                $date=date("Y/m/d")."(".$row['news_channel'].")";
                            ?>
                            <li><a href="#"><img src="<?php echo $img_src;?>" alt="" style="height:80px;width:150px;"></a> <a class="recent_title" href="<?php echo $link;?>"><?php echo $heading;?></a></li>
                      <?php }
                        }?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
          <div class="row">
            <div class="middle_bar">
              <div class="featured_sliderarea">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                  </ol>   
                  <div class="carousel-inner" role="listbox"> 
                    <?php 
                        $final=$total_news/10;
                        $i=$final;
                        while($i>=0){
                            $i--;
                            $id=($i)*10;
                            $id1=$id+3;
                            $id2=$id+4;
                            $sql="SELECT * FROM news_data WHERE id='$id1' OR id='$id2'";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $img_src=$row['img_src'];
                                $link=$row['news_link'];
                                $heading=$row['heading'];
                                $heading=mb_convert_encoding($heading, "UTF-8");
                                $heading=str_replace("?"," ",$heading);
                                $date=date("Y/m/d")."(".$row['news_channel'].")";
                            if($row['id']==13){?>
                                <div class="item active"> 
                            <?php
                            }
                            else{?>
                                <div class="item">  
                            <?php
                            }
                          ?>  
                      <img src="<?php echo $img_src;?>" alt="" style="width:668px;height:328px;">
                      <div class="carousel-caption">
                        <h1><a href="<?php echo $link;?>"><?php echo $heading;?></a></h1>
                      </div>
                    </div>
                    <?php } }?>                
                  </div>
                  <a class="left left_slide" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> </a> <a class="right right_slide" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> </a>
                </div>
              </div>      
              <div class="single_category wow fadeInDown">
                <div class="single_category_inner">
                  
                    <?php
                        $final=$total_news/10;
                        $i=1;
                        $j=1;
                        while($i<=$final){
                            ?><ul class="catg_nav"><?php
                            $i++;
                            $id=($i-2)*10;
                            $id1=$id+5;
                            $id2=$id+6;
                            $sql="SELECT * FROM news_data WHERE id='$id1' OR id='$id2'";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $j++;
                                $img_src=$row['img_src'];
                                $link=$row['news_link'];
                                $heading=$row['heading'];
                                $heading=mb_convert_encoding($heading, "UTF-8");
                                $heading=str_replace("?"," ",$heading);
                                $date=date("Y/m/d")."(".$row['news_channel'].")";
                                $content=$row['content'];
                            ?>
                        <li>
                          <div class="catgimg_container"> <a class="catg1_img" href="#">
                              <img src="<?php echo $img_src?>" alt="" style="width:310px;height:150px;"> </a>
                          </div>
                          <a class="catg_title" href="<?php echo $link;?>"><?php echo $heading;?></a>
                          <div class="sing_commentbox">
                              <p><i class="fa fa-calendar"></i><?php echo $date;?><br /></p>
                              <p><?php echo $content;?></p>
                          </div>
                       </li> 
                      <?php
                         }
                       ?></ul><?php        
                       }?>
                </div>
              </div>       
              <div class="single_category  wow fadeInDown">
                <div class="single_category_inner">
                      <?php
                        $final=$total_news/10;
                        $i=$final;
                        while($i>=0){
                            ?><ul class="catg_nav catg_nav2"><?php
                            $i--;
                            $id=($i)*10;
                            $id1=$id+7;
                            $id2=$id+8;
                            $sql="SELECT * FROM news_data WHERE id='$id1' OR id='$id2'";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $img_src=$row['img_src'];
                                $link=$row['news_link'];
                                $heading=$row['heading'];
                                $heading=mb_convert_encoding($heading, "UTF-8");
                                $heading=str_replace("?"," ",$heading);
                                $date=date("Y/m/d")."(".$row['news_channel'].")";
                                $content=$row['content'];
                            ?>
                        <li>
                          <div class="catgimg_container"> <a class="catg1_img" href="#"> <img src="<?php echo $img_src?>" alt="" style="width:310px;height:300px;"> </a></div>
                          <a class="catg_title" href="<?php echo $link;?>"><?php echo $heading;?></a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i><?php echo $date;?></p>
                          </div>
                          <p class="post-summary"><?php echo $content;?></p>
                        </li>    
                      <?php
                         }
                        ?></ul><?php
                      }?>  
                </div>
              </div>
              <?php 
                      $sql="SELECT * FROM news_data WHERE id='9'";
                      $result=mysqli_query($con,$sql);
                      $sql="SELECT * FROM news_data WHERE id='19'";
                      $result1=mysqli_query($con,$sql);
                    ?>      
              <div class="category_three_fourarea  wow fadeInDown">
                <div class="category_three">
                  <div class="single_category">
                    <div class="single_category_inner">
                      <ul class="catg_nav catg_nav3">
                      <?php
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            $img_src=$row['img_src'];
                            $link=$row['news_link'];
                            $heading=$row['heading'];
                            $heading=mb_convert_encoding($heading, "UTF-8");
                            $heading=str_replace("?"," ",$heading);
                            $date=date("Y/m/d")."(NDTV)";
                            $content=$row['content'];
                        ?>
                        <li>
                          <div class="catgimg_container"> <a class="catg1_img" href="#"> <img src="<?php echo $img_src;?>" alt="" style="width:292px;height:150px;"> </a></div>
                          <a class="catg_title" href="<?php echo $link;?>"><?php echo $heading;?></a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i><?php echo $date;?></p>
                          </div>
                          <p class="post-summary"><?php echo $content;?></p>
                       </li>
                      <?php }?>      
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="category_four wow fadeInDown">
                  <div class="single_category">
                    <div class="single_category_inner">
                      <ul class="catg_nav catg_nav3">
                        <?php
                        while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
                            $img_src=$row['img_src'];
                            $link=$row['news_link'];
                            $heading=$row['heading'];
                            $heading=mb_convert_encoding($heading, "UTF-8");
                            $heading=str_replace("?"," ",$heading);
                            $date=date("Y/m/d")."(THE INDIAN EXPRESS)";
                            $content=$row['content'];
                        ?>
                        <li>
                          <div class="catgimg_container"> <a class="catg1_img" href="#"> <img src="<?php echo $img_src;?>" alt="" style="width:292px;height:150px;"> </a></div>
                          <a class="catg_title" href="<?php echo $link;?>"><?php echo $heading;?></a>
                          <div class="sing_commentbox">
                            <p><i class="fa fa-calendar"></i><?php echo $date;?></p>
                          </div>
                          <p class="post-summary"><?php echo $content;?></p>
                       </li>
                      <?php } ?> 
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            <?php 
                    $sql="SELECT * FROM news_data WHERE id<='5'";
                    $result=mysqli_query($con,$sql);
                    $sql="SELECT * FROM news_data WHERE id<='15' AND id>='11'";
                    $result1=mysqli_query($con,$sql);
            ?>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="row">
            <div class="right_bar">    
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Popular Post</span></h2>
                <div class="singleleft_inner">
                  <ul class="catg3_snav ppost_nav wow fadeInDown">
                      <?php
                        $final=$total_news/10;
                        $i=$final;
                        while($i>=0){
                            $i--;
                            $id=($i)*10;
                            $id1=$id+1;
                            $id2=$id+5;
                            $sql="SELECT * FROM news_data WHERE id>='$id1' AND id<='$id2'";
                            $result=mysqli_query($con,$sql);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                $img_src=$row['img_src'];
                                $link=$row['news_link'];
                                $heading=$row['heading'];
                                $heading=mb_convert_encoding($heading, "UTF-8");
                                $heading=str_replace("?"," ",$heading);
                                $date=date("Y/m/d")."(".$row['news_channel'].")";
                            ?>
                    <li>
                      <div class="media"> <a href="#" class="media-left"> <img alt="" src="<?php echo $img_src;?>" style="height:70px;width:70px;"> </a>
                        <div class="media-body"> <a href="<?php echo $link;?>" class="catg_title"><?php echo $heading;?></a></div>
                      </div>
                   </li>
                  <?php }
                    } ?>
                 </ul>    
                </div>
              </div>
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Other Road-Safety News Links</span></h2>
                <div class="singleleft_inner">
                  <ul class="label_nav">
                    <li><a href="https://www.ndtv.com/topic/road-safety">NDTV</a></li>
                    <li><a href="https://indianexpress.com/about/road-safety/">The Indian Express</a></li>
                    <li><a href="https://www.news18.com/newstopics/road-safety.html">News 18</a></li>
                    <li><a href="http://zeenews.india.com/tags/road-safety.html">ZEE TV</a></li>
                    <li><a href="https://auto.economictimes.indiatimes.com/tag/road+safety">EconomicTimes</a></li>
                    <li><a href="https://theconversation.com/global/topics/road-safety-1104">The Conversation</a></li>
                    <li><a href="https://www.thehindu.com/tag/677-651/road-safety/">The Hindu</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
          </div></div>
    </section>
    <footer id="footer">
      <div class="footer_top">
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInLeft">
            <h2>Contact-Info</h2>
            <div class="subscribe_area">
              <p>India's largest youth-led movement across more than five hundred colleges.</p>
                <h3>Address</h3>
                <p>201, Building No. 252a, Shahpur Jat, Nearby Govindum Sweets, New Delhi, 110049.</p>
                <h3>Contact-Us</h3>
                <p><b>Email:</b> info@road-safety.co.in</p>
                <p><b>For collaboration:</b> 7703849413, 8849620981</p>
                <p><b>For Media inquiries:</b> 8789091933</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInLeft">
            <h2>Resources</h2>
            <ul class="catg3_snav ppost_nav">
              <li>
                <div class="media"> <a class="media-left" href="www.missionroadsafety.com"> <img src="images/portal.png" alt=""> </a>
                    <div class="media-body"> <a class="catg_title" href="www.missionroadsafety.com"> A portal for road accidents data <p style="color: red;">www.missionroadsafety.com</p></a></div>
                </div>
             </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInRight">
            <h2>Important Links</h2>
            <ul class="footer_labels">
              <li><a href="http://www.road-safety.co.in/isafe">iSAFE</a></li>
              <li><a href="http://ambivan.in/">Ambivan</a></li>
              <li><a href="#">Safekart</a></li>
              <li><a href="https://www.road-safety.co.in/marathon/">Marathon</a></li>
              <li><a href="https://www.road-safety.co.in/conference/">Conferences</a></li>
              <li><a href="https://road-safety.co.in/important.php">Important Resources</a></li>
              <li><a href="https://www.road-safety.co.in/portal/studentportal/">Login</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="single_footer_top wow fadeInRight">
            <h2>Contact Form</h2>
            <form action="#" class="contact_form">
              <label>Name</label>
              <input class="form-control" type="text">
              <label>Email*</label>
              <input class="form-control" type="email">
              <label>Message*</label>
              <textarea class="form-control" cols="30" rows="10"></textarea>
              <input class="send_btn" type="submit" value="Send">
            </form>
          </div>
        </div>
      </div>
      <div class="footer_bottom">
        <div class="footer_bottom_left">
          <p>Copyright &copy;2018 IRSC</p>
        </div>
        <div class="footer_bottom_right">
          <ul>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Twitter" href="https://twitter.com/IRSC9"><i class="fa fa-twitter"></i></a></li>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Facebook" href="https://www.facebook.com/indianroadsafetycampaign/"><i class="fa fa-facebook"></i></a></li>
            <li><a class="tootlip" data-toggle="tooltip" data-placement="top" title="Youtube" href="https://www.youtube.com/channel/UCC9OIqNPYnqsGQkG-JJLvxw"><i class="fa fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/jquery.li-scroller.1.0.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>