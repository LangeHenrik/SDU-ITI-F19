<?php include '../app/views/partials/start.php'; ?>
<body>
<div class="base">
<h1>Dét Sgu Da BLÆREDE BILLEDER</h1>
      <h2>Stedet hvor intet er privat og alt er lovligt</h2>
      <div class="form-container login">
          <form class="form-classic" method="POST" action="/magle17/mvc/public/home/doLogin/" >
              <fieldset class="fieldset-classic">
                  <legend>Log ind for at se nogle BlæredeBilleder</legend>
                  <label for="username"> Brugernavn</label>
                  <br>
                  <input type="text" id="username" name="login-username">
                  <br>
                  <label for="password"> Adgangskode</label>
                  <br>
                  <input type="password" id="password" name="login-password">
                  <br>
                  <br>
                  <input class="submit-button" type="submit" id="login" value="Login" name="login">
                  <div class="messagebox" id="login-error-container">
                    
                    <?php 
                    //$_SESSION['loginMessage']='Prøv igen, så kan du se blærede billeder';
                    if(isset($viewbag["loginMessage"])){
                        echo''.$viewbag['loginMessage'];
                        $viewbag['loginMessage'] = ' ';
                    }
                    ?>
                  </div>
              </fieldset>
          </form>
      </div>
      <div class="inbetweener">
          <p >
              <b>Eller</b>
          </p>
      </div>
      <div class="form-container register">
            <form class="form-classic" onSubmit="return checkRegister()" method="POST" action="/magle17/mvc/public/home/registerUser/">
                <fieldset class="fieldset-classic">
                        <legend>Opret dig som bruger for at se nogle BlæredeBilleder</legend>
                        <label for="firstname">Fornavn</label>
                        <br>
                        <input type="text" id="firstname" name="firstname">
                        <br>
                        <label for="lastname">Efternavn</label>
                        <br>
                        <input type="text" id="lastname" name="lastname">
                        <br>
                        <label for="zip">Postnummer</label>
                        <br>
                        <input type="text" id="zip" name="zip">
                        <br>
                        <label for="city">By</label>
                        <br>
                        <input type="text" id="city" name="city">
                        <br>
                        <label for="email">E-mail</label>
                        <br>
                        <input type="text" id="email" name="email">
                        <br>
                        <label for="phone">Telefon</label>
                        <br>
                        <input type="text" id="phone" name="phone">
                        <br>
                        <label for="register-username"> Brugernavn</label>
                        <br>
                        <input type="text" id="register-username" name="register-username">
                        <br>
                        <label for="register-password"> Adgangskode</label>
                        <br>
                        <input type="password" id="register-password" name="register-password">
                        <br>
                        <label for="passwordSecond"> Adgangskode igen</label>
                        <br>
                        <input type="password" id="passwordSecond" name="register-passwordSecond">
                        <br>
                        <br>
                        <input type="submit" class="submit-button" id="register" value="Opret Bruger" name="register"/>
                        <div class="messagebox" id="register-error-container">
                            <?php 
                            //$_SESSION['registerMessage']='Noget gik galt. Kontakt ham med de blærede billeder for at få hjælp.';
                            if(isset($viewbag["registerMessage"])){
                                echo''.$viewbag['registerMessage'];
                                $viewbag['registerMessage'] = ' ';
                            }
                            ?>
                        </div>
                </fieldset>
            </form>
        </div>
    </div>

<?php include '../app/views/partials/end.php'; ?>