$(document).ready(function () {
	$('.select-kelas').change(function () {
		const id_kelas = $(this).val()
		$.ajax({
			url: 'http://localhost/kiddoscatering/pesanan/get_table_pesanan',
			data: {
				id_kelas: id_kelas
			},
			method: 'post',
			success: function (data) {
				console.log(data)
				$('.div-pesanan').html(data);
			}

		})
	})

})
