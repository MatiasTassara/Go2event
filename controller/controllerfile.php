<?php
namespace controller;

class ControllerFile
{

  function __construct()
  {

  }

  public function upload($nombre_imagen, $folder){

    $imageDirectory = 'images/';

    if(!file_exists($imageDirectory))
    mkdir($imageDirectory);

    if($_FILES)
    {
      if((isset($_FILES['fileToUpload'])) && ($_FILES['fileToUpload']['name'] != ''))
      {
        $file = $imageDirectory . basename($_FILES['fileToUpload']['name']);

        //Obtenemos la extensión del archivo. No sirve para comprobar el veradero tipo del archivo
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        //Genera un array a partir de una verdera imagen. Retorna false si no es una archivo de imagen
        $imageInfo = getimagesize($_FILES['fileToUpload']['tmp_name']);
        //var_dump($imageInfo);
        if($imageInfo !== false)
        {
          //echo $imageInfo['mime'];

          if(!file_exists($file))
          {
            //echo $_FILES['fileToUpload']['size'];
            if($_FILES['fileToUpload']['size'] < 5000000) //Menor a 5 MB
            {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file))
              {
                //echo 'el archivo '.basename($_FILES["fileToUpload"]["name"]).' fue subido correctamente.';

                //echo '<img src="'.$file.'" border="0" title="'.$_FILES["fileToUpload"]["name"].'" alt="Imagen"/>';
              }

            }
          }
        }
      }
    }

  }
}

?>
