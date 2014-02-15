%{ include file="blocks/header.tpl" }%
<p><a id="product-back-home" href="/products/?id=%{ $_.product.category_id }%">&lt; Indietro</a></p>
<div class="product">
    <h2>%{ $_.product.title }%</h2>
    <div class="product_box_foto">
        <a href="%{ $_.product.image }%" title="%{ $_.product.title }%">
            <img class="photo_left" src="%{ $_.product.image }%" title="Visualizza immagine ingrandita" alt="%{ $_.product.title }%"/>
            <div id="photo_zoom" title="Visualizza immagine ingrandita"><span>Zoom</span></div>
        </a>
    </div>
    <div class="product_box_info">
        <p id="product_description"><span>%{ $_.product.description }%</span></p>
        %{ assign var="product" value=$_.product }%
        <div class="ecommerce_bar">
            <span class="buy_it">%{ $product.price }%€</span>
            %{ if isset($_.auth.id) }%
            <span class="price">
                <div id="add-product-button">
                    <form id="buyit-form" method="post" action="/cart/product/add/">
                        <input type="hidden" name="product" value="%{ $product.id }%"/>
                        <input type="text" name="quantity" value="1"/>
                        <button type="submit" name="action" value="add">
                            <img src="/img/add.png"/>
                        </button>
                    </form>
                </div>
            </span>
            %{ /if }%
        </div>
    </div>
    <div class="product_box_attachment"></div>
</div>
%{ include file="blocks/footer.tpl" }%
