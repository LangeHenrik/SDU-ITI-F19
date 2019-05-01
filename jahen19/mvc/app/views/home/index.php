<!DOCTYPE html>
<html>
  <head>
      <title>My Awesome Website</title>
      <meta charset="UTF-8" />
      <meta name="HandheldFriendly" content="true">
      <meta name="MobileOptimized" content="320">
      <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no, shrink-to-fit=no">


      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
      <?php include '../app/views/partials/header.php'; ?>

      <?php if ($viewbag['loggedin'] == true) { ?>
      <div class="container">
          <div class="row pt-3">
              <section id="form-wrapper" class="form-group col-sm">
                  <form id="fileform" action="return false;">
                      <div class="form-group">
                          <label for="file">Select picture:</label>
                          <input type="file" name="file" autocomplete="off" required class="form-control-file">
                      </div>

                      <div class="form-group">
                          <label for="header">Header:</label>
                          <input type="text" name="header" autocomplete="off" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="subtext">Subtext:</label>
                          <textarea name="subtext" autocomplete="off" class="form-control"></textarea>
                      </div>

                      <input id="input-button" type="button" name="submit" value="Upload" onclick="return send();" class="btn btn-primary">
                  </form>
              </section>
              <div class="col-sm">
                  <div id="location" class="text-muted"><?php echo htmlspecialchars($viewbag['city']) ?></div>
                  <br>
                  <div id="weather-conditions" class="text-center display-4"></div>
              </div>
          </div>
      </div>
      <?php } ?>

    <hr>

    <div id="quotes-container" class="container">
        <blockquote class="blockquote text-center">
            <p id="quote-text" class="mb-0"></p>
            <footer id="quote-author" class="blockquote-footer"></footer>
        </blockquote>
    </div>

    <hr>

    <?php if ($viewbag['myfeed'] == true) { ?>
        <a href="/jahen19/mvc/public/home/">Go to Global Feed</a>
    <?php } else { ?>
        <a href="/jahen19/mvc/public/home/my">Go to Your Feed</a>
    <?php } ?>

    <?php include '../app/views/partials/mainfeed.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/jahen19/mvc/public/script.js"></script>

</body>
</html>
