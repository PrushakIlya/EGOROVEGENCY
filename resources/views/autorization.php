<section class="autorization-section">
  <div class="autorization wrapper">
    <div class="header">
      <p>If you do not have a account <span>click HERE!</span></p>
      <a href="/" class='back btn'>Back</a>
    </div>
    <form action="/autorizationCheck" method="POST" id="auth_user_form">
      <h1>Autorization</h1>
      <div id="error_name" class="error_name errors"></div>
      <div class="autorization-input">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" autofocus>
      </div>
      <div id="error_password" class="error_password errors"></div>
      <div class="autorization-input">
        <label for="name">Password</label>
        <input type="password" name="password" id="password">
      </div>
      <input type="submit" class="btn" id="form_btn" value="Autorization">
    </form>
  </div>
</section>
<script src="js/autorization.js" defer></script>
