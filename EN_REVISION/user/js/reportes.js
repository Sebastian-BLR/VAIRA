let Change_Menu = () => {
    let id = document.getElementById("reportes");
    
    id.classList.add("active_menu");
    console.log("Perro");
}

let Load = () => {
    Change_Menu();

}

document.addEventListener("DOMContentLoaded",Load);