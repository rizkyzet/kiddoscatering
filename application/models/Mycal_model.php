<?php

class Mycal_model extends CI_Model
{

	public $prefs;

	public function __construct()
	{

		//parent::Model();
		$this->prefs = array(
			'start_day'    => 'sunday',
			'month_type'   => 'long',
			'day_type'     => 'short',

		);
		$this->prefs['template'] = '
		{table_open}
		
			{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}{/week_row_start}
        {week_day_cell}{/week_day_cell}
        {week_row_end}{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="">{/cal_cell_start}
        {cal_cell_start_today}<td class="border border-primary ">{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

		{cal_cell_content}
		{day}<br>
		<span class="badge badge-primary font-weight-bold font-italic text-wrap">{content}</span>
		{/cal_cell_content}
		
        {cal_cell_content_today}
        {day}<br>
		<p class="badge badge-primary font-weight-bold font-italic text-wrap">{content}</p>
    	{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}{day}{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}{/table_close}
		';
	}
	public function getcalendarReg($year, $month)
	{
		$this->load->library('calendar', $this->prefs); // Load calendar library
		// $data = array(
		//       3  => 'check',
		//       7  => 'check1',
		//       13 => 'bar',
		//       26 => 'ytr'
		// );

		return $this->calendar->generate($year, $month);
	}
	public function getcalendar($year, $month, $no_pemesanan)
	{
		$this->load->library('calendar', $this->prefs); // Load calendar library
		// $data = array(
		//       3  => 'check',
		//       7  => 'check1',
		//       13 => 'bar',
		//       26 => 'ytr'
		// );
		$data = $this->get_calendar_data($year, $month, $no_pemesanan);
		return $this->calendar->generate($year, $month, $data);
	}

	public function get_calendar_data($year, $month, $no_pemesanan)
	{
		$query =  $this->db->select('tgl_detail,pesan')->from('detail_pemesanan')->like('tgl_detail', "$year-$month", 'after')->where('no_pemesanan', $no_pemesanan)->get();
		//echo $this->db->last_query();exit;
		$cal_data = array();
		foreach ($query->result() as $row) {
			$calendar_date = date("Y-m-j", strtotime($row->tgl_detail)); // to remove leading zero from day format
			if ($row->pesan == "ps") {
				$pesan = 'pagi dan siang';
			} elseif ($row->pesan == "p") {
				// $pesan = "
				// <img src='" . base_url('assets/upload/menu_makanan/ayam_goreng_serundeng.jpg') . "' alt='}' class='img-thumbnail'>

				// <a class='badge badge-primary ' href='" . $row->pesan . "'>Edit</a>";
				$pesan = 'pagi';
			} else {
				$pesan = 'siang';
			}
			$cal_data[substr($calendar_date, 8, 2)] = $pesan;
		}

		return $cal_data;
	}

	public function getCalendarPemesanan($year, $month, $type, $no_pemesanan = null)
	{

		$prefs = array(
			'start_day'    => 'sunday',
			'month_type'   => 'long',
			'day_type'     => 'short',

		);

		$prefs['template'] = '
		{table_open}
		
			{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}{/week_row_start}
        {week_day_cell}{/week_day_cell}
        {week_row_end}{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="border ">{/cal_cell_start}
        {cal_cell_start_today}<td class="border">{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

		{cal_cell_content}
		{day}<br>
		{content}
		{/cal_cell_content}
		
        {cal_cell_content_today}
        {day}<br>
		{content}
    	{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}{day}{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}{/table_close}
		';
		if ($type == 'tampil') {
			$data = $this->Mycal_model->getCalendarDataTampilPemesanan($year, $month, $no_pemesanan);
		} elseif ($type == 'edit') {
			$data = $this->Mycal_model->getCalendarDataEditPemesanan($year, $month, $no_pemesanan);
		}

		$this->load->library('calendar', $prefs); // Load calendar library
		// $data = array(
		//       3  => 'check',
		//       7  => 'check1',
		//       13 => 'bar',
		//       26 => 'ytr'
		// );

		return $this->calendar->generate($year, $month, $data);
	}

	public function getCalendarDataEditPemesanan($year, $month, $no_pemesanan)
	{
		$this->load->helper('date');
		$tanggal_awal = "$year-$month-01";
		$tanggal_akhir = date('Y-m-t', strtotime($tanggal_awal));
		$range = date_range($tanggal_awal, $tanggal_akhir);

		foreach ($range as $rng) {
			$calendar_date = date("Y-m-j", strtotime($rng)); // to remove leading zero from day format

			$detail_data = $this->db->get_where('detail_pemesanan', ['no_pemesanan' => $no_pemesanan, 'tgl_detail' => $rng])->row_array();

			if (empty($detail_data)) {
				$data = '';
			} else {

				$data_pesanan = ['id' => $detail_data['id'], 'pesan' => $detail_data['pesan']];
				$pesanan = json_encode($data_pesanan);
				$selected_siang = $detail_data['pesan'] == 's' ? 'selected' : '';
				$selected_pagi = $detail_data['pesan'] == 'p' ? 'selected' : '';
				$selected_dobel = $detail_data['pesan'] == 'ps' ? 'selected' : '';

				if ($detail_data['pesan'] == 'ps') {
					$data = '   <select disabled name="' . $detail_data['tgl_detail'] . '"  id="' . $detail_data['id'] . '" class="form-control comboEditPemesanan" data-tanggal="' . $detail_data['tgl_detail'] . '" data-no_pemesanan="' . $no_pemesanan . '">
					
					<option value="ps" ' . $selected_dobel . '>Dobel</option>
					
					</select>';
				} else {
					// jika tgl pesanan kurang dari tanggal sekarang
					if (strtotime($detail_data['tgl_detail']) <= strtotime(date('Y-m-d '))) {
						// jika jam sekarang lebih dari jam 8
						if (time() > strtotime('08:00:00')) {

							$disabled = 'disabled';
						} else {
							$disabled = '';
						}
					} else {
						$disabled = '';
					}
					$data = '   <select ' . $disabled . ' name="' . $detail_data['tgl_detail'] . '"  id="' . $detail_data['id'] . '" class="form-control comboEditPemesanan" data-tanggal="' . $detail_data['tgl_detail'] . '" data-no_pemesanan="' . $no_pemesanan . '">
	<option value="p" ' . $selected_pagi . '>Pagi</option> 
	<option value="s" ' . $selected_siang . '>Siang</option>
	<option value="ps" disabled ' . $selected_dobel . '>Dobel</option>
	
	</select>';
				}
			}

			$cal_data[substr($calendar_date, 8, 2)] = $data;
		}
		return $cal_data;
	}

	public function getCalendarJadwal($year, $month, $type, $id_jadwal = null)
	{

		$prefs = array(
			'start_day'    => 'sunday',
			'month_type'   => 'long',
			'day_type'     => 'short',

		);

		$prefs['template'] = '
		{table_open}
		
			{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}{/week_row_start}
        {week_day_cell}{/week_day_cell}
        {week_row_end}{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="border ">{/cal_cell_start}
        {cal_cell_start_today}<td class="border">{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

		{cal_cell_content}
		{day}<br>
		{content}
		{/cal_cell_content}
		
        {cal_cell_content_today}
        {day}<br>
		{content}
    	{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}{day}{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}{/table_close}
		';
		if ($type == 'buat') {
			$data = $this->getCalendarDataBuatJadwal($year, $month);
		} elseif ($type == 'tampil') {
			$data = $this->getCalendarDataTampilJadwal($year, $month, $id_jadwal);
		} elseif ($type == 'edit') {
			$data = $this->getCalendarDataEditJadwal($year, $month, $id_jadwal);
		}

		$this->load->library('calendar', $prefs); // Load calendar library
		// $data = array(
		//       3  => 'check',
		//       7  => 'check1',
		//       13 => 'bar',
		//       26 => 'ytr'
		// );

		return $this->calendar->generate($year, $month, $data);
	}


	public function getCalendarDataBuatJadwal($year, $month)
	{
		$this->load->helper('date');
		$tanggal_awal = "$year-$month-01";
		$tanggal_akhir = date('Y-m-t', strtotime($tanggal_awal));
		$range = date_range($tanggal_awal, $tanggal_akhir);

		foreach ($range as $rng) {
			$calendar_date = date("Y-m-j", strtotime($rng)); // to remove leading zero from day format
			if (date('D', strtotime($rng)) == 'Sat' || date('D', strtotime($rng)) == 'Sun') {
				$data = '';
			} else {

				$json_tanggal = json_encode(['tanggal' => $rng, 'id_makanan' => '0']);
				$data = "
				<a href='#' class='buat_jadwal btn btn-light mb-3 " . $rng . "'  data-toggle='modal' data-target='#modal_buat_jadwal' data-tanggal='" . $rng . "'>
				<img src='" . base_url('assets/upload/menu_makanan/no_image.jpg') . "'  class='img-thumbnail " . $rng . "'>
				</a>
				<input class='input" . $rng . "' name='" . $rng . "' type='hidden' value='" . $json_tanggal . "'>
				";
			}

			$cal_data[substr($calendar_date, 8, 2)] = $data;
		}



		return $cal_data;
	}


	public function getCalendarDataTampilJadwal($year, $month, $id_jadwal)
	{

		$this->load->helper('date');
		$tanggal_awal = "$year-$month-01";
		$tanggal_akhir = date('Y-m-t', strtotime($tanggal_awal));
		$range = date_range($tanggal_awal, $tanggal_akhir);

		foreach ($range as $rng) {
			$calendar_date = date("Y-m-j", strtotime($rng)); // to remove leading zero from day format

			$this->db->select('detail_jadwal.*,menu_makanan.nama_makanan,menu_makanan.image_makanan');
			$this->db->from('detail_jadwal');
			$this->db->join('menu_makanan', 'menu_makanan.id_makanan=detail_jadwal.id_makanan', 'left');
			$this->db->where(['detail_jadwal.id_jadwal' => $id_jadwal]);
			$this->db->where(['detail_jadwal.tanggal_jadwal' => $rng]);
			$jadwal = $this->db->get()->row_array();

			if (empty($jadwal)) {
				$data = '';
			} else {
				if ($jadwal['image_makanan'] == null) {
					$image_makanan = 'no_image.jpg';
					$nama_makanan = 'Menu Belum Ditentukan';
				} else {
					$image_makanan = $jadwal['image_makanan'];
					$nama_makanan = $jadwal['nama_makanan'];
				}
				$data = '<img src="' . base_url('assets/upload/menu_makanan/' . $image_makanan) . '" class="img-thumbnail " data-toggle="tooltip" data-placement="bottom" title="' . $nama_makanan . '"> ';
			}

			$cal_data[substr($calendar_date, 8, 2)] = $data;
		}
		return $cal_data;
	}


	public function getCalendarDataEditJadwal($year, $month, $id_jadwal)
	{

		$this->load->helper('date');
		$tanggal_awal = "$year-$month-01";
		$tanggal_akhir = date('Y-m-t', strtotime($tanggal_awal));
		$range = date_range($tanggal_awal, $tanggal_akhir);

		foreach ($range as $rng) {
			$calendar_date = date("Y-m-j", strtotime($rng)); // to remove leading zero from day format

			$this->db->select('detail_jadwal.*,menu_makanan.nama_makanan,menu_makanan.image_makanan');
			$this->db->from('detail_jadwal');
			$this->db->join('menu_makanan', 'menu_makanan.id_makanan=detail_jadwal.id_makanan', 'left');
			$this->db->where(['detail_jadwal.id_jadwal' => $id_jadwal]);
			$this->db->where(['detail_jadwal.tanggal_jadwal' => $rng]);
			$jadwal = $this->db->get()->row_array();

			if (empty($jadwal)) {
				$data = '';
			} else {
				if ($jadwal['image_makanan'] == null) {
					$image_makanan = 'no_image.jpg';
					$nama_makanan = 'Menu Belum Ditentukan';
					$id_makanan = $jadwal['id_makanan'];
					$data_value = json_encode(['id_jadwal' => $jadwal['id_detail_jadwal'], 'tanggal' => $jadwal['tanggal_jadwal'], 'id_makanan' => $jadwal['id_makanan']]);
					$value = $data_value;
				} else {
					$image_makanan = $jadwal['image_makanan'];
					$nama_makanan = $jadwal['nama_makanan'];
					$id_makanan = $jadwal['id_makanan'];
					$data_value = json_encode(['id_jadwal' => $jadwal['id_detail_jadwal'], 'tanggal' => $jadwal['tanggal_jadwal'], 'id_makanan' => $jadwal['id_makanan']]);
					$value = $data_value;
				}
				$data = '
				<a href="#" class="btn btn-light mb-3 gambar_edit_jadwal ' . $jadwal['id_detail_jadwal'] . '" id="' . $jadwal['id_detail_jadwal'] . '" data-tanggal="' . $jadwal['tanggal_jadwal'] . '" data-toggle="modal" data-target="#modal_edit_jadwal">
				<img src="' . base_url('assets/upload/menu_makanan/' . $image_makanan) . '" class="img-thumbnail " data-toggle="tooltip" data-placement="bottom" title="' . $nama_makanan . '"> 
				</a>
				';
			}

			$cal_data[substr($calendar_date, 8, 2)] = $data;
		}
		return $cal_data;
	}
}
