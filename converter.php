<?php
    $downloadable=0;
    if(isset($_POST['submit'])){
        
        $url=$_POST['url'];
        $height=$_POST['height'];
        $width=$_POST['width'];       
        $image_name= time();
        
        $location='images';

        $path = $url;
        $name = pathinfo($path,PATHINFO_FILENAME);
        $ext = pathinfo($path,PATHINFO_EXTENSION);

        // echo "EXTENSION: ",$ext;

        $img = file_get_contents($url);

        $im = imagecreatefromstring($img);

        $prev_width = imagesx($im);

        $prev_height = imagesy($im);

        $newWidth = $width;

        $newheight = $height;

        $thumb = imagecreatetruecolor($newWidth, $newheight);
        
        imagecopyresized($thumb, $im, 0, 0, 0, 0, $newWidth, $newheight, $prev_width, $prev_height);

        if($ext=='jpg')
        {   
            // $img=$location.'/'.$image_name.'.jpg';
            $final_name=$image_name.'.jpg';
            $img=$location.'/'.$final_name;
           
            imagejpeg($thumb,$img);
            echo "processing done";
        }
        elseif($ext=='png'){
            imagepng($thumb,$image_name.'.png');
        }
        elseif($ext=='gif'){
                imagegif($thumb,$image_name.'.gif');
            }
        elseif($ext=='bmp'){
                imagebmp($thumb,$image_name.'bmp');
            }
        else{
                imagejpeg($thumb,$image_name.'.jpg');
            }
    
    
            imagedestroy($thumb); 
    
            imagedestroy($im);

            $downloadable=1;

          
    }
 
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
   


<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-4" style="margin-top: 50px;">

            <h1 style="text-align: center;color:blueviolet;" class="">Resize Google Image</h1>

            <form action="imgstore.php" method="POST">
                <div class="mt-2">
                    <label class="form-label fw-bold text-danger" for="url">
                        Image-url
                    </label>
                        <input type="text" class="form-control"name="url" id="" required>
                    
                </div>
                <div class="mt-2">
                    <label class="form-label" for="height">
                        <span style="" class="fw-bold text-info">Image-height</span> 
                    </label>
                        <input type="number" class="form-control" name="height" id="" required step="1">
                    <label class="form-label fw-bold text-info" for="height">
                        Image-width
                    </label>
                        <input type="number" class="form-control" name="width" id="" required step="1">
                    
                </div>
                <div class="mt-2 d-flex justify-content-center">
                    
                    <button class="btn btn-dark" name="submit" >Convert</button>
                    
                </div>
               
                
                
            </form>
            <?php 
            if($downloadable){
            ?>
                <div class="row ">
                    <a href='<?php echo '/'.$img?>' class="btn btn-info ">Download Image</a>
                </div>
               
            <?php
            } ?>
           
               
        </div>
        
    </div>
</div>
</body>
</html>
