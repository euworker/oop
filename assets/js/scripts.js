const mainUrl = "http://localhost:8080/pav2023/oop"

function remove(type, id) {
    if (confirm('Выдействительно хотите удалить запись?')){
        window.location.href = `${mainUrl}/${type}/delete/${id}`; 
    }
}


