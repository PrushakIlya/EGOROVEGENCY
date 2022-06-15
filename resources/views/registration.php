<section class="registration-section">
  <div class="registration wrapper">
    <div class="header">
      <p>If you have a account <span>click HERE!</span></p>
      <a href="/autorization" class='btn'>Autorization</a>
    </div>
    <div class="registration-block">
      <form action="/store" method="POST" name="user_form">
        <h2>Registration</h2>
        <div id="error_name" class="error_name errors"></div>
        <div class="registration-input">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" autofocus onchange="checkName()">
        </div>
        <div id="error_password" class="error_password errors"></div>
        <div class="registration-input">
          <label for="name">Password</label>
          <input type="password" name="password" id="password" onchange="checkPassword()">
        </div>
        <div id="error_repeat_password" class="error_repeat_password errors"></div>
        <div class="registration-input">
          <label for="repeat_password">Repeat Password</label>
          <input type="password" name="repeat_password" id="repeat_password" onchange="checkRepeatPassword()">
        </div>
        <input type="submit" value="registration" class="btn" id="form_btn">
      </form>
    </div>
  </div>
</section>
<script src="js/registration.js" defer></script>