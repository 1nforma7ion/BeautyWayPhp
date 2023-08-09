
window.addEventListener('DOMContentLoaded', ()=> {

 	const successAlert = document.querySelector('#success_msg')
  	setTimeout(() => {
    	successAlert?.remove()
  	}, 5000)

	  const initBtnClose = () => {
			let active_modal = document.querySelector('.active-modal')
			active_modal.classList.toggle('active-modal')
			active_modal.classList.toggle('hidden')		
	  }

	  const initBtnEdit = (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-edit')
			let modalEdit = document.querySelector('#modal_edit_'+id)
			modalEdit.classList.toggle('hidden')
			modalEdit.classList.toggle('active-modal')
		}

	  const initBtnDelete = (e) => {
			// console.log(btn)
			let id = e.target.parentElement.getAttribute('data-item-delete')
			let modalDelete = document.querySelector('#modal_delete_'+id)
			modalDelete.classList.toggle('hidden')
			modalDelete.classList.toggle('active-modal')
		}



	const datatables = document.querySelectorAll('.datatable')
	datatables.forEach(datatable => {

		let tableOptions = {
			searchable: true,
			fixedHeight: true,
	    columns: [
		    { select: 0, sort: "asc" },
	    ],  
	    labels: {
	    	searchTitle: "Buscar ...",
		    placeholder: "Buscar...",
		    perPage: "Elementos por página",
		    noRows: "No hay datos para mostrar",
		    info: "Mostrando {start} - {end} de {rows}"	
			}
			// perPage: 40
		}

		let tabla = new simpleDatatables.DataTable(datatable, tableOptions)


		tabla.on('datatable.init', () => {
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnEdit = document.querySelectorAll('.btn_edit')
			allBtnEdit?.forEach( btn => {
				btn.addEventListener('click', initBtnEdit)
			})

			const allBtnDelete = document.querySelectorAll('.btn_delete')
			allBtnDelete?.forEach( btn => {
				btn.addEventListener('click', initBtnDelete)
			})

		})


		tabla.on('datatable.page', page => {
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnEdit = document.querySelectorAll('.btn_edit')
			allBtnEdit?.forEach( btn => {
				btn.removeEventListener('click', initBtnEdit)
				btn.addEventListener('click', initBtnEdit)
			})

			const allBtnDelete = document.querySelectorAll('.btn_delete')
			allBtnDelete?.forEach( btn => {
				btn.removeEventListener('click', initBtnDelete)
				btn.addEventListener('click', initBtnDelete)
			})

		})

		// activar botones reserva y close al usar dropdown " elementos por pagina"
		tabla.on('datatable.perpage', perpage => {
			// console.log(perpage)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnEdit = document.querySelectorAll('.btn_edit')
			allBtnEdit?.forEach( btn => {
				btn.removeEventListener('click', initBtnEdit)
				btn.addEventListener('click', initBtnEdit)
			})

			const allBtnDelete = document.querySelectorAll('.btn_delete')
			allBtnDelete?.forEach( btn => {
				btn.removeEventListener('click', initBtnDelete)
				btn.addEventListener('click', initBtnDelete)
			})
			
		})

		// activar botones close al usar el Buscador
		tabla.on('datatable.search', (query, matched)  => {
			// console.log(perpage)
			const allBtnClose = document.querySelectorAll('.btn_close')
			allBtnClose.forEach( btn => {
				btn.removeEventListener('click', initBtnClose)
				btn.addEventListener('click', initBtnClose)
			})

			const allBtnEdit = document.querySelectorAll('.btn_edit')
			allBtnEdit?.forEach( btn => {
				btn.removeEventListener('click', initBtnEdit)
				btn.addEventListener('click', initBtnEdit)
			})

			const allBtnDelete = document.querySelectorAll('.btn_delete')
			allBtnDelete?.forEach( btn => {
				btn.removeEventListener('click', initBtnDelete)
				btn.addEventListener('click', initBtnDelete)
			})

		})

	}) 
}) // end DOMContentLoaded

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


