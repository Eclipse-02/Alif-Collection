@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="card col-lg-12 mt-5">
        <div class="card-body row justify-content-center" style="height: calc(100vh - 210px);">
            <div class="col-lg-6 row mt-3 justify-content-center">
                <div class="col-lg-6 row">
                    <div class="col-lg-6 text-end">
                        <label for="akun" class="col-form-label">Akun</label>
                    </div>
                    <div class="col-lg-6">
                        <select name="akun" id="akun" class="form-control" style="text-align-last: center;">
                            <option value="" hidden selected>-- PILIH AKUN --</option>
                            <option value="B">NERACA</option>
                            <option value="I">RUGI LABA</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 row">
                    <div class="col-lg-6 text-end">
                        <label for="filter" class="col-form-label">Filter</label>
                    </div>
                    <div class="col-lg-6">
                        <select name="filter" id="filter" class="form-control" style="text-align-last: center;" disabled>
                            <option value="" hidden selected>-- PILIH FILTER --</option>
                            <option value="A">SEMUA ACCOUNT</option>
                            <option value="E">HANYA ENABLE</option>
                            <option value="D">HANYA DISABLE</option>
                        </select>
                    </div>
                </div>
                <div class="mt-1 col-lg-12 overflow-scroll menu" style="height: 40vh; background-color: #5f5f5f;">
                    
                </div>
                <div class="col-lg-12">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="cari" class="col-form-label">Cari Akun</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="cari" class="form-control search" name="search" id="search">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary search-btn">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('dashboard.update') }}" method="post">
                @csrf
                @method('PUT')

                <div class="row mt-3">
                    <div class="col-lg-3 text-end">
                        <label for="kode" class="col-form-label">Kode<strong style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-9 kode">
                        <input type="text" name="kode" id="kode" class="form-control" minlength="7" maxlength="7" required readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3 text-end">
                        <label for="keterangan" class="col-form-label">Keterangan<strong style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-9 keterangan">
                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3 text-end">
                        <label for="tipe" class="col-form-label">Tipe<strong style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-9 tipe">
                        <select name="tipe" id="tipe" class="form-control" style="text-align-last: center;"
                            required>
                            <option value="" hidden selected>-- PILIH TIPE --</option>
                            <option value="A">ASSET</option>
                            <option value="L">LIABILITIES</option>
                            <option value="O">OWNER EQUITY</option>
                            <option value="R">REVENUE</option>
                            <option value="E">EXPENSE</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end">
                            <label for="summary" class="col-form-label">Summary<strong style="color: red;">*</strong></label>
                        </div>
                        <div class="col-lg-6 summary">
                            <select name="summary" id="summary" class="form-control" style="text-align-last: center;"
                                required>
                                <option value="" hidden selected>-- PILIH SUMMARY --</option>
                                <option value="Y">YA</option>
                                <option value="N">TIDAK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end">
                            <label for="flag_akun" class="col-form-label">Flag Akun</label>
                        </div>
                        <div class="col-lg-6 flag_akun">
                            <select name="flag_akun" id="flag_akun" class="form-control"
                                style="text-align-last: center;">
                                <option value="" hidden selected>-- PILIH FLAG AKUN --</option>
                                <option value="D">TITIPAN</option>
                                <option value="P">PREPAYMENT</option>
                                <option value="T">PAJAK</option>
                                <option value="C">KAS</option>
                                <option value="B">BANK</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end">
                            <label for="enabled" class="col-form-label">Enable<strong style="color: red;">*</strong></label>
                        </div>
                        <div class="col-lg-6 enabled">
                            <select name="enabled" id="enabled" class="form-control" style="text-align-last: center;"
                                required>
                                <option value="" hidden selected>-- PILIH ENABLE --</option>
                                <option value="AC">YA</option>
                                <option value="NA">TIDAK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end">
                            <label for="flag_report" class="col-form-label">Flag Report</label>
                        </div>
                        <div class="col-lg-6 flag_report">
                            <select name="flag_report" id="flag_report" class="form-control"
                                style="text-align-last: center;">
                                <option value="" hidden selected>-- PILIH FLAG REPORT --</option>
                                <option value="N">TIDAK MUNCUL</option>
                                <option value="A">AMOUNT</option>
                                <option value="H">HEADER ONLY</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end">
                            <label for="parent" class="col-form-label">Parent</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="parent" id="parent" class="form-control" minlength="7" maxlength="7">
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end">
                            <label for="outlet" class="col-form-label">Outlet</label>
                        </div>
                        <div class="col-lg-6">
                            <select name="outlet" id="outlet" class="form-control outlet">
                                <option value="" hidden selected>-- PILIH OUTLET --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end w-100 create">
                            <a href="{{ route('dashboard.create') }}" class="btn btn-success w-100">Create New</a>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-lg-6 text-end w-100 update">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name=_token]').attr('content') 
                }
            });

            // Ajax outlet
            $('.outlet').empty();
            var menu = $(this).val();
            $.ajax({
            type: "GET",
            dataType: 'json',
            url: "{{ route('getOutlet') }}",
            success: function(data) {
                $('.outlet').empty();
                $('.outlet').append('<option value="">-- PILIH OUTLET --</option>');
                $.each(data.outlet, function (key, item) {
                $('.outlet').append(
                    '<option value="' + item.office_code + '">' + item.name_short + '</option>'
                    );
                });
            }
            });

            // Ajax akun
            $(document).on('change', '#akun, #filter', function() {
                var akun = $('#akun').val();
                var filter = $('#filter').val();
                $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ route('getMenu') }}?akun=" + akun + "&filter=" + filter,
                success: function(data) {
                    $('#filter').prop('disabled', false);
                    $('.menu').empty();
                    console.log(data.akun);
                    console.log(akun);
                    console.log(filter);
                    $.each(data.akun, function (key, item) {
                        $('.menu').append(
                            '<div class="'+ (item.level == 1 ? 'ps-1 ' : '') + (item.level == 2 ? 'ps-2 ' : '') + (item.level == 3 ? 'ps-3 ' : '') + (item.level == 4 ? 'ps-4 ' : '') +'row py-1">' +
                                '<div class="col-lg-12 pt-1 ps-1">' +
                                    '<button class="btn btn-light w-100 select text-left" value="' + item.acct_name + '">' +
                                        '<strong>' + item.acct_code + ' - </strong>' +
                                        item.acct_name +
                                    '</button>' +
                                '</div>' +
                            '</div>'
                        );
                    });
                }
                });
            });

            // Ajax menu
            $('.menu').empty();
            $.ajax({
            type: "GET",
            dataType: 'json',
            url: "{{ route('getMenu') }}",
            success: function(data) {
                $('.menu').empty();
                $.each(data.menu, function (key, item) {
                    $('.menu').append(
                        '<div class="'+ (item.lvl == 1 ? 'ps-1 ' : '') + (item.lvl == 2 ? 'ps-2 ' : '') + (item.lvl == 3 ? 'ps-3 ' : '') + (item.lvl == 4 ? 'ps-4 ' : '') +'row py-1">' +
                            '<div class="col-lg-12 pt-1 ps-1">' +
                                '<button class="btn btn-light w-100 select text-left" value="' + item.acct_name + '">' +
                                    '<strong>' + item.acct_code + ' - </strong>' +
                                    item.acct_name +
                                '</button>' +
                            '</div>' +
                        '</div>'
                    );
                });
            }
            });

            // Ajax search
            $(document).on('click', ".search-btn", function() {
                $('.menu').empty();
                var search = $('.search').val();
                console.log(search);
                $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ route('getMenu') }}?search="+ search,
                success: function(data) {
                    console.log(data.menu);
                    $.each(data.menu, function (key, item) {
                        $('.menu').append(
                            '<div class="'+ (item.acct_code == 1 ? 'ps-1 ' : '') + (item.lvl == 2 ? 'ps-2 ' : '') + (item.lvl == 3 ? 'ps-3 ' : '') + (item.lvl == 4 ? 'ps-4 php' : '') +'row py-1">' +
                                '<div class="col-lg-12 pt-1 ps-1">' +
                                    '<button class="btn btn-light w-100 select text-left" value="' + item.acct_name + '">' +
                                        '<strong>' + item.acct_code + ' - </strong>' +
                                        item.acct_name +
                                    '</button>' +
                                '</div>' +
                            '</div>'
                        );
                    });
                }
                });
            });

            // Ajax Update
            $('.update').click(function() {
                var kode = $('#kode').val();
                $.ajax({
                    url: `dashboard`,
                    type: 'PUT',
                    dataType: 'ajax',
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        "kode": $('#kode').val(),
                        "parent": $('#parent').val(),
                        "outlet": $('#outlet').val(),
                        "keterangan": $('#keterangan').val(),
                        "tipe": $('#tipe').val(),
                        "summary": $('#summary').val(),
                        "enabled": $('#enabled').val(),
                        "flag_akun": $('#flag_akun').val(),
                        "flag_report": $('#flag_report').val(),
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });

            // Ajax menu
            $(document).on('click', ".select", function() {
                var menu = $(this).val();
                console.log(menu);
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('getMenu') }}?acct_name=" + menu,
                    success: function(data) {
                        console.log(data.table);
                        $.each(data.table, function(key, item) {
                            console.log(item);
                            $('#parent').val(item.acct_parent);
                            $('#tipe').val(item.acct_type_jurnal);
                            $('#outlet').val(item.acct_office_code);
                            $('#kode').val(item.acct_code);
                            $('#keterangan').val(item.acct_name);
                            $('#summary').val(item.acct_summ);
                            $('#enabled').val(item.acct_status);
                            $('#flag_akun').val(item.acct_flag);
                            $('#flag_report').val(item.acct_rpt_flag);
                        });
                    }
                });
            });
        });
    </script>
@endpush
