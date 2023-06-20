<?php require APPROOT . '/views/pages/partials/header.php'; ?>


  <!-- flex form section -->
  <section class="h-screen flex flex-col items-center md:px-6.5 font-dmsans">
    
    <div class="absolute top-10 rounded-md bg-white px-8 py-6 mx-4 drop-shadow-md md:w-3/4">

 		<a href="<?php echo URLROOT; ?>/pages/login" class="absolute top-4 left-0 px-4 py-2 bg-ctaDark rounded-r-xl text-dark drop-shadow-md"><i class="fas fa-arrow-left"></i> Iniciar Sesion </a>
		<div id="btn-pro" class="absolute top-10 right-0 cursor-pointer px-6 py-4 rounded-l-xl text-dark bg-ctaDark font-bold text-lg drop-shadow-md">
			<i class="fas fa-bell mr-2 "></i><span>Soy profesional</span>				
		</div>

  <form action="<?php echo URLROOT; ?>/pages/registrar" id="form_register" method="post" autocomplete="off" >
		<div class=" w-1/2 mx-auto flex items-center justify-around space-x-8">
			<a href="<?php echo URLROOT . '/' . $data['controller'] . '/index'?>"><img src="<?php echo URLROOT; ?>/img/logo.png" alt="imagen logo" class="h-16"></a>
			<h2 class="p-4 text-4xl text-neutral ">Registro de Usuario</h2>
       
		</div>

		<div class="flex w-full space-x-8">
			<div class="w-2/3 flex flex-col">

			  <div class="group-row">
			    <div class="group-col">
			    	<label for="tipo_documento">Tipo de documento:</label>
				    <select id="tipo_documento" name="tipo_documento" required>
				      <option value="" selected>Selecciona ...</option>
				      <?php if(isset($data['tipo_docs'])) : ?>
								<?php foreach ($data['tipo_docs'] as $row) : ?>
									<option value="<?php echo $row->value ?>"><?php echo $row->tipo_doc ?></option>
								<?php endforeach; ?>
							<?php endif; ?> 
				    </select>
			    </div>
			    <div class="group-col relative">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="num_documento">Numero Documento: 
				    	<span id="alert-doc" class="hidden italic text-sm text-red">Maximo <span id="chars_text">2</span> caracteres</span>
				    </label>
				    <input type="text" id="num_documento" name="num_documento"  minlength="3"  required placeholder="46801360">
			    </div>
			  </div>

			  <div class="group-row">
			    <div class="group-col relative">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="nombre">Nombre:
				    	<span id="alert-nombre" class="hidden italic text-sm text-red">Minimo 3 caracteres</span>
				    </label>
				    <input type="text" id="nombre" name="nombre" minlength="3" required placeholder="Luz Maria">
			    </div>
			    <div class="group-col relative">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="apellido">Apellido:
				    	<span id="alert-apellido" class="hidden italic text-sm text-red">Minimo 3 caracteres</span>
				    </label>
				    <input type="text" id="apellido" name="apellido" minlength="3" required placeholder="Ruiz Manzano">	
			    </div>
			  </div>

			  <div class="w-full flex space-x-8 mb-4">
			    <div class="group-col relative w-1/3">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
			  		<label for="calle">Calle:
				    	<span id="alert-calle" class="hidden italic text-sm text-red">Minimo 4 caracteres</span>
			  		</label>
			    	<input type="text" id="calle" name="calle" required placeholder="Av. San Martin">
			    </div>
			    <div class="group-col relative w-1/3">
			    	<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="altura">Altura:
				    	<span id="alert-altura" class="hidden italic text-sm text-red">Minimo 2 números</span>
				  	</label>
				    <input type="number" id="altura" name="altura" min="1" max="9999" required placeholder="5">
			    </div>
			    <div class="group-col w-1/3">
			   		<label for="piso">Piso: (Opcional)</label>
			    	<input type="text" id="piso" name="piso" maxlength="5" placeholder="6">
			    </div>
			  </div>

			  <div class="w-full flex space-x-8 mb-4">
			    <div class="group-col w-1/3">
				    <label for="depto">Depto.: (Opcional)  </label>
				    <input type="text" id="depto" name="depto" placeholder="B1">
			    </div>
			    <div class="group-col relative w-1/3">
			  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="barrio">Barrio:
				    	<span id="alert-barrio" class="hidden italic text-sm text-red">Minimo 6 números</span>
				    </label>
				    <input type="text" id="barrio" name="barrio" required placeholder="Santa Ana">
			    </div>
			    <div class="group-col  w-1/3">
				    <label for="localidad">Localidad: </label>

				    <select id="localidad" name="localidad" required>
				      <option value="" selected>Selecciona ...</option>
				     	<?php if(isset($data['localidades'])) : ?>
								<?php foreach ($data['localidades'] as $row) : ?>
									<option value="<?php echo $row->id ?>"><?php echo $row->localidad ?></option>
								<?php endforeach; ?>
							<?php endif; ?> 
				    </select>

			    </div>
			  </div>


			  <div class="group-row">
			    <div class="group-col relative">
			  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="telefono">Teléfono:
				    	<span id="alert-telef" class="hidden italic text-sm text-red">Minimo 8 números</span>

				    </label>
				    <input type="text" id="telefono" name="telefono" minlength="8" maxlength="15" placeholder="01-24234-242424" required>
			    </div>
			    <div class="group-col relative">
			  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="email"> E-mail:
				    	<span id="alert-email" class="hidden italic text-sm text-red">Email inválido.</span>

				    </label>
				    <input type="email" id="email" name="email" placeholder="mariaruiz@gmail.com" required>	
			    </div>
			  </div>

			  <div class="group-row">
			    <div class="group-col relative">
			  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="contrasenia">Contraseña:
				    	<span id="alert-pass" class="hidden italic text-sm text-red">Minimo 6 caracteres</span>
				    </label>
				    <input type="password" id="contrasenia" name="contrasenia" required placeholder="Escribe tu contraseña">
			    </div>
			    <div class="group-col relative">
			  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="repetirContrasenia">Repetir Contraseña:
				    	<span id="alert-rpass" class="hidden italic text-sm text-red">No coinciden</span>
				    </label>
				    <input type="password" id="repetirContrasenia" name="repetirContrasenia" required placeholder="Repite tu contraseña">
			    </div>
			  </div>

			</div>


			<div class="w-1/3 ">
				<?php showAlert(); ?>
				<img class="h-44 object-cover" src="<?php echo URLROOT; ?>/img/logo.png" alt="">

				<div id="profesional" class="hidden flex flex-col space-y-4">
					<div class="group-col relative">
			  		<div class="absolute hidden right-0 bottom-0"><i class="fas fa-check bg-cta p-2 rounded-full"></i></div>
				    <label for="nombre_comercial">Nombre Comercial:
				    	<span id="alert-comercial" class="hidden italic text-sm text-red">Minimo 6 caracteres</span>
				    </label>
				    <input type="text" id="nombre_comercial" name="nombre_comercial" placeholder="e.g. Spa Mariana">
					</div>

					<div class="flex flex-col space-y-4 ">
				    <p class="text-sm">Profesion:</p>

						<div class="w-full px-10 ">
							<?php if(isset($data['profesiones'])) : ?>
								<?php foreach ($data['profesiones'] as $row) : ?>
							<div class="flex justify-between">
						    <label for="profesion"><?php echo $row->profesion ?></label>
						    <input type="checkbox" name="profesion" value="<?php echo $row->id ?>">
						  </div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="group-col">
				    <label for="modalidad">Modalidad de Trabajo:</label>
				    <select id="modalidad" name="modalidad">
				      <option value="" selected>Selecciona ...</option>
				     	<?php if(isset($data['modalidades'])) : ?>
								<?php foreach ($data['modalidades'] as $row) : ?>
									<option value="<?php echo $row->id ?>"><?php echo $row->modalidad ?></option>
								<?php endforeach; ?>
							<?php endif; ?> 
				    </select>
				  </div>

					<div class="group-col">
				    <label for="zona">Zona de Trabajo:</label>
				    <select id="zona" name="zona">
				      <option value="" selected>Selecciona ...</option>
				     	<?php if(isset($data['zonas'])) : ?>
								<?php foreach ($data['zonas'] as $row) : ?>
									<option value="<?php echo $row->id ?>"><?php echo $row->zona ?></option>
								<?php endforeach; ?>
							<?php endif; ?> 
				      
				    </select>
				  </div>
			  </div>
			   
			</div>

		</div>


		<div class="w-full flex items-center justify-center">
			<button type="submit" class="p-4 w-1/2 rounded-full bg-neutral hover:bg-neutralDark text-white text-2xl">Registrarme</button>
		</div>
  </form>



    </div>
  </section>

