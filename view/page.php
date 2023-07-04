<div class="center-block"> 
    <h1>Дерево объектов</h1>

    <table style="width:100%">
        <tbody>
            <tr>
                <td width="60">
                    <div class="tree">
                        <? echo $list;?>
                    </div>
                </td>
                <td width="40" valign="top">
                    <div class="text-more">
                        Описание пункта
                        <div id="description-text">
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    <script>

    let elements = document.querySelectorAll('.tree li');
    dad = document.querySelector('#description-text');
    for (let elem of elements) {
        elem.onclick = function(e) {
            let txt = this.getAttribute('data-description');
            dad.innerHTML = txt;
        }
    }

    </script>