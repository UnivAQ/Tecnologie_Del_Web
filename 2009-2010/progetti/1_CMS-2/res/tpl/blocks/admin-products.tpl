<table id="products-grid">
    <caption id="tasks">
        <form id="filter-form" action="/admin/product/search/" method="get">
            <input type="text" name="query" placeholder="Filtra i record..."/>
            <button type="input" name="action" value="filter" title="Filtra i record della tabella">Filtra</button>
        </form>
        <div>
            <a class="link-action" href="/admin/product/add/">Aggiungi prodotto</a>
        </div>
    </caption>
    <thead>
        <tr>
            <th></th>
            <th class="category-cell">Categoria</th>
            <th class="title-cell">Titolo</th>
            <th class="description-cell">Descrizione</th>
            <th class="price-title-cell">Prezzo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        %{ foreach from=$_.products item=product }%
        <tr>
            <td>
                <a class="link-action" href="/admin/product/edit/?id=%{ $product.id }%" title="Edit product">Edit</a>
            </td>
            <td class="category-cell">%{ $product.category }%</td>
            <td class="title-cell">%{ $product.title }%</td>
            <td class="description-cell">%{ $product.description|truncate:75 }%</td>
            <td class="price-cell">%{ $product.price }%€</td>
            <td>
                <form action="/admin/product/del/" method="post">
                    <input type="hidden" name="product_id" value="%{ $product.id }%"/>
                    <button class="delete-action" type="submit" name="action" value="delete" title="Delete product">
                        <img src="/img/delete.png"/>
                    </button>
                </form>
            </td>
        </tr>
        %{ /foreach }%
    </tbody>
</table>