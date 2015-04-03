<table id="categories-grid">
    <caption id="tasks">
        <form enctype="multipart/form-data" action="/admin/category/add" method="post">
            <label for="category">Categoria:</label>
            <input id="category-text" type="text" name="category"/>
            <button class="save-action" type="submit" name="action" value="save">
                <img src="/img/confirm.png"/>Aggiungi
            </button>
        </form>
    </caption>
    <thead>
        <tr>
            <th class="category-cell">Nome categoria</th>
        </tr>
    </thead>
    <tbody>
        %{ foreach from=$_.categories item=category }%
        <tr>
            <td class="category-cell hoverable">
                <form class="ren-form" action="/admin/category/set/" method="post">
                    <input type="hidden" name="category_id" value="%{ $category.id }%"/>
                    <span class="active-text">%{ $category.name }%</span>
                </form>
                <form class="del-form" action="/admin/category/del/" method="post">
                    <input type="hidden" name="category_id" value="%{ $category.id }%"/>
                    <input class="hidden" type="image" src="/img/delete.png"/>
                </form>
            </td>
        </tr>
        %{ /foreach }%
    </tbody>
</table>