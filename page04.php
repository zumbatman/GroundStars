<DOCTYPE html>
<?php 
require('functions.php');
$title = "Partage de fichiers";
head($title);
session_checker();
topjumbotron($title);
navbar(3);
echo 'Partage de fichiers';?>
<script>
function uploadfile(){
  var filename = $('#filename').val();                    //To save file with this name
  var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
  var form_data = new FormData();
  form_data.append("file",file_data);
  form_data.append("filename",filename);
  //Ajax to send file to upload
  $.ajax({
      url: "load.php",                      //Server api to receive the file
             type: "POST",
             dataType: 'script',
             cache: false,
             contentType: false,
             processData: false,
             data: form_data,
          success:function(dat2){
            if(dat2==1) alert("Successful");
            else alert("Unable to Upload");
          }
    });
}
</script>
  <div id="container">
    <input type="file" class="fileToUpload form-control" ></input><br>
    <input type="text" placeholder="File name" id="filename" class="form-control"/><br>
    <button class="btn btn-success" onclick="uploadfile()">Upload</button>
  </div>
<?php
footer();
?>