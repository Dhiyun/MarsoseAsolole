"use strict";

$(document).ready(function() {
    $('#agama').select2({
        placeholder: "Pilih Agama",
        allowClear: true,
        minimumResultsForSearch: Infinity
    });

    $('#jenis_kelamin').select2({
        placeholder: "Pilih Jenis Kelamin",
        allowClear: true,
        minimumResultsForSearch: Infinity
    });

    $('#no_rt').select2({
        placeholder: "Pilih No RT",
        allowClear: true,
        minimumResultsForSearch: Infinity
    });
});
