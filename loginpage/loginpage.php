<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register and Login</title>

    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
  </head>
  <body>
    <div class="container" id="signup" style="display: none">
      <h1 class="form-title">Register</h1>
      <form method="post" action="register.php">
        <div class="input-group">
          <i class="bi bi-person-fill custom-icon"></i>
          <input type="text" id="fname" name="fName" placeholder="First Name" />
          <label for="fname">First Name</label>
        </div>
        <div class="input-group">
          <i class="bi bi-person-fill custom-icon"></i>
          <input type="text" id="lname" name="lName" placeholder="Last Name" />
          <label for="lname">Last Name</label>
        </div>
        <div class="input-group">
          <i class="bi bi-envelope-fill custom-icon"></i>
          <input type="email" id="email" name="email" placeholder="E-Mail" />
          <label for="lname">E-Mail</label>
        </div>
        <div class="input-group">
          <i class="bi bi-lock-fill custom-icon"></i>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="password"
            required
          />
          <label for="lname">Password</label>
        </div>
        <input
          type="submit"
          value="Sign up"
          id="signUp"
          name="signUp"
          class="btn"
        />
      </form>
      <p class="or">----------or----------</p>
      <div class="icons">
        <i class="bi bi-google"></i>
        <i class="bi bi-facebook"></i>
      </div>
      <div class="links">
        <p>Already have an account?</p>
        <button id="signInButton">Sign in</button>
      </div>
    </div>
    <div class="container" id="signin">
      <h1 class="form-title">Sign In</h1>
      <form method="post" action="register.php">
        <div class="input-group">
          <i class="bi bi-envelope-fill custom-icon"></i>
          <input type="email" id="email" name="email" placeholder="E-Mail" />
          <label for="lname">E-Mail</label>
        </div>
        <div class="input-group">
          <i class="bi bi-lock-fill custom-icon"></i>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="password"
            required
          />
          <label for="lname">Password</label>
        </div>
        <p class="recover"><a href="#">Recover password</a></p>
        <input
          type="submit"
          value="Sign In"
          id="signIn"
          name="signIn"
          class="btn"
        />
      </form>
      <p class="or">----------or----------</p>
      <div class="icons">
        <i class="bi bi-google"></i>
        <i class="bi bi-facebook"></i>
      </div>
      <div class="links">
        <p>Don't have an account?</p>
        <button id="signUpButton">Sign up</button>
      </div>
    </div>
  </body>
</html>
