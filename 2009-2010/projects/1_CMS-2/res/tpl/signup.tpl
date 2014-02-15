%{ include file="blocks/header-signup.tpl" }%
<style type="text/css">
    div#site_container {
        background:url("/img/bg_site_clear.png") repeat-y scroll left top #FFFFFF;
    }

    div#content {
        width:780px;
    }

    div#footer {
        background: url("/img/bg_footer_clear.jpg") no-repeat scroll center #9CA546;
    }
</style>
<form id="signup-form" action="/signup/" method="post" name="signup">
    <p id="required-fields">
        (<b>*</b>) = Campi obbligatori
    </p>
    <p>
        <label for="name-text">
            Nome <b>*</b>
        </label>
        %{ if isset($_.signup_errors.name) }%
        <input class="signup_error" type="text" id="name-text" name="name"/>
        %{ else }%
        <input type="text" id="name-text" name="name" value="%{ if isset($smarty.post.name) }%%{ $smarty.post.name }%%{ /if }%"/>
        %{ /if }%
    </p>
    <p>
        <label for="surname-text">
            Cognome <b>*</b>
        </label>
        %{ if isset($_.signup_errors.surname) }%
        <input class="signup_error" type="text" id="surname-text" name="surname"/>
        %{ else }%
        <input type="text" id="surname-text" name="surname" value="%{ if isset($smarty.post.surname) }%%{ $smarty.post.surname }%%{ /if }%"/>
        %{ /if }%
    </p>
    <p>
        <label for="username-text">
            Username <b>*</b>
            <br/>(solo lettere e numeri)
        </label>
        %{ if isset($_.signup_errors.username) }%
        <input class="signup_error" type="text" id ="username-text" name="username"/>
        %{ else }%
        <input type="text" id ="username-text" name="username" value="%{ if isset($smarty.post.username) }%%{ $smarty.post.username }%%{ /if }%"/>
        %{ /if }%
    <p class="error">
        %{ if isset($_.signup_errors.username) and $_.signup_errors.username == "invalid_username" }%
        ATTENZIONE: L'username può contenere solo lettere, numeri e trattino basso!
        %{ /if }%
        %{ if isset($_.signup_errors.username) and $_.signup_errors.username == "exist_username" }%
        ATTENZIONE: Username già presente nel sistema
        %{ /if }%
    </p>
</p>
<p>
    <label for="password-text">
        Password <b>*</b>
        <br/>(min. 6 caratteri)
    </label>
    %{ if isset($_.signup_errors.password) }%
    <input class="signup_error" type="password" id="password-text" name="password"/>
    %{ else }%
    <input type="password" id="password-text" name="password"/>
    %{ /if }%
</p>
<p>
    <label for="verify_password-text">
        Ripeti password <b>*</b>
    </label>
    %{ if isset($_.signup_errors.password) }%
    <input class="signup_error" type="password" id="verify_password-text" name="verify_password"/>
<p class="error">
    %{ if isset($_.signup_errors.password) and $_.signup_errors.password == "diff_password" }%
    ATTENZIONE: Le password non corrispondono
    %{ /if }%
    %{ if isset($_.signup_errors.password) and $_.signup_errors.password == "short_password" }%
    ATTENZIONE: La password è troppo breve (minimo 6 caratteri)
    %{ /if }%
</p>
%{ else }%
<input type="password" id="verify_password-text" name="verify_password"/>
%{ /if }%
</p>

<p>
    <label for="email-text">
        E-mail <b>*</b>
    </label>
    %{ if isset($_.signup_errors.email) }%
    <input class="signup_error" type="text" id="email-text" name="email"/>
    %{ else }%
    <input type="text" id="email-text" name="email" value="%{ if isset($smarty.post.email) }%%{ $smarty.post.email }%%{ /if }%"/>
    %{ /if }%
</p>
<p>
    <label for="address-text">
        Indirizzo <b>*</b>
    </label>
    %{ if isset($_.signup_errors.address) }%
    <input class="signup_error" type="text" id="address-text" name="address"/>
    %{ else }%
    <input type="text" id="address-text" name="address" value="%{ if isset($smarty.post.address) }%%{ $smarty.post.address }%%{ /if }%"/>
    %{ /if }%
</p>
<p>
    <label for="cap-text">
        C.A.P. <b>*</b>
    </label>
    %{ if isset($_.signup_errors.cap) }%
    <input class="signup_error" type="text" id="cap-text" name="cap"/>
    %{ else }%
    <input type="text" id="cap-text" name="cap" value="%{ if isset($smarty.post.cap) }%%{ $smarty.post.cap }%%{ /if }%"/>
    %{ /if }%
</p>
<p>
    <label for="city-text">
        Città <b>*</b>
    </label>
    %{ if isset($_.signup_errors.city) }%
    <input class="signup_error" type="text" id="city-text" name="city"/>
    %{ else }%
    <input type="text" id="city-text" name="city" value="%{ if isset($smarty.post.city) }%%{ $smarty.post.city }%%{ /if }%"/>
    %{ /if }%
</p>
<p>
    <label for="province-text">
        Provincia <b>*</b>
    </label>
    %{ if isset($_.signup_errors.province) }%
    <input class="signup_error" type="text" id="province-text" name="province"/>
    %{ else }%
    <input type="text" id="province-text" name="province" value="%{ if isset($smarty.post.province) }%%{ $smarty.post.province }%%{ /if }%"/>
    %{ /if }%
</p>
<p>
    <label for="state-text">
        Stato <b>*</b>
    </label>
    %{ if isset($_.signup_errors.state) }%
    <input class="signup_error" type="text" id="state-text" name="state"/>
    %{ else }%
    <input type="text" id="state-text" name="state" value="%{ if isset($smarty.post.state) }%%{ $smarty.post.state }%%{ /if }%"/>
    %{ /if }%
</p>
<p>
    <label for="phone-text">
        Telefono <b>*</b>
    </label>
    %{ if isset($_.signup_errors.phone) }%
    <input class="signup_error" type="text" id="phone-text" name="phone"/>
    %{ else }%
    <input type="text" id="telephone-text" name="phone" value="%{ if isset($smarty.post.phone) }%%{ $smarty.post.phone }%%{ /if }%"/>
    %{ /if }%
</p>
<div class="centered">
    <button id="signup-button" type="submit" name="signup" value="">
        <img src="/img/add.png"/>
        <p>
            Registrati
        </p>
    </button>
</div>
</form>
%{ include file="blocks/footer-admin.tpl" }%
