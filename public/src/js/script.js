// Confirmação pra deletar a tarefa
function confirmDelete(tarefaId) {
    Swal.fire({
        title: 'Você tem certeza que deseja excluir essa tarefa?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-delete-' + tarefaId).submit();
        } else {
            Swal.fire('Cancelado', 'A tarefa não foi excluída.', 'error');
        }
    });
}
