%{ if isset($_.auth.id) }%
<div id="mini_shopping_cart">
    <h4>Carrello</h4>
    %{ if $_.cart_products_count == 0 }%
    <h5>Carrello vuoto...</h5>
    %{ else }%
    %{ if $_.cart_products_count == 1 }%
    <h5 onclick="$('#mini-cart-content').slideToggle()" style="cursor: pointer;">
        Hai %{ $_.cart_products_count }% articolo...
    </h5>
    %{ else }%
    <h5 onclick="$('#mini-cart-content').slideToggle()" style="cursor: pointer;">
        Hai %{ $_.cart_products_count }% articoli...
    </h5>
    %{ /if }%
    %{ /if }%
    <div id="mini-cart-content">
        <ul>
            %{ foreach from=$_.cart item=product }%
            <li>
                <a href="/product/?id=%{ $product.id }%"><i>%{ $product.title }%</i></a>
            </li>
            <div id="cart_products_quantity">
                <form method="post" action="/cart/product/dec/">
                    <input type="hidden" name="product" value="%{ $product.id }%"/>
                    <button type="submit" name="action" value="decr">-</button>
                </form>
                <form method="post" action="/cart/product/set/">
                    <input type="hidden" name="product" value="%{ $product.id }%"/>
                    <input type="text" name="quantity" value="%{ $product.num }%"/>
                </form>
                <form method="post" action="/cart/product/inc/">
                    <input type="hidden" name="product" value="%{ $product.id }%"/>
                    <button type="submit" name="action" value="add">+</button>
                </form>
                x %{ $product.price }%€ = <b> %{ math equation="price * num" price=$product.price num=$product.num }%€ </b>
            </div>
            %{ /foreach }%
        </ul>
    </div>
</div>
<h4 class="total">Totale <em>%{ $_.cart_total }%€</em></h4>
<div id="cart_actions">
    %{ if $_.cart_products_count != 0 }%
    <a id="reset-action" href="/cart/reset/">Svuota</a>
    <a href="/cart/checkout/"><img src="/img/cart2.png"/></a>
    %{ /if }%
</div>
%{ /if }%
