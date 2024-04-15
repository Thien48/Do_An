$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id, url){
    if(confirm('Xóa mà không thể khôi phục. Bạn chắc chứ ?')){
        $.ajax({
            tyle: 'DELETE',
            datatyle: 'JSON',
            data: {id},
            url: url,
            success: function(result){
                console.log(result);
            }
        })
    }
}