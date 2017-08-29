<?php
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
session_start();
if(isset($_POST['check']))
{
  if($_POST['year'] != '' or $_POST['month'] != '' or
   $_POST['day'] != '' or $_POST['hour'] != '' or  $_POST['min'] != '')
   {
     $alert = array("강아지", "고양이");
     $count = count($alert);
     $data = "{$_POST['year']}-{$_POST['month']}-{$_POST['day']} {$_POST['hour']}:{$_POST['min']}:00";
     $writer = mysqli_real_escape_string($conn,$_POST['writer']);
     $subject = mysqli_real_escape_string($conn,$_POST['subject']);
     $content = mysqli_real_escape_string($conn,$_POST['content']);
     $upload = mysqli_real_escape_string($conn, $_FILES['ff']['name']);
     for($i=0;$i<$count;$i++)
     {
       $subject = str_replace($alert[$i], "뿅뿅", $subject);
       $content = str_replace($alert[$i], "OO", $content);
     }
     $sql = "INSERT INTO reserve(writer,subject,content, upload, show_date) values('{$writer}','{$subject}','{$content}', '{$upload}', '{$data}')";
     $result = mysqli_query($conn,$sql);
     if($result)
     {
       if(is_uploaded_file($_FILES['ff']['tmp_name']))
       {
         $tmpfile = $_FILES['ff']['tmp_name'];
         $updir = "c:\\xampp\\htdocs\\upload\\";
         $upfile = $updir . $_FILES['ff']['name'];
         if(move_uploaded_file($tmpfile, $upfile))
         {
           //mysqli_close($conn);

           echo "<script>alert('글이 작성되었습니다.');
                 location.href='/board/team-/free_menu.php?page=1';
                 </script>";

                 mysqli_close($conn);

           //echo "글이 작성되었습니다.";
         }
         else
         {
           //mysqli_close($conn);
           echo "<script>alert('파일첨부에 실패했습니다.');
                 location.href='javascript:history.back()';
                 </script>";

                 mysqli_close($conn);

           //echo "파일첨부에 실패했습니다.";

         }
       }


       echo "<script>alert('글이 작성되었습니다.');
             location.href='/board/team-/free_menu.php';
             </script>";

             mysqli_close($conn);

       //echo "글이 작성되었습니다.";
     }
     else
     {
       //print_r($sql);
       //mysqli_close($conn);

       echo "<script>alert('글 작성에 실패 했습니다.');
             location.href='javascript:history.back()';
             </script>";

             mysqli_close($conn);

       //echo "글 작성에 실패했습니다.";
     }
   }


 exit;
}
/*
print_r($_POST);
print_r($_FILES);
exit;
*/


//print_r($_POST);

  if($_POST['writer'] == '' OR $_POST['subject'] == '' OR $_POST['content'] == '')
  { /*
    echo "<script>alert('입력 값 이 없습니다.');
          location.href='javascript:history.back()';
          </script>";

      */
    echo "<script>
          alert('입력값이 부족합니다.');
          location.href='javascript:history.back()';
          </script>";
    exit;
  }
  $alert = array("강아지", "고양이");
  $count = count($alert);
  $writer = mysqli_real_escape_string($conn,$_POST['writer']);
  $subject = mysqli_real_escape_string($conn,$_POST['subject']);
  $content = mysqli_real_escape_string($conn,$_POST['content']);
  $upload = mysqli_real_escape_string($conn, $_FILES['ff']['name']);
  //$cate = $_POST['cate'];

  for($i=0;$i<$count;$i++)
  {
    $subject = str_replace($alert[$i], "뿅뿅", $subject);
    $content = str_replace($alert[$i], "OO", $content);
  }

  $sql = "INSERT INTO board(writer,subject,content, upload) values('{$writer}','{$subject}','{$content}', '{$upload}'";
  $result = mysqli_query($conn,$sql);
  //print_r($sql);
  //exit;
  if($result)//INSERT 성공 = 1
  {
    if(is_uploaded_file($_FILES['ff']['tmp_name']))
    {
      $tmpfile = $_FILES['ff']['tmp_name'];
      $updir = "c:\\xampp\\htdocs\\upload\\";
      $upfile = $updir . $_FILES['ff']['name'];
      if(move_uploaded_file($tmpfile, $upfile))
      {

        echo "<script>alert('글이 작성되었습니다.[파일첨부]');
              location.href='/board/team-/free_menu.php?page=1';
              </script>";

              mysqli_close($conn);


        //echo "글이 작성되었습니다.";
      }
      else

        //mysqli_close($conn);
        echo "<script>alert('파일첨부에 실패했습니다.');
              location.href='javascript:history.back()';
              </script>";

              mysqli_close($conn);

      //  echo "파일첨부에 실패했습니다.";

      }

    //mysqli_close($conn);

//  for ($i=0; $i <= $cate ; $i++)

    echo "<script>alert('글이 작성되었습니다.');
          location.href='/board/team-/free_menu.php?page=1';
          </script>";

          mysqli_close($conn);



  //  echo "글이 작성되었습니다.";
}
  else
  {
    //mysqli_close($conn);

    echo "<script>alert('글 작성에 실패 했습니다.');
          location.href='javascript:history.back()';
          </script>";

    //echo "글 작성에 실패했습니다.";

    mysqli_close($conn);
    exit;
  }

 ?>
