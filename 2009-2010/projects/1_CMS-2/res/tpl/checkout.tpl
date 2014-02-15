%{ include file="blocks/header-checkout.tpl" }%
<div class="blog">
    <h2>
        Completa il tuo l'ordine
    </h2>
    <h3>
        Rivedi i dettagli del tuo ordine e forniscici i tuoi dati
    </h3>
    <div id="checkout">
    %{ include file="blocks/checkout-products.tpl" }%
    %{ include file="blocks/checkout-forms.tpl" }%
    </div>
</div>
%{ include file="blocks/footer-admin.tpl" }%