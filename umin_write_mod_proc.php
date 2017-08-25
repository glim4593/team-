<?php
$conn = mysqli_connect('127.0.0.1', 'root', '1234', 'umin');
  if($_POST['subject'] == '' OR $_POST['content'] == '')
  {
    echo "<script>alert('입력 값 이 없습니다.');
          location.href='javascript:history.back()';
          </script>";
    exit;
  }
  $alert = array("강아지", "고양이");
  $count = count($alert);
$subject = mysqli_real_escape_string($conn,$_POST['subject']);
$content = mysqli_real_escape_string($conn,$_POST['content']);
$upload = mysqli_real_escape_string($conn, $_FILES['upload']['name']);
for($i=0;$i<$count;$i++)
{
  $subject = str_replace($alert[$i], "뿅뿅", $subject);
  $content = str_replace($alert[$i], "OO", $content);
}
$no = $_POST['no'];
$sql = "UPDATE board SET subject = '{$subject}', content = '{$content}', upload = '{$upload}' WHERE no = {$no}";
$result = mysqli_query($conn,$sql);

  if($result)
  {
    if(is_uploaded_file($_FILES['upload']['tmp_name']))
    {
      $tmpfile = $_FILES['upload']['tmp_name'];
      $updir = "c:\\xampp\\htdocs\\upload\\";
      $upfile = $updir . $_FILES['upload']['name'];
      if(move_uploaded_file($tmpfile, $upfile))
      {
        echo "<script>alert('글 수정에 성공했습니다.');
              location.href='/20170822/umin_read.php?no={$no}';
              </script>";

              mysqli_close($conn);
      }
      else
      {
        echo "<script>alert('파일 첨부를 실패했습니다.');
              location.href='javascript:history.back()';
              </script>";

              mysqli_close($conn);
      }
    }

    echo "<script>alert('글 수정에 성공했습니다.');
          location.href='/20170822/umin_read.php?no={$no}';
          </script>";

          mysqli_close($conn);

  }
  else
  {
    echo "<script>alert('글 수정에 실패했습니다.');
          location.href='javascript:history.back()';
          </script>";
          
          mysqli_close($conn);
  }
 ?>
