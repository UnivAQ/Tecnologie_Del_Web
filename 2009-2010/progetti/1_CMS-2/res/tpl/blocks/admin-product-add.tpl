<form enctype="multipart/form-data" action="/admin/product/add/" method="post">
    <span class="centered">
        <fieldset id="admin-products-radios">
            %{ foreach from=$_.categories key=k item=category }%
            <input id="radio%{ $k }%" type="radio" name="category" value="%{ $category.id }%"/>
            <label for="radio%{ $k }%">%{ $category.name }%</label>
            %{ /foreach }%
        </fieldset>
    </span>
    <fieldset id="admin-products-inputs">
        <label for="title-text">Titolo:</label>
        <input id="title-text" type="text" name="title" value=""/>
        <label for="description-text">Descrizione:</label>
        <textarea id="description-text" name="description"></textarea>
        <label for="price-text">Prezzo:</label>
        <input id="price-text" type="text" name="price" value=""/>
        <label for="image-file">Immagine:</label>
        <input id="image-file" type="file" name="file" value=""/>
    </fieldset>
    <div class="right">
        <button id="clear-form" type="reset" name="clear">Pulisci</button>
    </div>
    <div class="centered">
        <div class="admin-actions">
            <a class="link-action" href="/admin/products/">Annulla</a>
            <button class="save-action" type="submit" name="action" value="save">
                <img src="/img/confirm.png"/>Aggiungi
            </button>
        </div>
    </div>
</form>
