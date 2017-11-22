<?php
    include("header.php");
    include("navbar.php");
?>


    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>
<?php
if(isset($_POST['register'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nohp = $_POST['nohp'];
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://tugas-sit.komsi.ga/auth/public/api/register",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 300,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "name=". $name ."&email=". $email ."&password=". $password . "&phone_number=". $nohp ."",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            //echo $response;
            //decode dulu
            $data = json_decode($response);
            if($data->status) {
                //echo "berhasil";
                echo '<script type="text/javascript">';
                echo "alert('OK, Anda Berhasil Registrasi'); window.location='index.php'";
                echo "</script>";
                $pesan = "Selamat, Anda berhasil Registrasi di Voucheria!";
                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://blacklight.id/api/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 300,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "tujuan=". $nohp ."&pesan=". $pesan ."",
                CURLOPT_HTTPHEADER => array(
                    "api_key: $2y$10$910Pjp4TajYH9GE.jN74Zuz9CnjgTxoBiVFjrFzMt0U/SoldrcXtK",
                    "email: shafirafitrianissa02@gmail.com",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
        
            curl_close($curl);
                if ($err) {
                    echo '<script type="text/javascript">';
                    echo "alert('OK, $err');";
                    echo "</script>"; 
                    //echo "cURL Error #:" . $err;
                } else {
                    echo '<script type="text/javascript">';
                    echo "alert('OK, SMS Registrasi telah dikirimkan');";
                    echo "</script>"; 
                }
                header("location:index.php");
            } else {
                //echo "Gagal ndaftar bu, errornya: " . $data->error;
                echo '<script type="text/javascript">';
                echo "alert('OK, Maaf email yang Anda masukkan telah terdaftar');";
                echo "</script>";
            }
        }
    }
}else if(isset($_POST['login']) or isset($_POST['login2'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $emaillog = $_POST['emaillog'];
        $passlog = $_POST['passwordlog'];
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://tugas-sit.komsi.ga/auth/public/api/login",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 300,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "email=". $emaillog ."&password=". $passlog ."",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
          ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
       if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response);
            //print_r($data);
            if($data->status) {
                $_SESSION['login'] = $data->result->user->name;
                $_SESSION['userid']= $data->result->user->id;
                // echo "berhasil";
                //session_start();
                //session_register('login');
                header("location:http://localhost/Voucheria/");
            } else {
                //echo "Gagal ndaftar bu, errornya: " . $data->error;
                echo '<script type="text/javascript">';
                echo "alert('OK, Maaf Email atau Password salah! Silahkan Coba lagi!');";
                echo "</script>";
            }
        }
    }
}
?>
                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>

                        <hr>

                        <form action="" method="post">
                            <input type="hidden" name="register" value="1">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name= "name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="number">No. HP</label>
                                <input type="text" class="form-control" name="nohp">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                    

                        <hr>

                        <form action="" method="post">
                            <input type="hidden" name="login" value="1">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="emaillog">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="passwordlog">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>

                        <ul>
                            <li><a href="text.html">About us</a>
                            </li>
                            <li><a href="faq.html">FAQ</a>
                            </li>
                            <li><a href="contact.html">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="register.html">Register</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Top categories</h4>
                        <ul>
                            <li><a href="category.html">Steam</a>
                            </li>
                            <li><a href="category.html">Line Store</a>
                            </li>
                            <li><a href="category.html">Xbox Live Gift Card</a>
                            </li>
                        
                            <li><a href="category.html">I-Tunes Gift Card</a>
                            </li>
                            <li><a href="category.html">Facebook Game Card</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Voucheria</strong>
                            <br>Gedung SV UGM, Sekip Unit 1
                            <br>Catur Tunggal
                            <br>Depok, Sleman
                            <br>
                            <strong>Yogyakarta</strong>
                        </p>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        <h4>More Information</h4>


                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

                <button class="btn btn-default" type="button">Subscribe!</button>

            </span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        <h4>Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2015 Voucheria.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious</a> & <a href="https://fity.cz">Fity</a>
                         <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>



</body>

</html>
