%{ include file="blocks/header.tpl" }%
<div class="blog">
    <h2>
        Prodotti tipici abruzzesi!
    </h2>
    <h3>
        da Antichi Sapori tutto il gusto dell'abruzzo!
    </h3>
    <div class="content_text">
        <p>
            <img height="168" width="523" alt="Prodotti tipici abruzzesi" src="/img/postprodotti.jpg" />
        </p>
        <p>
            Gentile visitatore, benvenuto nel nostro negozio, <strong>Antichi Sapori</strong>.
        </p>
        <p>
            Siamo specializzati nella vendita al dettaglio di <strong>prodotti tipici abruzzesi</strong>, in particolare proponiamo
            %{ foreach name=home_products from=$_.categories item=cat }%
            %{ if $smarty.foreach.home_products.last }% e <em><a href="/products/?id=%{ $cat.id }%">%{ $cat.name }%</a></em>.
            %{ else }%<em><a href="/products/?id=%{ $cat.id }%">%{ $cat.name }%</a></em>,
            %{ /if }%
            %{ /foreach }%
        </p>
        <p>
            La nostra attività ha ormai 10 anni e la presenza "online" non rappresenta una novità, infatti già nel 2001 avevamo fatto da apripista nella <strong>vendita di prodotti
                tipici</strong> proprio con questo dominio, <em>saporidabruzzo.com</em>.&nbsp;
        </p>
        <p>
            Oggi abbiamo deciso di rinnovare quell'esperienza dotandoci di un <strong>nuovo sistema di e-commerce</strong> che vi consente di lasciare commenti ai <strong>singoli
                prodotti</strong>, fornire spunti agli altri acquirenti e sopratutto fornirci un prezioso "feedback" sulla <strong>qualità del prodotto</strong> che proponiamo. Inoltre potete anche
            avere il <a href="#"><strong>feed rss</strong></a> di questo blog e di tutto il <a href="#">listino</a>.<b><br /></b>
        </p>
        <p>
            Per qualunque dubbio, domanda, curiosità non esitate comunque a <a href="#">contattarci</a>
        </p>
    </div>
    <div class="end_post"></div>
</div>
<div>
    <div class="page_number"></div>
</div>
%{ include file="blocks/footer.tpl" }%
