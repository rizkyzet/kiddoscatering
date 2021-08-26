$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('.img-preview').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]); // convert to base64 string
	}
}

$('.custom-file-input').on('change', function () {
	let fileName = $(this).val().split('\\').pop();
	$(this).next('.custom-file-label').addClass("selected").html(fileName);
	readURL(this);
})

$('.image').on('change', function () {
	console.log('ok');
	readURL(this);
})


// $('#combo_sekolah').on('click', function () {
//     console.log('ok');
// })

$('#pay-button2').click(function (event) {

	event.preventDefault();
	console.log($(this).data());

	const tgl_mulai = $(this).data('mulai');
	const total_byr = $(this).data('total_byr');
	const no_psn = $(this).data('no_psn');

	$.ajax({
		url: 'http://localhost/kiddoscatering/pelanggan/pemesanan/token',
		cache: false,
		data: {
			tanggal_mulai: tgl_mulai,
			total_byr: total_byr,
			no_psn: no_psn,
		},
		method: 'post',
		success: function (data) {

			function changeResult(type, data) {

				$("#result-type").val(type);
				$("#result-data").val(JSON.stringify(data));

			}

			snap.pay(data, {

				onSuccess: function (result) {
					changeResult('success', result);
					console.log(result.status_message);
					console.log(result);
					$("#payment-form").submit();

				},
				onPending: function (result) {
					changeResult('pending', result);
					console.log(result.status_message);
					console.log(result);
					$("#payment-form").submit();
				},
				onError: function (result) {
					changeResult('error', result);
					console.log(result.status_message);

				},
				onClose: function () {
					console.log('customer closed the popup without finishing the payment');
				}
			});
		}
	});
});


$('.lihat_pesanan').click(function () {
	console.log('oke');
	const no_pemesanan = $(this).data('no_pemesanan');
	console.log(no_pemesanan);

	$.ajax({
		url: 'http://localhost/kiddoscatering/pelanggan/pesanan/lihat_pesanan',
		data: {
			no_pemesanan: no_pemesanan
		},
		method: 'post',

		success: function (data) {
			console.log(data);
			$('.getCalendar').html(data);

		}
	})
})


$('.buat_jadwal').on('click', function () {

	var tanggal = $(this).data('tanggal');




	$.ajax({
		url: 'http://localhost/kiddoscatering/admin/jadwal_menu/get_data_menu',
		data: {
			tanggal: tanggal
		},
		method: 'post',
		success: function (data) {
			console.log(data);
			$('.gutters-sm').html(data);
			$('.check').on('click', function () {
				const tanggal = $('.check').attr('name');
				const id_makanan = $(this).val();
				const img = $(this).data('img_makanan');
				console.log(tanggal);
				console.log(id_makanan);

				var data = {
					tanggal: tanggal,
					id_makanan: id_makanan
				};

				$("input[name=" + tanggal + "]").val(JSON.stringify(data));
				$('img.' + tanggal).attr('src', img);

				$('#modal_buat_jadwal').modal('hide')
			})
		}


	})
	// })

})


$('.gambar_edit_jadwal').on('click', function () {
	var id_detail_jadwal = $(this).attr('id');
	var tanggal = $(this).data('tanggal');

	$("input[name='id_detail_jadwal']").val(id_detail_jadwal);
	$("input[name='tanggal']").val(tanggal);

	$('.check-edit').on('click', function () {
		console.log('ok');
		$("#form_edit_jadwal").submit();
	})
})

$('.comboEditPemesanan').on('change', function () {
	tanggal = $(this).data('tanggal');
	id = $(this).attr('id');
	pesanan = $(this).val();
	no_pemesanan = $(this).data('no_pemesanan');

	$.ajax({
		url: 'http://localhost/kiddoscatering/pelanggan/pemesanan/save_edit_pemesanan',
		data: {
			tanggal: tanggal,
			id: id,
			pesanan: pesanan
		},
		method: 'post',
		success: function (data) {
			document.location.href = 'http://localhost/kiddoscatering/pelanggan/pemesanan/edit/' + no_pemesanan
		}
	})

})

$('#kelas').add('#tahun').add('#bulan').on('change', function () {
	const id_kelas = $('#kelas').val();
	const bulan = $('#bulan').val();
	const tahun = $('#tahun').val();
	console.log(bulan);
	console.log(id_kelas);
	console.log(tahun);

	$.ajax({
		url: 'http://localhost/kiddoscatering/admin/laporan/ajax_lap_pemesanan',
		data: {
			id_kelas: id_kelas,
			bulan: bulan,
			tahun: tahun
		},
		method: 'post',
		success: function (data) {
			$('.table_pesanan').html(data);
		}

	})

})

$('.check-tidak-suka').on('click', function () {
	const id_makanan = $(this).val();
	const nama_makanan = $(this).data('nama-makanan');
	const img = $(this).data('img_makanan');
	$("input[name='id_menu_tidak_suka']").val(id_makanan);
	$("input[name='menu_tidak_suka']").val(nama_makanan);
	$('.image-tidak-suka').attr('src', img);
	$('#modal_tidak_suka').modal('hide')
})

