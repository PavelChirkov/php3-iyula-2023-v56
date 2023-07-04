<a href="/exit">Выход</a>
<h2>Добавить элемент:<h2>
<form action="/add_element" method="POST">
    <div>
        Родитель элемента: <? print $select;?>
    </div>
    <div>
        Название элемента: <input type="text" name="name">
    </div>
    <div>
        Описание элемента: <textarea name="description"></textarea>
    </div> 
    <div>
        <input type="submit" value="Добавить">
    </div>
</form>
<? print $view; ?>