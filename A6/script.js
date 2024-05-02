$(document).ready(function(){
    // event handler for delete button
    $("table").on('click', '.btnDelete', function () {
        // get the ID of the record from the first cell of the clicked row
        let id = $(this).closest('tr')[0].cells[0].innerText;
        // send a POST request to delete.php with the record ID as data
        $.post("delete.php",{'id': id});
        // remove the clicked row from the table
        $(this).closest('tr').remove();
    });

    // event handler for update button
    $("table").on('click', '.btnUpdate', function () {
        // get data from each cell of the clicked row
        let tableId = $(this).closest('tr')[0].cells[0].innerText;
        let tableModel = $(this).closest('tr')[0].cells[1].innerText;
        let tableEngine = $(this).closest('tr')[0].cells[2].innerText;
        let tableFuel = $(this).closest('tr')[0].cells[3].innerText;
        let tablePrice = $(this).closest('tr')[0].cells[4].innerText;
        let tableColor = $(this).closest('tr')[0].cells[5].innerText;
        let tableAge = $(this).closest('tr')[0].cells[6].innerText;
        let tableHistory = $(this).closest('tr')[0].cells[7].innerText;

        // populate the corresponding input fields in the update form with the retrieved data
        $(".update_form #id").val(tableId);
        $(".update_form #model").val(tableModel);
        $(".update_form #engine_power").val(tableEngine);
        $(".update_form #fuel").val(tableFuel);
        $(".update_form #price").val(tablePrice);
        $(".update_form #color").val(tableColor);
        $(".update_form #age").val(tableAge);
        $(".update_form #history_car").val(tableHistory);

        // toggle the display of the update form
        if($(".update_form").css("display") === "none")
            $(".update_form").css("display", "inline");
        else
            $(".update_form").css("display", "none");
    });
});
