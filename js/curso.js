document.addEventListener('DOMContentLoaded', function() {
  const titulosClick = document.querySelectorAll('.titulo-click');

  titulosClick.forEach(titulo => {
      titulo.addEventListener('click', function() {
          const contenido = this.nextElementSibling;

          // Alternar visibilidad del contenido
          /*contenido.classList.toggle('contenido');*/
          if (contenido.classList.contains('contenido')) {
            contenido.classList.remove('contenido');
        } else {
            contenido.classList.add('contenido');
        }

          // Rotar la flecha
          const arrow = this.querySelector('.arrow');
          arrow.classList.toggle('rotate');
      });
  });
});
