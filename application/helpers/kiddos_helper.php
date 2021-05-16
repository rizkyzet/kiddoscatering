<?php
function thousandsCurrencyFormat($num)
{

    if ($num > 1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }

    return $num;
}

function getDayIndoFull($namahari)
{
    $hari = $namahari;

    switch ($hari) {
        case 'Sun':
            $hari_ini = "minggu";

            break;

        case 'Mon':
            $hari_ini = "senin";

            break;

        case 'Tue':
            $hari_ini = "selasa";

            break;

        case 'Wed':
            $hari_ini = "rabu";

            break;

        case 'Thu':
            $hari_ini = "kamis";

            break;

        case 'Fri':
            $hari_ini = "jumat";

            break;

        case 'Sat':
            $hari_ini = "sabtu";

            break;

        default:
            $hari_ini = "Tidak di ketahui";

            break;
    }

    return $hari_ini;
}

function getDayIndo($namahari)
{
    $hari = $namahari;

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Min";

            break;

        case 'Mon':
            $hari_ini = "Sen";

            break;

        case 'Tue':
            $hari_ini = "Sel";

            break;

        case 'Wed':
            $hari_ini = "Rab";

            break;

        case 'Thu':
            $hari_ini = "Kam";

            break;

        case 'Fri':
            $hari_ini = "Jum";

            break;

        case 'Sat':
            $hari_ini = "Sab";

            break;

        default:
            $hari_ini = "Tidak di ketahui";

            break;
    }

    return $hari_ini;
}

function getNamaBulanFromNumber($bulan)
{


    switch ($bulan) {
        case '01':
            $nama_bulan = "Januari";

            break;

        case '02':
            $nama_bulan = "Februari";

            break;

        case '03':
            $nama_bulan = "Maret";

            break;

        case '04':
            $nama_bulan = "April";

            break;

        case '05':
            $nama_bulan = "Mei";

            break;

        case '06':
            $nama_bulan = "Juni";

            break;

        case '07':
            $nama_bulan = "Juli";

            break;
        case '08':
            $nama_bulan = "Agustus";

            break;
        case '09':
            $nama_bulan = "September";

            break;
        case '10':
            $nama_bulan = "Oktober";

            break;
        case '11':
            $nama_bulan = "November";

            break;
        case '12':
            $nama_bulan = "Desember";

            break;


        default:
            $nama_bulan = "Tidak di ketahui";

            break;
    }

    return $nama_bulan;
}


function getMonthIndo($namabulan)
{

    $bulan = $namabulan;

    switch ($bulan) {
        case 'January':
            $bulan_ini = "Januari";

            break;

        case 'February':
            $bulan_ini = "Februari";

            break;

        case 'March':
            $bulan_ini = "Maret";

            break;

        case 'April':
            $bulan_ini = "April";

            break;

        case 'May':
            $bulan_ini = "Mei";

            break;

        case 'June':
            $bulan_ini = "Juni";

            break;

        case 'July':
            $bulan_ini = "Juli";

            break;
        case 'August':
            $bulan_ini = "Agustus";

            break;
        case 'September':
            $bulan_ini = "September";

            break;
        case 'October':
            $bulan_ini = "Oktober";

            break;
        case 'November':
            $bulan_ini = "November";

            break;
        case 'December':
            $bulan_ini = "Desember";

            break;

        default:
            $bulan_ini = "Tidak di ketahui";

            break;
    }

    return $bulan_ini;
}

function is_logged_in()
{
    $ci = get_instance();

    if ($ci->session->userdata('email')) {
        if ($ci->uri->segment(2) == 'logout') {
        } else {

            if ($ci->session->userdata('role_id') == 1) {
                redirect('admin');
            } else {
                redirect('pelanggan');
            }
        }
    }
}


function not_logged_in()
{

    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }
}

function role_logged_in()
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');
    $result = $ci->db->get_where('user_role', ['id' => $role_id])->row_array();
    if ($ci->uri->segment(1) !== strtolower($result['role'])) {
        redirect(strtolower($result['role']));
    }
}

function get_title()
{
    $ci = get_instance();
    $title1 = ucwords(str_replace("_", " ", $ci->uri->segment(2)));

    $explode_title2 = explode('_', $ci->uri->segment(3));
    if ($explode_title2) {
        $title2 = ucwords(implode(' ', $explode_title2));
    } else {
        $title2 = $ci->uri->segment(3);
    }

    if ($title2) {
        return "$title1 &mdash; $title2";
    } else {
        return $title1;
    }
}


function no_pemesanan()
{
    $type = 'PSN';
    $bulan = substr(strtoupper(getMonthIndo(date('F'))), 0, 3);
    $tahun = substr(date('Y'), 2);
    $no_pemesanan = "$type$bulan-$tahun-" . rand();
    return $no_pemesanan;
}

function no_pembayaran()
{
    $type = 'BYR';
    $bulan = substr(strtoupper(getMonthIndo(date('F'))), 0, 3);
    $tahun = substr(date('Y'), 2);
    $no_pembayaran = "$type$bulan-$tahun-" . rand();
    return $no_pembayaran;
}

function get_random_numbers($digit)
{
    $digits = $digit;
    return str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
}