$('.check-pengganti').on('click', function () {
	const id_pengganti = $(this).val();
	const nama_pengganti = $(this).data('nama-makanan');
	const img = $(this).data('img_makanan');
	$("input[name='id_menu_pengganti']").val(id_pengganti);
	$("input[name='menu_pengganti']").val(nama_pengganti);
	$('.image-pengganti').attr('src', img);
	$('#modal_pengganti').modal('hide')
})

$("input[name='menu_pengganti']").on('click', function (event) {

	$('#modal_pengganti').modal('show')
	$(this).val('');
})

$("input[name='menu_tidak_suka']").on('click', function (event) {

	$('#modal_tidak_suka').modal('show')
	$(this).val('');
})

$(document).ready(function () {
	$('.tanggal-pengiriman').on('change', function (e) {
		const tanggal = $(this).val();
		const id_sekolah = $(this).data('id_sekolah');

		function isJson(str) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
		}

		$.ajax({
			url: 'http://localhost/kiddoscatering/admin/pengiriman/get_table_pengiriman',
			data: {
				tanggal: tanggal,
				id_sekolah: id_sekolah,

			},
			method: 'post',
			success: function (data) {

				if (isJson(data)) {
					const result = JSON.parse(data)
					console.log(result.status)
					$('.div-pengiriman').html(result.htmlEl);
					$('#btn-print').prop('disabled', true);
				} else {
					$('.div-pengiriman').html(data);
					$('#btn-print').prop('disabled', false);
				}

			}
		})
	})
});


$(document).ready(function () {
	$('#tanggal_awal').on('change', function () {
		var tanggal_awal = $(this).val();
		var tanggal_akhir = $('#tanggal_akhir').val();

		$.ajax({
			url: 'http://localhost/kiddoscatering/admin/laporan/get_table_pendapatan',
			data: {
				tanggal_awal: tanggal_awal,
				tanggal_akhir: tanggal_akhir
			},
			method: 'post',
			success: function (data) {
				$('.laporan_pendapatan').html(data);
			}

		})

	})

})

$(document).ready(function () {
	$('#tanggal_akhir').on('change', function () {
		var tanggal_awal = $('#tanggal_awal').val();
		var tanggal_akhir = $(this).val();

		$.ajax({
			url: 'http://localhost/kiddoscatering/admin/laporan/get_table_pendapatan',
			data: {
				tanggal_awal: tanggal_awal,
				tanggal_akhir: tanggal_akhir
			},
			method: 'post',
			success: function (data) {
				$('.laporan_pendapatan').html(data);
			}

		})
	})
})



$(document).ready(function () {
	$('.datatables').dataTable({
		"language": {
			"sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
			"sProcessing": "Sedang memproses...",
			"sLengthMenu": "Tampilkan _MENU_ entri",
			"sZeroRecords": "Tidak ditemukan data yang sesuai",
			"sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			"sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
			"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
			"sInfoPostFix": "",
			"sSearch": "Cari:",
			"sUrl": "",
			"oPaginate": {
				"sFirst": "Pertama",
				"sPrevious": "Sebelumnya",
				"sNext": "Selanjutnya",
				"sLast": "Terakhir"
			}
		}
	});


});


$(document).ready(function () {

	$(".alert-success").fadeTo(2000, 500).slideUp(500, function () {
		$(".alert-success").slideUp(500);
	});

});


$(document).ready(function () {
	$('.tombol-bayar-harian').on('click', function (e) {
		e.preventDefault();
		const nis = $('input[name="nis"]').val();
		const tanggalPesan = $('input[name="tanggal_pesan"').val();
		const waktuPesan = $('input[name="waktu_pesan"]').val();

		$.ajax({
			url: 'http://localhost/kiddoscatering/pelanggan/pemesanan/token_harian',
			data: {
				nis: nis,
				tanggal_pesan: tanggalPesan,
				waktu_pesan: waktuPesan
			},
			method: 'POST',
			success: function (data) {

				function changeResult(type, data) {

					$("#result-type").val(type);
					$("#result-data").val(JSON.stringify(data));

				}

				snap.pay(data, {

					onSuccess: function (result) {
						changeResult('success', result);
						console.log(result.status_message);
						console.log(result);
						$("#form-payment-harian").submit();

					},
					onPending: function (result) {
						changeResult('pending', result);
						console.log(result.status_message);
						console.log(result);
						$("#form-payment-harian").submit();
					},
					onError: function (result) {
						changeResult('error', result);
						console.log(result.status_message);

					},
					onClose: function () {
						console.log('customer closed the popup without finishing the payment');
					}
				});

			}
		})
	})
});



// window.setTimeout("waktu()", 1000);

// function waktu() {
//     var waktu = new Date();
//     setTimeout("waktu()", 1000);
//     document.getElementById("jam").innerHTML = waktu.getHours();
//     document.getElementById("menit").innerHTML = waktu.getMinutes();
//     document.getElementById("detik").innerHTML = waktu.getSeconds();
// }
