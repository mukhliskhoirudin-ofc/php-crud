$(document).ready(function () {
    //hilangkan btnSearch
    $('#btnSearch').hide();

    //even ketika keyword ditulis
    $('#keyword').on('keyup', function () {
        //munculkan icon login
        $('.loader').show();

        $.get('ajax/mahasiswa.php?keyword' + $('#keyword').val(), function (data) {
            $('#container').html(data);
            $('.loader').hide();
        })

        $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
    });
});