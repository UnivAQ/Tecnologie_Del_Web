%{ include file="blocks/header.tpl" }%
    <div class="info_products">
        <p>%{ $_.products_count }% Articoli</p>
    </div>
    <div class="shelf">
        %{ foreach from=$_.products item=product }%
            <div class="ecommerce">
                <h2><a href="/product/?id=%{ $product.id }%">%{ $product.title }%</a></h2>
                <h3>%{ $product.description|truncate:80 }%</h3>
                <a href="/product/?id=%{ $product.id }%">
                    <span class="photo_left_thumb"><img alt="Description" src="%{ $product.image }%"/></span>
                </a>
                <div class="ecommerce_bar">
                    <input type="hidden" name="product" value="%{ $product.id }%"/>
                    <span class="buy_it"><a href="/product/?id=%{ $product.id }%">Dettagli</a></span>
                    <span class="price">%{ $product.price }%€</span>
                </div>
            </div>
        %{ /foreach }%
    </div>
%{ include file="blocks/footer.tpl" }%
