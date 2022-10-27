{include file="./style.tpl"}

	<div class="contact-form modal fade" id="modalcontactform">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

			<div class="modal-content">
				<form action="{$action|default:''}" method="{$method|default:'POST'}">
					<div class="header d-flex p-3">
						<strong>{'Đăng ký ứng tuyển nhanh'|arraybien}</strong>
						<span class="ms-auto" role="button" data-bs-dismiss="modal">
							<i class="fa fa-times"></i>
						</span>
					</div>
					<div class="body p-3">

						{if $description|filled}
							<div class="pb-3 description">
								{$description}
							</div>
						{/if}

						<div class="pb-3">
							<input type="text" name="hoten" class="form-control-lg form-control"
								placeholder="{'Họ và tên'|arraybien}" required />
						</div>
						<div class="pb-3">
							<input type="tel" name="sodienthoai" class="form-control-lg form-control"
								placeholder="{'Số điện thoại'|arraybien}" required />
						</div>
						<div>
							<button type="submit" class="btn btn-warning w-100 text-white btn-lg">
								{'Đăng ký'|arraybien}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	{if $withButton == true}
		{include file="./btnBottom.tpl"}
	{/if}

	{if $isShow}
		{literal}
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					// Inline scripts go here

					setTimeout(function () {
						if (typeof $('#modalcontactform')[0] == 'object') {
							$('#modalcontactform').modal('show');
						}
					}, 800);

					$('form').on('submit', function () {
						var nut_dangky = jQuery(this).find('[type=submit]');

						var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> loading...';

						if (nut_dangky.html() !== loadingText) {
							nut_dangky.addClass('disabled');
							nut_dangky.attr('readonly', 'readonly');
							nut_dangky.data('original-text', nut_dangky.html());
							nut_dangky.html(loadingText);
						}

						setTimeout(function() {
							nut_dangky.html(nut_dangky.data('original-text'));
							nut_dangky.removeClass('disabled');
						}, 20000);
					});

				});
			</script>
		{/literal}
	{/if}