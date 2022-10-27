<div class="position-fixed {$buttonClassWrap|default:'bottom-0 start-0 m-3'}" style="z-index:{$buttonZindex|default:'99999'};">
	<button type="button" data-bs-toggle="modal" data-bs-target="#modalcontactform" class="{$buttonClass|default:'btn btn-danger btn-lg'}">
		{if $buttonIcon}
			<span class="me-1">
				{$buttonIcon}
			</span>
		{/if}
		{$buttonLabel|default:'Đăng ký'}
	</button>
</div>