
window.addEventListener('DOMContentLoaded', ()=> {

	const datatables = document.querySelectorAll('.datatable')
	datatables.forEach(datatable => {
		new simpleDatatables.DataTable(datatable, {
			searchable: true,
			fixedHeight: true,
	    columns: [
	    // Sort the second column in ascending order
		    { select: 0, sort: "asc" },
		    { select: [1,2,3,4,5], sortable: false }

	    // Set the third column as datetime string matching the format "DD/MM/YYY"
	    // { select: 2, type: "date", format: "DD/MM/YYYY" }
	    ],    
	    labels: {
		    placeholder: "Buscar...",
		    perPage: "Elementos por página",
		    noRows: "No hay datos para mostrar",
		    info: "Mostrando {start} - {end} de {rows}"	
			}
		})


	const allBtnClose = document.querySelectorAll('.btn_close')
	allBtnClose.forEach( btn => {
		btn.addEventListener('click', () => {
			let active_modal = document.querySelector('.active-modal')
			active_modal.classList.toggle('active-modal')
			active_modal.classList.toggle('hidden')
		})
	})

	const allBtnEdit = document.querySelectorAll('.btn_edit')
	allBtnEdit?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_edit_'+id)
			modalEdit.classList.toggle('hidden')
			modalEdit.classList.toggle('active-modal')

		})
	})

	const allBtnDelete = document.querySelectorAll('.btn_delete')
	allBtnDelete?.forEach( btn => {
		btn.addEventListener('click', (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-delete')
			let modalDelete = document.querySelector('#modal_delete_'+id)
			modalDelete.classList.toggle('hidden')
			modalDelete.classList.toggle('active-modal')

		})
	})


	})
})

// end DOMContentLoaded

const modal_Add = document.querySelector('#modal_add')

const btn_Add = document.querySelector('#btn_add')
btn_Add?.addEventListener('click', () => {
	modal_Add.classList.toggle('hidden')
	modal_Add.classList.toggle('active-modal')
	// console.log(modal_Add)
})



window.addEventListener('click', (e) => {
	let activeModal = document.querySelector('.active-modal')
	if (e.target == activeModal) {
		activeModal.classList.toggle('active-modal')
		activeModal.classList.toggle('hidden')
	}
})




	// const url = document.querySelector('#url')
	// let root = url.getAttribute('data-root')
	// let controller = url.getAttribute('data-controller')
	// let page = url.getAttribute('data-page')
	// let endpoint = `${root}/${controller}/${page}`



		// const addMenuItem = (e) => {
		// 	// lo que hace preventDefault es enviar el form sin recargar la pagina (sin salir de la pagina)
		// 	e.preventDefault()

		// 	// al instanciar new FormData(form) se crea un json (key : value) con los name : value del form
		// 	const formData = new FormData(formAdd);
		// 	// JSON.stringify, convierte el objeto json en una cadena de texto ( solo 1 linea)
    //   let datos = JSON.stringify(Object.fromEntries(formData))
    //   // "values" pasa al form como parte del array $_POST ,seria = $_POST['values']
    //   let param = 'add_menu_item=' + datos
			
		// 	const xhr = new XMLHttpRequest();
		// 	xhr.open('POST', endpoint, true)
		// 	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

    //   xhr.onreadystatechange = function() {
		// 		if(this.readyState == 4 && this.status == 200) {
		// 			// this.responseText es lo que retorna del API al ejecutarse la peticion
		// 			// document.querySelector('#response').innerHTML = this.responseText
		// 			// console.log(this.responseText)
		// 			formAdd.reset()
		// 			location.reload()
		// 		}
		// 	}

    //   //send the form data
    //   xhr.send(param)

		// }




		// // primero se debe escribir la funcion(postName) antes de ser llamada
		// const formAdd = document.querySelector('#form_add')
		// formAdd.addEventListener('submit', addMenuItem)
