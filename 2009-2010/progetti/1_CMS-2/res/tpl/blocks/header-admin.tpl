<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" dir="ltr">
    <head>
        <title>AgroFarm - Admin</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="language" content="italian"/>
        <meta name="content-language" content="it"/>
        <link rel="shortcut icon" href="/img/favico.ico" type="image/x-icon"/>
        <link type="text/css" rel="stylesheet" media="all" href="/css/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="/css/style-admin.css"/>
        <script type="text/javascript" src="/js/jquery.js"> </script>
        <script type="text/javascript" src="/js/jquery-ui.js"> </script>
        <script type="text/javascript" src="/js/jquery.form.js"> </script>
        <script type="text/javascript" src="/js/core-admin.js"> </script>
    </head>
    <body>
        <div id="back"></div>
        <div id="site_container">
            %{ include file="blocks/navigation.tpl" }%
            <div class="reparti">
                <h4 id="id_26">Amministrazione</h4>
                <div id="section-menu">
                    <ul>
                        <li><a href="/admin/products/">Prodotti</a></li>
                        <li><a href="/admin/categories/">Categorie</a></li>
                        <li><a href="/admin/acl/">Autorizazioni</a></li>
                    </ul>
                    <form action="/?signout" method="get">
                        <button id="signout-button" type="submit" name="signout" value="" title="Esci">
                            <img src="/img/logout.png"/>
                            <p>Logout</p>
                        </button>
                    </form>
                </div>
            </div>
            <div id="wrapper">
                <div id="content">