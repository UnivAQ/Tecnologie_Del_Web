<div id="authentication-form">
    %{ if ! isset($_.auth.id) }%
    <div id="signin-box">
        <form method="post" action="/signin/">
            <label for="text-username">Username:</label>
            <input id="text-username" type="text" name="uid" value=""/>
            <label for="text-password">Password:</label>
            <input id="text-password" type="password" name="pass" value=""/>
            <a href="/signup/">Registrati</a>
            <button id="signin-button" type="submit" name="signin" value="" title="Entra">
                <img src="/img/login.png"/>
                <p>Login</p>
            </button>
        </form>
    </div>
    %{ else }%
    <div id="welcome">
        Benvenuto <b>%{ $_.auth.uid }%</b>.
    </div>
    <div id="signout-box">
        <form action="/?signout" method="get">
            <button id="signout-button" type="submit" name="signout" value="" title="Esci">
                <img src="/img/logout.png"/>
                <p>Logout</p>
            </button>
        </form>
    </div>
    %{ /if }%
</div>
