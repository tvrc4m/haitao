<div class="new_box" style="width:<{$de.width}>px;height:<{$de.height}>px">
	<div class="new_box_title"><{$de.title}></div>
	<div class="new_con">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <{foreach item=list from=$de.list}>
      <tr>
        <td class="new_title"><a href="<{$list.url}>"><{$list.ftitle}></a></td>
        <td class="new_time"><{$list.uptime|date_format}></td>
      </tr>
      <{/foreach}>
    </table>
    </div>
</div>