<?php
include '../app/views/partials/menu.php';
?>

<!-- Page content -->
<div class="-content -padding" style="max-width:1564px">

  <!-- Contact Section -->
  <div class="-container -padding-32" id="contact">
    <h3 class="-border-bottom -border-light-grey -padding-16">Contact</h3>
    <p>Lets get in touch and talk about your next project.</p>
    <form onsubmit="return contact-submit()" action="contact.php" method="post">
      <input class="-input -border" type="text" placeholder="Name" required name="Name" id="name" onblur = "checkName(this)">
      <input class="-input -section -border" type="text" placeholder="Email" required name="Email" id="email">
      <input class="-input -section -border" type="text" placeholder="Subject" required name="Subject" id="subject">
      <input class="-input -section -border " type="text" placeholder="Comment" required name="Comment" id="comment">
      <button class="-button -black -section" type="submit">
        <i class="-text-white"></i> SEND MESSAGE
      </button>
    </form>
  </div>
  
<!-- Image of location/map -->
<div class="-container">
  <img src="/silar17/mvc/public/images/map.jpg" class="-image" style="width:100%">
</div>

<!-- End page content -->
</div>


<!-- Footer -->
<?php include '../app/views/partials/footer.php'; ?>




