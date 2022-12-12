const 
	  	tarjetaEpica = document.querySelector('#TarjetaEpica'),
		btnAbrirFormulario = document.querySelector('#btn-abrir-formulario'),
		numeroTarjeta = document.querySelector('#TarjetaEpica .numero'),
		nombreTarjeta = document.querySelector('#TarjetaEpica .nombre'),
		firma = document.querySelector('#TarjetaEpica .firma p'),
		logoMarca = document.querySelector('#logo-marca'),
		mesExpiracion = document.querySelector('#TarjetaEpica .mes'),
		yearExpiracion = document.querySelector('#TarjetaEpica .year');
		formulario = document.querySelector('#formulario-tarjetas'),
		ccv = document.querySelector('#TarjetaEpica .ccv');


// * Input numero de tarjeta
formulario.inputNumero.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.inputNumero.value = valorInput
	// Eliminamos espacios en blanco
	.replace(/\s/g, '')
	// Eliminar las letras
	.replace(/\D/g, '')
	// Ponemos espacio cada cuatro numeros
	.replace(/([0-9]{4})/g, '$1 ')
	// Elimina el ultimo espaciado
	.trim();

	numeroTarjeta.textContent = valorInput;

	if(valorInput == ''){
		numeroTarjeta.textContent = '#### #### #### ####';

		logoMarca.innerHTML = '';
	}

	if(valorInput[0] == 4){
		logoMarca.innerHTML = '';
		const imagen = document.createElement('img');
		imagen.src = 'Imagenes/Tarjeta/logos/visa.png';
		logoMarca.appendChild(imagen);
	} else if(valorInput[0] == 5){
		logoMarca.innerHTML = '';
		const imagen = document.createElement('img');
		imagen.src = 'Imagenes/Tarjeta/logos/mastercard.png';
		logoMarca.appendChild(imagen);
	} else {
		logoMarca.innerHTML = '';
		const imagen = document.createElement('img');
		imagen.src = 'Imagenes/Tarjeta/logos/fz.png';
		logoMarca.appendChild(imagen);

	}

	// Volteamos la tarjeta para que el usuario vea el frente.
	mostrarFrente();

});

// * Select del mes generado dinamicamente.
for(let i = 1; i <= 12; i++){
	let opcion = document.createElement('option');
	opcion.value = i;
	opcion.innerText = i;
	formulario.selectMes.appendChild(opcion);
}

// * Select del año generado dinamicamente.
const yearActual = new Date().getFullYear();
for(let i = yearActual; i <= yearActual + 8; i++){
	let opcion = document.createElement('option');
	opcion.value = i;
	opcion.innerText = i;
	formulario.selectYear.appendChild(opcion);
}

// * Select mes
formulario.selectMes.addEventListener('change', (e) => {
	mesExpiracion.textContent = e.target.value;
	mostrarFrente();
});

// * Select Año
formulario.selectYear.addEventListener('change', (e) => {
	yearExpiracion.textContent = e.target.value.slice(2);
	mostrarFrente();
});


// * Input nombre de tarjeta
formulario.inputNombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.inputNombre.value = valorInput.replace(/[0-9]/g, '');
	nombreTarjeta.textContent = valorInput;
	firma.textContent = valorInput;

	if(valorInput == ''){
		nombreTarjeta.textContent = '';
	}

	mostrarFrente();
});

// * CCV
formulario.inputCCV.addEventListener('keyup', () => {

	if(!tarjetaEpica.classList.contains('active')){
		tarjetaEpica.classList.toggle('active');
	}

	formulario.inputCCV.value = formulario.inputCCV.value
	.replace(/\s/g, '')
	.replace(/\D/g, '');

	ccv.textContent = formulario.inputCCV.value;

});

// GIRAR TARJETA EFECTO 
const mostrarFrente = () => {
	if(tarjetaEpica.classList.contains('active')){
		tarjetaEpica.classList.remove('active');
	}
}

// * Rotacion de la tarjeta
tarjetaEpica.addEventListener('click', () => {
	tarjetaEpica.classList.toggle('active');
});