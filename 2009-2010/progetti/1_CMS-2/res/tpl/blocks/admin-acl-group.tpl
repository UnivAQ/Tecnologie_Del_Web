%{ if isset($_.group) }%
    %{ assign var="group" value=$_.group }%
%{ /if }%
<tr>
    <td class="hoverable">
        <form class="ren-form" action="/admin/group/set/" method="post">
            <input type="hidden" name="group_id" value="%{ $group.id }%"/>
            <!--<input type="input" name="group" value="%{ $group.name }%"/>-->
            <span class="active-text">%{ $group.name }%</span>
        </form>
        <form class="del-form" action="/admin/group/del/" method="post">
            <input type="hidden" name="group_id" value="%{ $group.id }%"/>
            <input class="hidden" type="image" src="/img/delete.png"/>
        </form>
    </td>
</tr>
