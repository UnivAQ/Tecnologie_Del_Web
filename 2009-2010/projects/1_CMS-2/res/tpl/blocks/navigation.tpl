<div id="header">
    <div class="navigation">
        <ul>
            <li><a title="Home" href="/">Home</a></li>
            <li><a title="Chi siamo" href="/about/">Chi siamo</a></li>
             %{ if $_.auth.isadmin }%
            <li>
                <a title="Admin" href="/admin/products/">
                    <img class="admin" src="/img/admin.png"/>
                    Administration
                </a>
            </li>
            %{ /if }%
        </ul>
    </div>
</div>
