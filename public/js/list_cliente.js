$(document).ready(function ($) {
    base_url = window.location.origin;
    console.log(base_url);
    var table = $("#clientes").DataTable({
        ajax: base_url + "/cliente/show",
        serverSide: true,
        responsive: true,
        processing: true,
        searching: true,
        order: [0, "desc"],
        columns: [
            { width: "5%", data: "id", name: "id" },
            { width: "25%", data: "nome", name: "nome" },
            { width: "15%", data: "cpf", name: "cpf" },
            { width: "15%", data: "telefone", name: "telefone" },
            { width: "10%", data: "nascimento", name: "nascimento" },
            { width: "15%", data: "email", name: "email" },
            { width: "15%", data: "acao", name: "acao" },
        ],
    });

    $(document).on("click", ".btnExcluir", function () {
        var nome = $(this).data("nome");
        var id = $(this).data("id");

        swalWithBootstrapButtons
            .fire({
                title:
                    "Tem certeza que deseja excluir o cliente: " + nome + "?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, quero excluir!",
                cancelButtonText: "Não, Cancelar!",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "delete",
                        url: "cliente/" + id,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {},
                        success: function (data) {
                            if (data.erro) {
                                swalWithBootstrapButtons.fire(
                                    "Atenção",
                                    "Exclusão cancelada, tente novamente mais tarde.",
                                    "error"
                                );
                            } else {
                                swalWithBootstrapButtons
                                    .fire(
                                        "Sucesso",
                                        "Exclusão Realizada",
                                        "success"
                                    )
                                    .then(function (result) {
                                        if (result.value) {
                                            $("#table").DataTable().draw(false);
                                        }
                                    });
                            }
                        },
                        error: function () {
                            swalWithBootstrapButtons.fire(
                                "Atenção",
                                "Exclusão cancelada, tente novamente mais tarde.",
                                "error"
                            );
                        },
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Atenção",
                        "Exclusão cancelada, tente novamente mais tarde.",
                        "error"
                    );
                }
            });
    });
});
