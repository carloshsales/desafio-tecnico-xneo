function getListItem(data) {

    let li = document.createElement("li");
    let content = document.createElement("p");
    let input = document.createElement("input");
    let check = document.createElement("input");
    let divItem = document.createElement("div");
    let divBtn = document.createElement("div");
    let editButton = document.createElement("a");
    let deleteButton = document.createElement("a");


    li.classList.add("list-item");
    li.appendChild(check)
    check.type = "checkbox";
    check.classList.add("checkbox");
    li.appendChild(divItem)
    divItem.classList.add("item-container");
    divItem.appendChild(content);
    content.setAttribute("data-id", data.id);
    content.classList.add("content");
    divItem.appendChild(input);
    input.classList.add("input-edit");
    li.appendChild(divBtn)
    divBtn.classList.add("btn-container");
    divBtn.appendChild(editButton);
    editButton.classList.add("edit");
    divBtn.appendChild(deleteButton)
    deleteButton.classList.add("delete");

    content.innerText = `${data.description}`;

    // Adicione uma classe ao botão para estilização
    editButton.classList.add("edit-button");

    // Crie o elemento de imagem para o ícone
    const iconEdit = document.createElement("img");
    iconEdit.src = "../icons/edit.svg";
    iconEdit.alt = "Editar";
    iconEdit.classList.add("edit-icon");
    editButton.appendChild(iconEdit);

    const iconDelete = document.createElement("img");
    iconDelete.src = "../icons/delete.svg";
    iconDelete.alt = "Deletar";
    iconDelete.classList.add("delete-icon");
    deleteButton.appendChild(iconDelete);

    if (data.checked === 1) {
        content.classList.add("completed");
        check.checked = true;
    } else {

        content.classList.remove("completed");
    }


    return li;
}