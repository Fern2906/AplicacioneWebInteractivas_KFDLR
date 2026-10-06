function obtenerFavoritos() {
  return JSON.parse(localStorage.getItem('favoritos') || '[]');
}

function guardarFavoritos(favs) {
  localStorage.setItem('favoritos', JSON.stringify(favs));
}

function esFavorito(id) {
  return obtenerFavoritos().some(f => f.id === id);
}

function alternarFavorito(pelicula) {
  let favs = obtenerFavoritos();
  if (esFavorito(pelicula.id)) {
    favs = favs.filter(f => f.id !== pelicula.id);
  } else {
    favs.push({
      id: pelicula.id,
      primaryTitle: pelicula.primaryTitle,
      primaryImage: pelicula.primaryImage,
      startYear: pelicula.startYear,
      averageRating: pelicula.averageRating
    });
  }
  guardarFavoritos(favs);
  actualizarContadorFavoritos();
}

function eliminarFavorito(id) {
  guardarFavoritos(obtenerFavoritos().filter(f => f.id !== id));
  actualizarContadorFavoritos();
  generarModalFavoritos();
}

function eliminarTodosFavoritos() {
  guardarFavoritos([]);
  actualizarContadorFavoritos();
  generarModalFavoritos();
}

function actualizarContadorFavoritos() {
  $('#contadorFavoritos').text(obtenerFavoritos().length);
}

function generarModalFavoritos() {
  const favs = obtenerFavoritos();
  const $cont = $('#listaFavoritos').empty();
  if (favs.length === 0) {
    $cont.html(`
      <div class="text-center text-muted py-4">
        <i class="bi bi-heart" style="font-size:2.5rem;"></i>
        <p class="mt-2 mb-0">No tienes películas favoritas</p>
        <small>Agrega algunas desde la página de inicio</small>
      </div>`);
    return;
  }
  favs.forEach(f => {
    $cont.append(`
      <div class="col-6 col-md-4 col-lg-3 mb-3">
        <div class="card h-100">
          <img src="${f.primaryImage || 'https://placehold.co/200x300?text=Sin+imagen'}" class="card-img-top" style="height:180px;object-fit:cover;">
          <div class="card-body p-2">
            <p class="mb-1 small fw-bold">${f.primaryTitle}</p>
            <p class="mb-2 small text-muted">${f.startYear} <span class="float-end text-warning">${f.averageRating ?? 'N/A'} <i class="bi bi-star-fill"></i></span></p>
            <div class="d-flex gap-1">
              <a href="reseña.html?id=${f.id}" class="btn btn-primary btn-sm flex-grow-1">Ver</a>
              <button class="btn btn-outline-danger btn-sm btn-quitar-favorito" data-id="${f.id}"><i class="bi bi-x"></i></button>
            </div>
          </div>
        </div>
      </div>`);
  });
}

$(function () {
  actualizarContadorFavoritos();
  $('#btnFavoritos').on('click', generarModalFavoritos);
  $('#listaFavoritos').on('click', '.btn-quitar-favorito', function () {
    eliminarFavorito($(this).data('id'));
  });
  $('#btnEliminarTodos').on('click', eliminarTodosFavoritos);
});