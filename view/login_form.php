<div class="center-block"">
    <h2>Вход на страницу администратора:</h2>
    <?if(isset($_GET['error']) && $_GET['error'] == 1){?>
        <p>Проверьте введенные данные на ошибки</p>
    <?}?>
    <form action="/enter" method="POST">
        <div>Логин: <input type="text" name="login"></div>
        <div>Пароль: <input type="password" name="password"></div>
        <input type="submit" value="Вход">
    </form>
</div>
