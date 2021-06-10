<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <title>Agrivator | Internship Portal</title>
</head>

<body style="font-family: 'Signika Negative', sans-serif;">
    <style>
        .form-rounded {
            border-radius: 1rem;
        }

        .form-control:focus {
            border-color: #78B122;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 5px #78B122;
        }
    </style>
    <div class="row mx-auto">
        <div class="col-md-6 align-items-center" style="display: flex;flex-direction: column;">
            <div class="row" style="justify-content: space-between;">
                <img src="./Logo with Side Text - White.png" class="mx-auto my-2" style="width: 200px;" alt="">
                <img src="./image1.png" style="width: 100%;" alt="">
                <p class="text-center">Follow us on</p>
            </div>
        </div>
        <div class="col-md-6 " style="background-color: #eaffcb;">
            <div class="col-md-8 mx-auto">
                <h1 style="font-weight: 700;" class="text-center my-5 h1-responsive">
                    Agrivator Internship Program
                </h1>
                <form class="row g-3 align-items-center mb-5" method="post" action="<?=$_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" name="name" class="form-control form-rounded" id="email" required>
                    </div>
                    <div class="col-12">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="phone" name="phone" class="form-control form-rounded" id="email" required>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-rounded" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="stack" class="form-label">Stack</label>
                        <textarea class="form-control form-rounded" name="stack" id="stack" rows="3"></textarea required>
                    </div>
                    <div class="col-12">
                        <label for="reference" class="form-label">Reference to Agrivator(if any)</label>
                        <input type="text" class="form-control form-rounded" name="reference" id="reference">
                    </div>
                    <div class="mb-3">
                        <label for="cv" class="form-label">Upload your CV</label>
                        <input class="form-control form-rounded" type="file" id="cv" name="cv" required>
                    </div>
                    <div class="col-12">
                        <input style="background-color: #78B122;border-color: #78B122;" type="submit" name="submit" value="Submit"
                            class="btn btn-success"></input>
                            <?php
                                try{
                                    function console_log($output, $with_script_tags = true) {
                                        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
                                    ');';
                                        if ($with_script_tags) {
                                            $js_code = '<script>' . $js_code . '</script>';
                                        }
                                        echo $js_code;
                                    }
                                  $conn = new mysqli("localhost", "root", "devmodeon","agrivator_intern"); // Establishing Connection with Server
                                  if ($conn->connect_error) {
                                      die("Connection failed: " . $conn->connect_error);
                                   } 
                                  if(isset($_POST['submit']))
                                  { // Fetching variables of the form which travels in URL
                                      $name = $_POST['name'];
                                      $phone = $_POST['phone'];

                                      $email = $_POST['email'];
                                      $stack = $_POST['stack'];
                                      $reference = $_POST['reference'];
                                      //$cv = $_POST['cv'];
                                     // $_FILES=$_POST['cv'];
                                      $allowedExts = array(
                                        "pdf", 
                                        "doc", 
                                        "docx"
                                      ); 
                                      
                                      $allowedMimeTypes = array( 
                                        'application/msword',
                                        'text/pdf',
                                        'image/gif',
                                        'image/jpeg',
                                        'image/png','application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                                      );
                                     // var_dump($_FILES['cv']);
$ex=explode(".", $_FILES["cv"]["name"]);
                                      $extension = end($ex);
                                      
                                      if ( 2000000 < $_FILES["cv"]["size"]  ) {
                                        die( 'Please provide a smaller file [E/1].' );
                                      }
                                      
                                      if ( ! ( in_array($extension, $allowedExts ) ) ) {
                                        die('Please provide another file type [E/2].');
                                      }
                                      
                                      if ( in_array( $_FILES["cv"]["type"], $allowedMimeTypes ) ) 
                                      {    
                                        $cv = $name.time().$_FILES["cv"]["name"];  
                                       // $destination_path = getcwd().DIRECTORY_SEPARATOR;
                                       //$target_path = $destination_path . basename( $_FILES["cv"]["name"]);
                                           //move_uploaded_file($_FILES['cv']['tmp_name'], $target_path)
                                      move_uploaded_file($_FILES["cv"]["tmp_name"], __DIR__."\uploads"."\\".$cv ); 
                                       
                                       $sql ="insert into agrivator_intern.responses(name,email,phone,stack,reference,cv) values ('$name','$email','$phone','$stack','$reference','$cv')";
                                      
                                      }
                                      else
                                      {
                                      die('Please provide another file type [E/3].');
                                      }
                                     //console_log($_FILES['cv']);
                                      if($name !=''||$email !=''){
                                      //Insert Query of SQL
                                      if (mysqli_query($conn, $sql)) 
                                      {
                                        $message = "Data Submitted";
                                        echo "<script type='text/javascript'>alert('$message');</script>";
                                        // echo "New record created successfully";
                                     } else {
                                        $message = "Submission Error!!";
                                        echo "<script type='text/javascript'>alert('$message');</script>";
                                     }
                                  }
                                  else{
                                      $message = "Insertion Failed.. Some Fields are Blank....!!";
                                      echo "<script type='text/javascript'>alert('$message');</script>";
                                  }
                                  // header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
                                  // exit(); 
                                  }
                                    // Closing Connection with Server
                                   $conn->close();
                                
                                }
                                catch(Exception $e) {
                                  echo 'Message: ' .$e->getMessage();
                                }
                                
                                ?>
                               
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>