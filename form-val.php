<html>
    <head>
        <meta charset="UTF-8">
        <style>
        .error {color:#FF0000;}
        </style>
    </head>
    <body>
<?php
    function clean_input($data){
        $data = trim($data);//เอาเว้นวรรคด้านหน้าหรือหลังออกไป
        $data = stripslashes($data);//เอาเครื่องหมาย \ ออกเพื่อความปลอดภัยป้องการ hack ระดับหนึ่ง
        $data = htmlspecialchars($data);

        return $data;
    }//end function

    $nameError = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["name"])){
            $nameError = "Name is reqiured";
        }else{
            $namereceive = clean_input($_POST["name"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $namereceive)){
                $nameError = "ใส่เฉพาะตัวอักษรและเว้นวรรคเท่านั้น";
            }else{
                $nameOfNewFile = "textfiles/".date("Y-m-d-h-i-sa")."txt";
                $myfile = fopen("$nameOfNewFile", "w") or die("Unable to open file!");
                fwrite($myfile, $namereceive);
                fclose($myfile);
                ?>
                <a href="<?php echo $nameOfNewFile ?>" target="_blank">ดูไฟล์ล่าสุด</a>
                <?php
            }
        }
    }//end if $_SERVER
?>


        <!-- ELEMENT 1 : FORM -->
        <!-- ELEMENT 4 : ACTION / METHOD -->
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <!-- ELEMENT 2 : RAW DATA -->
            Name : <input type="text" name="name">
            <span class="error"> <?php echo $nameError; ?></span>
        <!-- ELEMENT 3 : BUTTON -->
            <input type="submit" name="ส่ง" value="ส่ง">
        </form>

        <?php
        // //รับค่า จากตัวเชื่อมโยงที่ชื่อว่า  name
        //     $namereceive = $_POST["name"];

            // if(!empty($namereceive)){
            //     echo $namereceive;
            // }

            if(isset($_POST["name"])){
                //รับค่า จากตัวเชื่อมโยงที่ชื่อว่า name
                $namereceive = clean_input($_POST["name"]);
                echo $namereceive;

                
              
              

            }


            
        ?>

    </body>
</html>