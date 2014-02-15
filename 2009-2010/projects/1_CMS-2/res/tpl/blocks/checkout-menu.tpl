    <div class="reparti">
        <h4 id="id_26">
          Checkout
        </h4>
        <ul>
            %{ foreach from=$_.categories item=cat }%
            <li><a href="/products/?id=%{ $cat.id }%">%{ $cat.name }%</a></li>
            %{ /foreach }%
        </ul>
    </div>