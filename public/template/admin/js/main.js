$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(lecturers_id, url){
    if(confirm('Xóa mà không thể khôi phục. Bạn chắc chứ ?')){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { lecturers_id },
            url: url,
            success: function(result){
               if(result.error == false){
                alert(result.message);
                location.reload();
               }else {
                alert('Xóa lỗi vui lòng thử lại')
               }
            }
        })
    }
}