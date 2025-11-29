$(document).ready(function() {
    // Menangkap submit form menggunakan event delegation
    $('#product-form-container').on('submit', 'form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var formData = $form.serialize();
        var formUrl = $form.attr('action');

        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(response) {
                // Saat sukses, ganti konten tabel dengan respons AJAX
                $('#product-table-container').html(response);
                // Reset form
                $form[0].reset();
                $('#form-messages').html('<p style="color: green;">Produk berhasil ditambahkan!</p>');
            },
            error: function(response) {
                $('#form-messages').html('<p style="color: red;">Terjadi kesalahan saat menyimpan data.</p>');
            }
        });
    });
});
