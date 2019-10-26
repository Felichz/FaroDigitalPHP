<script type="text/javascript">
function insRow() {
    var form = document.getElementById('tPos');
    form.innerHTML =  form.innerHTML + "<div style='display: none;''><?php $oPR->pullDown(); echo $oPR->_oo['html']; ?></div>";
    form.submit();
}

function deleteRow(id,row) {
    document.getElementById(id).deleteRow(row);
    //
    document.getElementById('tPos').submit();
}
</script>