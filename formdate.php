<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

<form id="form">
  <input type="file" name="att" id="up_file">
  <input type='text' name='text'>
</form>
<input type="button" name="upload" value="전송">

<script>
  function func(data)
  {
    alert(data);
  }
  function ajax_func()
  {
    
    form = $("form")[0];
    formdata = new FormData(form);
    alert(formdata);
    $.ajax({
      type: "POST",
      url: "/20170822/ajax.php",
      contentType: false,
      processData: false,
      data: formdata,
      success: func
    });
  }
  $("input[name='upload']").click(ajax_func);
</script>
