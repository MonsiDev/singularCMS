<form method=POST action="/home/auth">
  <input type=text name="login">
  <input type=password name="password">
  <input type=submit value="Войти">
  <div class="msg"><?php _esc($msg->text); ?></div>
</form>
