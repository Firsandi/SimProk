import './bootstrap';
import Swal from 'sweetalert2';

window.Swal = Swal;

window.confirmAction = function (form, {
    title = 'Konfirmasi',
    text = 'Yakin ingin melanjutkan aksi ini?',
    confirmText = 'Ya, lanjutkan',
    cancelText = 'Batal',
    icon = 'warning',
} = {}) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false; // cegah submit default
};
