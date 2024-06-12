$(document).ready(function () {

    var locale = $('html').attr('lang');

    var delet = locale === 'ar' ? 'حذف' : 'Delete';
    var no = locale === 'ar' ? 'لا' : 'No';
    var question = locale === 'ar' ? 'هل تريد الحذف؟' : 'Do you want to delete?';
    var success = locale === 'ar' ? 'تم الحذف بنجاح' : 'Deleted Successfully';
    var cancel = locale === 'ar' ? 'تم إلإلغاء' : 'Cancelled';


    $(document).on("click", '.item-delete',function (e) {

        e.preventDefault();
        const Toast2 = Swal.mixin({

            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        const Toast = Swal.mixin({

            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#888',
            confirmButtonColor: '#d6210f',
            confirmButtonText: delet,
            cancelButtonText: no,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'question',
            title: question
        }).then((result) => {
            if (result.isConfirmed) {

                var id = $(this).data('id');
                var url = $(this).attr('href');
                var elem = $(this).closest('tr');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        _method: 'delete',
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                    },
                    dataType: 'json',
                    success: function (result) {
                        elem.fadeOut();

                        Toast2.fire({
                            title: success,
                            // showConfirmButton: false,
                            icon: 'success',
                            timer: 1000
                        });
                    } // end of success

                }); // end of ajax

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Toast2.fire({
                    title: cancel,
                    // showConfirmButton: false,
                    icon: 'success',
                    timer: 1000
                });

            } // end of else confirmed

        }) // end of then
    });

});