<script>

const form = document.querySelector('#form_register')
form.addEventListener('submit', e => {
  if(form.classList.contains('invalid')) {
    e.preventDefault()
    // console.log(form)
  } 
})


	const profesional = document.querySelector('#profesional')
	const btnPro = document.querySelector('#btn-pro')
	btnPro.addEventListener('click', () => {
		const icon = btnPro.firstElementChild
		icon.classList.toggle('fa-bell')
		icon.classList.toggle('fa-check')
		profesional.classList.toggle('hidden')
		profesional.previousElementSibling.classList.toggle('hidden')
	})


const fieldValidation = (val, chars) => {
	let i = 0

	// si es documentounico
	if (chars === 8) {
		if(val.length == chars) {
			i++
		}

		if(/[1-9]/.test(val)) {
			i++
		}
	} else if (chars === 10) {
		if(val.length == chars) {
			i++
		}

		if(/[A-Z]/.test(val)) {
			i++
		}

		if(/[1-9]/.test(val)) {
			i++
		}

	} else {
		i = 0
	}

	// if(val.length >= 4) {
	// 	i++
	// }


	// if(val.length >= 10) {
	// 	i++
	// }

	// if(/[A-Z]/.test(val)) {
	// 	i++
	// }

	// if(/[1-9]/.test(val)) {
	// 	i++
	// }

	// if(/[A-Za-z0-3]/.test(val)) {
	// 	i++
	// }

	return i
}



