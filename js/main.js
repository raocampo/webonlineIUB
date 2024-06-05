/*const tarjeta = document.getElementById('tarjeta');
const textoAcceso = document.getElementById('acceso');
const textoHorario = document.getElementById('horario');
const textoObtiene = document.getElementById('Obtiene');
const cardText = document.getElementById('card-text');

tarjeta.addEventListener('mouseover', () => {
  textoAcceso.textContent = 'Plataforma disponible desde cualquier lugar y en todo momento';
  /*cardText.textContent = 'Hovered information!';
});

tarjeta.addEventListener('mouseout', () => {
  textoAcceso.textContent = 'ACCESO 24/7';
  textoAcceso.textContent = '365 DÍAS';
  /*cardText.textContent = 'This is some information.';
});*/

document.addEventListener('DOMContentLoaded', () => {
  const tarjeta = document.querySelector('.acceso');
  const textoAcceso = document.createElement('div');
  textoAcceso.classList.add('acceso-hover-text');
  textoAcceso.innerHTML = `<p>Plataforma disponible desde cualquier lugar y en todo momento</p>`;

  tarjeta.appendChild(textoAcceso);

  tarjeta.addEventListener('mouseover', () => {
    tarjeta.classList.add('boton-back');
  });

  tarjeta.addEventListener('mouseout', () => {
    tarjeta.classList.remove('boton-back');
  });

});

document.addEventListener('DOMContentLoaded', () => {
  const horario = document.querySelector('.horario');
  const textoHorario = document.createElement('div');
  textoHorario.classList.add('horario-hover-text');
  textoHorario.innerHTML = `<p>Eres el dueño de tu tiempo y tu estudio podrás organizarte trabajar y estudiar</p>`;

  horario.appendChild(textoHorario);

  horario.addEventListener('mouseover', () => {
    horario.classList.add('boton-horario');
  });

  horario.addEventListener('mouseout', () => {
    horario.classList.remove('boton-horario');
  });

});

document.addEventListener('DOMContentLoaded', () => {
  const mencion = document.querySelector('.mencion');
  const textoMencion = document.createElement('div');
  textoMencion.classList.add('mencion-hover-text');
  textoMencion.innerHTML = `<p>Tus títulos son de tercer nivel reconocidos por la SENECYT</p>
  <p>Tecnología Superior Universitaria, culminado podrás estudiar maestrías
  </p>`;

  mencion.appendChild(textoMencion);

  mencion.addEventListener('mouseover', () => {
    mencion.classList.add('boton-mencion');
  });

  mencion.addEventListener('mouseout', () => {
    mencion.classList.remove('boton-mencion');
  });

});