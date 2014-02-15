<form enctype="multipart/form-data" action="/admin/product/edit/?id=%{ $_.product.id }%" method="post">
    <span class="centered">
        <fieldset id="admin-products-radios">
            %{ foreach from=$_.categories key=k item=category }%
            <input id="radio%{ $k }%" type="radio" name="category" value="%{ $category.id }%" %{ if isset($category.checked) }%checked%{ /if }%/>
                   <label for="radio%{ $k }%">%{ $category.name }%</label>
            %{ /foreach }%
        </fieldset>
    </span>
    <fieldset id="admin-products-inputs">
        <span class="left-col">
            <label for="title-text">Titolo:</label>
            <input id="title-text" type="text" name="title" value="%{ $_.product.title }%"/>
            <label for="description-text">Descrizione:</label>
            <textarea id="description-text" name="description">%{ $_.product.description }%</textarea>
            <label for="price-text">Prezzo:</label>
            <input id="price-text" type="text" name="price" value="%{ $_.product.price }%"/>
        </span>
        <span class="right-col">
            <img src="%{ $_.product.image }%"/>
        </span>
    </fieldset>
    <div class="right">
        <button id="clear-form" type="reset" name="clear">Ripristina</button>
    </div>
    <div class="centered">
        <div class="admin-actions">
            <a class="link-action" href="/admin/products/">Annulla</a>
            <button class="save-action" type="submit" name="action" value="save">
                <img src="/img/confirm.png"/>Salva
            </button>
        </div>
    </div>
</form>
