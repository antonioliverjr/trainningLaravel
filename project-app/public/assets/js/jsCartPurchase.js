function carRemoveBook(id, idPurchase, item)
{
    alert(id);
    $('#form-remove-item input[name="id"]').val(id);
    $('#form-remove-item input[name="idPurchase"]').val(idPurchase);
    $('#form-remove-item input[name="item"]').val(item);
    $('#form-remove-item').submit();
}

function cartAddBook(id)
{
    alert(id);
    $('#form-add-item input[name="id"]').val(id);
    $('#form-add-item').submit();
}