const passValidation = (value) => {
	let i = 0

	if(value.length > 5) {
		i++
	}

	if(/[A-Z]/.test(value)) {
		i++
	}

	if(/[1-9]/.test(value)) {
		i++
	}

	if(/[A-Za-z0-3]/.test(value)) {
		i++
	}

	return i
}


let chars
const chars_text = document.querySelector('#chars_text')

const tipo_doc = document.querySelector('#tipo_documento')
tipo_doc.addEventListener('change', () => {
	if(tipo_doc.value === 'documentoUnico') {
		chars = 8
		chars_text.textContent = chars
		numDoc.setAttribute('maxlength', chars)
		// console.log(numDoc)
	} else if (tipo_doc.value === 'pasaporte') {
		chars = 10
		chars_text.textContent = chars
		numDoc.setAttribute('maxlength', chars)
		// console.log(numDoc)

	} else {
		chars = 1
	}
})



const numDoc = document.querySelector('#num_documento')
numDoc.addEventListener('keyup', (e) => {


	let docValid = fieldValidation(numDoc.value, chars)
	const alertDoc = document.querySelector('#alert-doc')
	// console.log(numDoc.value.length)

	// si esta seleccionado documento Unico
	if(tipo_doc.value === 'documentoUnico') {
		if(docValid === 2) {
			alertDoc.classList.add('hidden')
			alertDoc.parentElement.previousElementSibling.classList.remove('hidden')
		} else {
			alertDoc.classList.remove('hidden')
			alertDoc.parentElement.previousElementSibling.classList.add('hidden')
		}
	} else if (tipo_doc.value === 'pasaporte') {
	// si esta seleccionado pasaporte
		if(docValid === 3) {
			alertDoc.classList.add('hidden')
			alertDoc.parentElement.previousElementSibling.classList.remove('hidden')
		} else {
			alertDoc.classList.remove('hidden')
			alertDoc.parentElement.previousElementSibling.classList.add('hidden')
		}
	} 

})

const nombre = document.querySelector('#nombre')
nombre.addEventListener('keyup', (e) => {

	const alertNombre = document.querySelector('#alert-nombre')
	// console.log(numDoc.value.length)

	// si esta seleccionado documento Unico
	if(nombre.value.length > 3) {
		alertNombre.classList.add('hidden')
		alertNombre.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertNombre.classList.remove('hidden')
		alertNombre.parentElement.previousElementSibling.classList.add('hidden')
	}
	

})


const apellido = document.querySelector('#apellido')
apellido.addEventListener('keyup', (e) => {

	const alertApellido = document.querySelector('#alert-apellido')
	// console.log(numDoc.value.length)

	// si esta seleccionado documento Unico
	if(apellido.value.length > 3) {
		alertApellido.classList.add('hidden')
		alertApellido.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertApellido.classList.remove('hidden')
		alertApellido.parentElement.previousElementSibling.classList.add('hidden')
	}
})



