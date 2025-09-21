// admin/public/js/app.js (for common JS)
function confirmDelete(e) {
  e.preventDefault()
  Swal.fire({
    title: 'Xác nhận xóa?',
    text: 'Không thể hoàn tác!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Xóa',
    cancelButtonText: 'Hủy'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = e.target.href
    }
  })
}
