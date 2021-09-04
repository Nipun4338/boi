
<!--$configuration = \Uploadcare\Configuration::create($_ENV['17b0d03f8e05e110e978'], $_ENV['783a0357d3a1314a9098']);-->
<?php
if(!empty($_POST["file"]))
{
  echo $_POST["file"];
}

 ?>
<form action="" method="post">
  <div>
    <input type="hidden" name="file" role="uploadcare-uploader"
    data-clearable="true"
    data-crop="free"/>
  </div>
<button type="submit">
</form>
<script>
  UPLOADCARE_LOCALE="en";
  UPLOADCARE_LIVE=false;
  UPLOADCARE_PUBLIC_KEY='17b0d03f8e05e110e978';
</script>
<script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js" charset="utf-8"></script>
