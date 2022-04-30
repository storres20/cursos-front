window.addEventListener('load', () => {
  let button = document.getElementById('formulario');
  let usuario = document.getElementById('usuario');
  let password = document.getElementById('password');
  let alert = document.getElementById('alerta');
  
  console.log(usuario);
  
  function alerta() {
    alert.innerHTML = `
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Datos Incorrectos!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
  }
  
  function data() {
    let datos = new FormData();
    datos.append("usuario", usuario.value);
    datos.append("password", password.value);
    
    fetch('validalogin.php',{
      method: 'POST',
      body: datos
    }).then(response => response.json())
    .then(({success}) => {
      if (success === 1) {
        location.href = 'home.php';
      }else{
        alerta();
      }
    })
  }
  
  
  
  button.addEventListener('submit', (e) => {
    e.preventDefault();
    data();
  })
  
})