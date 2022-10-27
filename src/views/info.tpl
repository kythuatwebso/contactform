{if $data}
	<table border="1" cellpadding="5" cellspacing="0">
		<tr>
			{foreach from=$data item=i key=th}
				<td>
					{$th|arraybien}
				</td>
			{/foreach}
		</tr>

		<tr>
			{foreach from=$data item=td}
				<td>{$td}</td>
			{/foreach}
		</tr>
	</table>
{/if}