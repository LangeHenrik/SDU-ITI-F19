<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="../../public/picture/upload" method="post" enctype="multipart/form-data">
    <input type="hidden" name="size" value="10000">

        <input class="comment" type="file" name="file" value="">

        <div>
          <textarea name="text" cols="50" rows="10" placeholder="This is where you put the title"></textarea>
        </div>

        <div>
          <textarea name="descr" cols="50" rows="10" placeholder="This is where you put the description"></textarea>
        </div>

        <div>
          <button class="combot" type="submit" name="upload_button">Upload</button>
        </div>
        
      </form>';
  </body>
</html>
