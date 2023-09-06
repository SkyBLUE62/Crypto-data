async function addToFavorite(id) {
    const api_token = localStorage.getItem('api_token');
    const response = await fetch('api/addToFavorite/' + id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + api_token
        }
    });
    const data = await response.json();
    if (response.status === 200) {
        console.log(data.message);
        let star_outline = document.getElementById('star_outline_'+id);
        star_outline.setAttribute('onclick','deleteFavorite(\''+id+'\')');
        star_outline.setAttribute("id", "star_"+id);
        star_outline.classList.remove("mdi-star-outline");
        star_outline.classList.add("mdi-star");

    } else if (response.status === 401) {
        console.error(data.error);
    } else {
        console.error("Erreur inconnue lors de l'ajout du coin en favori");
    }

}

async function deleteFavorite(id) {
    const api_token = localStorage.getItem('api_token');
    const response = await fetch('api/deleteFavorite/' + id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + api_token
        }
    });
    const data = await response.json();
    if (response.status === 200) {
        console.log(data.message);

        let star = document.getElementById('star_'+id);
        star.classList.remove("mdi-star");
        star.classList.add("mdi-star-outline");
        star.setAttribute('onclick','addToFavorite(\''+id+'\')');
        star.setAttribute("id", "star_outline_"+id);

    } else if (response.status === 401) {
        console.error(data.error);
    } else {
        console.error("Erreur inconnue lors de la suppression du coin");
    }
}
