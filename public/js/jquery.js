$(document).ready(function () {
    $('#createForm').hide();

    $('#createBtn').click(function (e) {
        $('#createForm').show();
        $('#createBtn').hide();
    });

    $('#createClose').click(function (e) {
        $('#createBtn').show();
        $('#createForm').hide();
    });


    let listItems = $('.list-group-item');
    let list = $('.list-group');

    let draggedItem = null;

    for (let i =0; i < listItems.length; i++){
        const item = listItems[i];
        item.addEventListener('dragstart', function (e) {
            console.log(e);
            draggedItem = this;
        })
    }
});

