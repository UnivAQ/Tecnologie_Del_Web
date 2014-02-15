<p class="title">
    Prodotti nel carrello
</p>
<div id="checkout-products-summary">
    <table id="checkout-grid">
        <tr>
            <th class="checkout-title">Nome prodotto</th>
            <th class="checkout-quantity">Quantità</th>
            <th class="checkout-price">Prezzo unitario</th>
            <th class="checkout-total">Prezzo totale</th>
        </tr>
        %{ foreach from=$_.cart item=product }%
        <tr>
            <td class="checkout-title">%{ $product.title }%</td>
            <td class="checkout-quantity">%{ $product.num }%</td>
            <td class="checkout-price">%{ $product.price }%€</td>
            <td class="checkout-total">%{ math equation="price * num" price=$product.price num=$product.num }%€</td>
        </tr>
        %{ /foreach }%
        <tr>
            <td></td>
            <td></td>
            <td>
                <h4>
                    Totale:
                </h4>
            </td>
            <td>
                <h4>
                    %{ $_.cart_total }%€
                </h4>
            </td>
        </tr>
    </table>
    <p id="reminder-back-home">
        Dimenticato qualcosa? <a href="/">Continua l'acquisto!</a>
    </p>
</div>