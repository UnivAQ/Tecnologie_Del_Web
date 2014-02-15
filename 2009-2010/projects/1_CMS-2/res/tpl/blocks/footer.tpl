         </div>
      </div>
      <div id="box"></div>
      <div id="extra">
        <div id="search">
          <form id="search-box" method="get" action="/search/">
              <input id="search-in" size="20" name="query" type="text" placeholder="Cerca nel sito..."/>
              <button type="submit" name="action" value="search"><img src="/img/search.png"></button>
          </form>
        </div>
        %{ include file="blocks/auth.tpl" }%
        <div id="mini_cart">
            %{ include file="blocks/cart.tpl" }%
        </div>
      </div>
      <div id="footer">
        <a href="http://sofitek.it" title="Web Agency Sofitek.it ">Copyright of Sofitek.it</a>
      </div>
         </div><!-- #sitecontainer -->
    </body>
</html>
