@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="card col-lg-12 mt-5">
        <div class="card-body row" style="height: calc(100vh - 210px);">
            <div class="col-lg-3">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Back To Main</a>
            </div>
            <form action="{{ route('dashboard.store') }}" method="post">
                @csrf

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="acct_code" class="col-form-label">Kode<strong style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-9 acct_code">
                        <input type="text" name="acct_code" id="acct_code" class="form-control" minlength="7" placeholder="7 Digit"
                            maxlength="7" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="acct_name" class="col-form-label">Keterangan<strong
                                style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-9 acct_name">
                        <input type="text" name="acct_name" id="acct_name" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="acct_type_jurnal" class="col-form-label">Tipe<strong style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-9 acct_type_jurnal">
                        <select name="acct_type_jurnal" id="acct_type_jurnal" class="form-control" style="text-align-last: center;"
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
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="acct_summ" class="col-form-label">Summary<strong
                                style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-3 acct_summ">
                        <select name="acct_summ" id="acct_summ" class="form-control" style="text-align-last: center;"
                            required>
                            <option value="" hidden selected>-- PILIH SUMMARY --</option>
                            <option value="Y">YA</option>
                            <option value="N">TIDAK</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="acct_flag" class="col-form-label">Flag Akun</label>
                    </div>
                    <div class="col-lg-3 acct_flag">
                        <select name="acct_flag" id="acct_flag" class="form-control" style="text-align-last: center;">
                            <option value="" hidden selected>-- PILIH FLAG AKUN --</option>
                            <option value="D">TITIPAN</option>
                            <option value="P">PREPAYMENT</option>
                            <option value="T">PAJAK</option>
                            <option value="C">KAS</option>
                            <option value="B">BANK</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="acct_status" class="col-form-label">Enable<strong
                                style="color: red;">*</strong></label>
                    </div>
                    <div class="col-lg-3 acct_status">
                        <select name="acct_status" id="acct_status" class="form-control" style="text-align-last: center;"
                            required>
                            <option value="" hidden selected>-- PILIH ENABLE --</option>
                            <option value="AC">YA</option>
                            <option value="NA">TIDAK</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="acct_rpt_flag" class="col-form-label">Flag Report</label>
                    </div>
                    <div class="col-lg-3 acct_rpt_flag">
                        <select name="acct_rpt_flag" id="acct_rpt_flag" class="form-control"
                            style="text-align-last: center;">
                            <option value="" hidden selected>-- PILIH FLAG REPORT --</option>
                            <option value="N">TIDAK MUNCUL</option>
                            <option value="A">AMOUNT</option>
                            <option value="H">HEADER ONLY</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3">
                        <label for="acct_parent" class="col-form-label">Parent</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" name="acct_parent" id="acct_parent" class="form-control" minlength="7"
                            maxlength="7" placeholder="7 Digit">
                    </div>
                    <div class="col-lg-3">
                        <label for="acct_office_code" class="col-form-label">Outlet</label>
                    </div>
                    <div class="col-lg-3">
                        <select name="acct_office_code" id="acct_office_code" class="form-control acct_office_code"
                            style="text-align-last: center;">
                            <option value="" hidden selected>-- PILIH OUTLET --</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success w-100">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')
                }
            });

            // Ajax outlet
            $('.acct_office_code').empty();
            var menu = $(this).val();
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ route('getOutlet') }}",
                success: function(data) {
                    $('.acct_office_code').empty();
                    $('.acct_office_code').append('<option value="">-- PILIH OUTLET --</option>');
                    $.each(data.outlet, function(key, item) {
                        $('.acct_office_code').append(
                            '<option value="' + item.office_code + '">' + item.name_short +
                            '</option>'
                        );
                    });
                }
            });

            // // Ajax Create
            // $('.create').click(function() {
            //     var acct_code = $('#acct_code').val();
            //     $.ajax({
            //         url: `dashboard`,
            //         type: 'POST',
            //         dataType: 'ajax',
            //         data: JSON.stringify({
            //             "_token": $("meta[name='csrf-token']").attr("content"),
            //             "acct_code": $('#acct_code').val(),
            //             "acct_parent": $('#acct_parent').val(),
            //             "acct_office_code": $('#acct_office_code').val(),
            //             "acct_name": $('#acct_name').val(),
            //             "acct_type_jurnal": $('#acct_type_jurnal').val(),
            //             "acct_summ": $('#acct_summ').val(),
            //             "acct_status": $('#acct_status').val(),
            //             "acct_flag": $('#acct_flag').val(),
            //             "acct_rpt_flag": $('#acct_rpt_flag').val(),
            //         }),
            //         success: function(response) {
            //             console.log(response);
            //         }
            //     });
            // });
        });
    </script>
@endpush
