$('#deleteModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let id = button.data('id')
    let action = button.data('action')

    let modal = $(this)
    modal.find('.modal-body #deleteid').val(id)
    modal.find('.modal-body #deleteform').attr('action', action);
})
