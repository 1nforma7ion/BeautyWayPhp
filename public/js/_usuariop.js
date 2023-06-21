
window.addEventListener('DOMContentLoaded', ()=> {

  const datatables = document.querySelectorAll('.datatable')
  datatables.forEach(datatable => {
    new simpleDatatables.DataTable(datatable, {
      // searchable: true,
      fixedHeight: true,
      columns: [
      // Sort the second column in ascending order
        { select: 0, sort: "asc" },
        // { select: [1,2,3,4,5], sortable: false }

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


