<h1>Дерево</h1>
<style>
    /*ul ul{
        display: none;
    }*/
</style>
<table style="width:100%">
    <tbody>
        <tr>
            <td width="60">
                <div class="tree">
                    <? echo $list;?>
                </div>
            </td>
            <td width="40">
                Описание пункта
                <div id="description-text">

                </div>
            </td>
        </tr>
    </tbody>
</table>
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