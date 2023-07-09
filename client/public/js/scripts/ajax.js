function TODOget() {
    $.ajax({
        type: "GET",
        url: "/all",
        success: response => {
            let data = JSON.parse(response)

            let ul = document.getElementById("list-container")

            data.forEach(item => {
                let li = getListItem(item)
                ul.appendChild(li)
                $('.input-edit').hide()
            })
            loading();
        },
        error: () => { alert("Erro ao carregar a lista. Por favor contacte o desenvolvedor.") }
    })
}

function TODOadd() {
    $('#add-btn').on("click", () => {
        let inputValue = $('#description').val();

        if (inputValue.length <= 3) {
            alert("Por favor, digite mais que 3 caracteres.")
            return;
        }
        $.ajax({
            type: "POST",
            url: "/create",
            data: { description: inputValue },
            success: () => { },
            error: () => { alert("Erro ao adicionar a tarefa.") }
        })
    });
}

function TODOedit() {
    $(document).on("click", ".edit", function () {
        let currentIndex = $(".edit").index(this);

        let input = $(".input-edit");
        let inputEdit = $(".input-edit")[currentIndex];
        let content = $(".content")[currentIndex];
        let id = content.getAttribute("data-id");

        inputEdit.style.display = 'block';
        input.focus();

        inputEdit.value = content.innerText;

        content.style.display = 'none'

        input.focusout(() => {
            if (inputEdit.value.length <= 3) {
                alert("Por favor, digite mais que 3 caracteres.")
                return;
            }
            content.innerText = inputEdit.value;

            $.ajax({
                type: "POST",
                url: "/update?id=" + id,
                data: { description: content.innerText },
                success: () => { },
                error: () => {
                    alert("Erro ao atualizar a tarefa.");
                }
            });

            input.hide();
            content.style.display = 'block';
        });
    });
}

function TODOdelete() {
    $(document).on("click", ".delete", function () {
        let currentIndex = $(".delete").index(this);
        let content = $(".content")[currentIndex];
        let id = content.getAttribute("data-id");

        $.ajax({
            type: "GET",
            url: "/delete?id=" + id,
            data: '',
            success: () => { },
            error: () => {
                alert("Erro ao atualizar a tarefa.");
            }
        });
        location.reload();
    });
}

function TODOcheck() {
    $(document).on("change", ".checkbox", function () {
        let isChecked = $(this).is(":checked");
        let contentElement = $(this).closest(".list-item").find(".content");

        let currentIndex = $(".checkbox").index(this);
        let content = $(".content")[currentIndex];
        let id = content.getAttribute("data-id");
        let check = 0;

        if (isChecked) {
            contentElement.addClass("completed");
            check = 1;
        } else {
            contentElement.removeClass("completed");
        }

        $.ajax({
            type: "POST",
            url: "/check?id=" + id,
            data: { checked: check.toString() },
            success: () => { },
            error: () => {
                alert("Erro ao atualizar a tarefa.");
            }
        });
    });

}