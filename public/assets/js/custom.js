/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

//Delete by Button
// $(document).on("click", ".delete", function (e) {
//     // const url = $(this).data('url');
//     e.preventDefault();
//     Swal.fire({
//         icon: 'warning',
//         title: 'Anda yakin?',
//         text: "Data ini akan dihapus!",
//         type: 'warning',
//         timer: 5000,
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//     }).then((result) => {
//         if (result.value) {
//         window.location.href = url;
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//         Swal.fire(
//             'Tenang',
//             'Data batal dihapus.',
//             'error'
//         )
//         }
//     })
// });

//Delete by Form Submit Button
$(document).on('click','#delete', function (e) {
    e.preventDefault();
    var form = this;
    Swal.fire({
        icon: 'warning',
        title: 'Anda yakin?',
        text: "Data ini akan dihapus!",
        type: 'warning',
        timer: 5000,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            return form.submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
            'Tenang',
            'Data batal dihapus.',
            'error'
        )
        }
    })
});
