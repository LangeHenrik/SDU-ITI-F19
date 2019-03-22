<?php

    $page = 'upload';
    Views\Core\Header::view($page);

?>

    <div class="content">
        
        <div class="form_outer">
            <h3>Upload Photo</h3>

            <form class="form" role="form" action="/upload" onsubmit="return validateForm(this)" method="post" enctype="multipart/form-data">

            <div class="form_element">
                <input type = "file" class = "form-control" name = "file" placeholder = "Your Photo" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "title" placeholder = "Title" onkeyup="validateInput(this)" required>
            </div>

            <div class="form_element">
                <input type = "text" class = "form-control" name = "caption" placeholder = "Caption" onkeyup="validateInput(this)" required>
            </div>
            
            <button>Upload</button>
            </form>

        </div>

    
    </div>


<?php

Views\Core\Footer::view();

?>