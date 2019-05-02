<?php include '../app/views/partials/menu.php';?>
      <form class="upload_form" action="../../../mvc/public/picture/upload" method="post" enctype="multipart/form-data">
          <input type="file" name="file" value="">
          <input type="text" name="description">
          <button type="submit" name="uploade_submit">Upload</button>';
			<?php
