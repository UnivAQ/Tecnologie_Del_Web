<p class="title">
    Dati destinatario
</p>
<form action="/cart/checkout/" method="post">
    <div id="checkout-user-informations">
        <p id="required-fields">
            (<b>*</b>) = Campi obbligatori
        </p>
        <p>
            <label for="name">Nome <b>*</b></label>
            <input id="name-text" type="text" name="name" value="%{ $_.operator.name }%"/>
        </p>
        <p>
            <label for="surname">Cognome <b>*</b></label>
            <input id="surname-text" type="text" name="surname" value="%{ $_.operator.surname }%"/>
        </p>
        <p>
            <label for="address">Indirizzo <b>*</b></label>
            <input id="address-text" type="text" name="address" value="%{ $_.operator.address }%"/>
        </p>
        <p>
            <label for="cap">CAP <b>*</b></label>
            <input id="cap-text" type="text" name="cap" value="%{ $_.operator.cap }%"/>
        </p>
        <p>
            <label for="city">Città <b>*</b></label>
            <input id="city-text" type="text" name="city" value="%{ $_.operator.city }%"/>
        </p>
        <p>
            <label for="province">Provincia <b>*</b></label>
            <input id="province-text" type="text" name="province" value="%{ $_.operator.province }%"/>
        </p>
        <p>
            <label for="state">Stato <b>*</b></label>
            <input id="state-text" type="text" name="state" value="%{ $_.operator.state }%"/>
        </p>
        <p>
            <label for="phone">Telefono</label>
            <input id="state-text" type="text" name="phone" value="%{ $_.operator.telephone }%"/>
        </p>
        <p>
            <label for="notes">Altre informazioni<br/>(Saranno incluse nella lettera di vettura)</label>
            <textarea id="notes-text" name="notes"></textarea>
        </p>
    </div>
    <p class="title">
        Modalità di pagamento
    </p>
    <div id="payment-options">
        <div class="centered">
            <label for="paypal-radio"><img src="/img/paypal.png"/></label>
            <input class="paypal" type="radio" id="paypal-radio" name="payment"/>
            <label for="postepay-radio"><img src="/img/postepay.png"/></label>
            <input class="postepay" type="radio" id="postepay-radio" name="payment"/>
            <label for="visa-radio"><img src="/img/visa.jpg"/></label>
            <input class="visa" type="radio" id="visa-radio" name="payment"/>
            <label for="cash-radio"><img src="/img/contrassegno.jpg"/></label>
            <input class="cash" type="radio" id="cash-radio" name="payment"/>
            <div id ="payment-mask">
            </div>
        </div>
    </div>
    <div class="centered">
        <button id="ship-button" type="submit" name="action" value="ship">
            <img src="/img/ship.png"/>
            <p>
                Invia l'ordine
            </p>
        </button>
    </div>
</form>
<div style="display: none;">
    <div id="paypal-mask">
        <input type="email" name="email" placeholder="Indirizzo eMail"/>
    </div>
    <div id="postepay-mask">
        <input type="input" name="code" placeholder="Codice carta prepagata"/>
        <input type="input" name="vcode" placeholder="Codice di verifica"/>
    </div>
    <div id="visa-mask">
        <input type="input" name="code" placeholder="Codice carta di credito"/>
        <input type="input" name="vcode" placeholder="Codice di verifica"/>
    </div>
    <div id="cash-mask">
        <h5>Al tuo ordine verranno sommati 8€ come costo del servizio di contrassegno.</h5>
    </div>
</div>