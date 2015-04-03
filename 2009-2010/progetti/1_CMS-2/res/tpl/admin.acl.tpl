%{ include file="blocks/header-admin.tpl" }%
<div id="acl-workspace">
    <div class="header">
    </div>
    <div class="body">
        <div id="group-view" class="left-col">
            <table>
                <caption>Gruppi</caption>
                <tbody>
                    %{ foreach from=$_.groups key=k item=group }%
                        %{ include file="blocks/admin-acl-group.tpl" }%
                    %{ /foreach }%
                    <tr>
                        <td>
                            <form class="add-form" action="/admin/group/add/" method="post">
                                <input type="input" name="group" value=""/>
                                <!--<input type="image" name="action" value="save" src="/img/confirm.png"/>-->
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="center-col">
            <h3>Utenti e Gruppi</h3>
            <div class="accordion">
                %{ foreach from=$_.operators item=operator }%
                <div><a href="#o-%{ $operator.uid }%">%{ $operator.uid }%</a></div>
                <div>
                    <label>gruppi:</label>
                    %{ foreach from=$operator.groups key=k item=group }%
                    <form action="/admin/acl/opAndGr/" method="post">
                        <input type="hidden" name="operator_id" value="%{ $operator.id }%"/>
                        <input type="hidden" name="group_id" value="%{ $group.id }%"/>
                        <input type="checkbox" name="status" value="true" %{ if isset($group.checked) }%checked%{ /if }%/>
                               <label>%{ $group.name }%</label>
                    </form>
                    %{ /foreach }%
                </div>
                %{ /foreach }%
            </div>
        </div>
        <div class="right-col">
            <h3>Gruppi e Autorizzazioni</h3>
            <div class="accordion">
                %{ foreach from=$_.groups item=group }%
                <div><a href="#g-%{ $group.name }%">%{ $group.name }%</a></div>
                <div>
                    <label>autorizzazioni:</label>
                    %{ foreach from=$group.capabilities key=k item=capability }%
                    <form action="/admin/acl/grAndCa/" method="post">
                        <input type="hidden" name="group_id" value="%{ $group.id }%"/>
                        <input type="hidden" name="capability_id" value="%{ $capability.id }%"/>
                        <input type="checkbox" name="status" value="true" %{ if isset($capability.checked) }%checked%{ /if }%/>
                               <label>%{ $capability.name }%</label>
                    </form>
                    %{ /foreach }%
                </div>
                %{ /foreach }%
            </div>
        </div>
    </div>
    <div class="footer">
    </div>
</div>
%{ include file="blocks/footer-admin.tpl" }%
