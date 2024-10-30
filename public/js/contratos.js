$(document).on('keydown', function (e) {
    // You may replace `m` with whatever key you want
    if ((e.metaKey || e.ctrlKey) && (String.fromCharCode(e.which).toLowerCase() === 'q')) {
        $("#copyClientes").offcanvas('show');
    }
});

function clienteTo() {
    var modal_seller_id = document.getElementById('modal_cliente_id').value;
    var modal_seller_reference = document.getElementById('modal_cliente_seller_reference').value;
    var sellerID = document.getElementById('seller_id');
    var sellerReference = document.getElementById('seller_reference');
    console.log(modal_seller_id);
    console.log(modal_seller_reference);
    console.log(sellerID);
    console.log(sellerReference);


    if (modal_seller_reference) {
        sellerID.value = modal_seller_id;
        sellerReference.value = modal_seller_reference;
    }
    document.getElementById('contratoForm').submit();
}