const nom_comerc = document.querySelector('#nombre_comercial')
nom_comerc.addEventListener('keyup', (e) => {

	const alertComer = document.querySelector('#alert-comercial')
	// console.log(numDoc.value.length)

	// si esta seleccionado documento Unico
	if(nom_comerc.value.length > 6) {
		alertComer.classList.add('hidden')
		alertComer.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertComer.classList.remove('hidden')
		alertComer.parentElement.previousElementSibling.classList.add('hidden')
	}
})



const pass = document.querySelector('#contrasenia')
pass.addEventListener('keyup', (e) => {

	let passValid = passValidation(pass.value)
	const alertPass = document.querySelector('#alert-pass')
	// console.log(numDoc.value.length)

	if(passValid === 4) {
		alertPass.classList.add('hidden')
		alertPass.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertPass.classList.remove('hidden')
		alertPass.parentElement.previousElementSibling.classList.add('hidden')
	}


})

const rpass = document.querySelector('#repetirContrasenia')
rpass.addEventListener('keyup', (e) => {

	const alertRpass = document.querySelector('#alert-rpass')
	// console.log(numDoc.value.length)
	if (rpass.value.length > 3) {
		if(rpass.value == pass.value) {
			alertRpass.classList.add('hidden')
			alertRpass.parentElement.previousElementSibling.classList.remove('hidden')
      form.classList.remove('invalid')

		} else {
			alertRpass.classList.remove('hidden')
			alertRpass.parentElement.previousElementSibling.classList.add('hidden')
      form.classList.add('invalid')

		}

	}

})


const email = document.querySelector('#email')
email.addEventListener('keyup', (e) => {

	const alertEmail = document.querySelector('#alert-email')
	// console.log(numDoc.value.length)

	if(email.value.length > 5 && email.value.includes('@')) {
		alertEmail.classList.add('hidden')
		alertEmail.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertEmail.classList.remove('hidden')
		alertEmail.parentElement.previousElementSibling.classList.add('hidden')
	}

})

const telefono = document.querySelector('#telefono')
telefono.addEventListener('keyup', (e) => {

	const alertTelef = document.querySelector('#alert-telef')
	// console.log(numDoc.value.length)

	if(telefono.value.length > 7) {
		alertTelef.classList.add('hidden')
		alertTelef.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertTelef.classList.remove('hidden')
		alertTelef.parentElement.previousElementSibling.classList.add('hidden')
	}

})

// const localidad = document.querySelector('#localidad')
// localidad.addEventListener('keyup', (e) => {

// 	const alertLocal = document.querySelector('#alert-local')
// 	// console.log(numDoc.value.length)

// 	if(localidad.value.length > 3) {
// 		alertLocal.classList.add('hidden')
// 		alertLocal.parentElement.previousElementSibling.classList.remove('hidden')
// 	} else {
// 		alertLocal.classList.remove('hidden')
// 		alertLocal.parentElement.previousElementSibling.classList.add('hidden')
// 	}

// })

const barrio = document.querySelector('#barrio')
barrio.addEventListener('keyup', (e) => {

	const alertBarrio = document.querySelector('#alert-barrio')
	// console.log(numDoc.value.length)

	if(barrio.value.length > 6) {
		alertBarrio.classList.add('hidden')
		alertBarrio.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertBarrio.classList.remove('hidden')
		alertBarrio.parentElement.previousElementSibling.classList.add('hidden')
	}

})

const altura = document.querySelector('#altura')
altura.addEventListener('keyup', (e) => {

	const alertAltura = document.querySelector('#alert-altura')
	// console.log(numDoc.value.length)

	if(altura.value.length >= 2) {
		alertAltura.classList.add('hidden')
		alertAltura.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertAltura.classList.remove('hidden')
		alertAltura.parentElement.previousElementSibling.classList.add('hidden')
	}

})


const calle = document.querySelector('#calle')
calle.addEventListener('keyup', (e) => {

	const alertCalle = document.querySelector('#alert-calle')
	// console.log(numDoc.value.length)

	if(calle.value.length > 4) {
		alertCalle.classList.add('hidden')
		alertCalle.parentElement.previousElementSibling.classList.remove('hidden')
	} else {
		alertCalle.classList.remove('hidden')
		alertCalle.parentElement.previousElementSibling.classList.add('hidden')
	}

})
</script>

<?php require APPROOT . '/views/pages/partials/footer.php'; ?>