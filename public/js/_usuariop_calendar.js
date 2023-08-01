  // set variables
  let today = new Date();
  let dayInt = today.getDate();
  let month = today.getMonth();
  let year = today.getFullYear();
  // body of the calendar
  let calendarBody = document.getElementById("days");

  let months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Setiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ];


  const toTimestamp = (strFecha) => {
    let dateTime = new Date(strFecha).getTime()
    dateTime = dateTime / 1000
    return dateTime
  };

  const toISOFormat = (fecha) => {
    let dateISO = fecha.split('/')
    dateISO = `${dateISO[2]}/${dateISO[1]}/${dateISO[0]}`
    return dateISO;
  };

  // next and previous functionality
  let nextbtn = document.getElementById("next");
  let prevBtn = document.getElementById("prev");

  nextbtn.onclick = function () {
    next();
  };
  prevBtn.onclick = function () {
    previous();
  };


  // init calendar
  showCalendar(month, year);

  function addInput(element) {
    let showYear = element.getAttribute("data-year");
    let showMonth = element.getAttribute("data-month");
    let showDay = element.getAttribute("data-day");

    let numMonth = months.indexOf(months[showMonth]) + 1

      if(numMonth < 10) {
        numMonth = '0' + numMonth.toString()
      }

      if(showDay < 10) {
        showDay = '0' + showDay.toString()
      }

    let fecha = showDay + "-" + numMonth + "-" + showYear
    // console.log(fecha)

    const container = document.querySelector('#dia-container')
    let selectedDate = document.createElement("div");
    selectedDate.innerHTML = ` 
      <input type="hidden" name="dia[]" value="${fecha}" class="dia-${showDay}">
    ` 
    container.append(selectedDate)
    // console.log(container)
    // console.log(selectedDate)
  }




  function showCalendar(month, year) {
    let firstDay = new Date(year, month).getDay();
    calendarBody.innerHTML = "";

    let totalDays = daysInMonth(month, year);

    blankDates(firstDay === 0 ? 6 : firstDay - 1);

    for (let day = 1; day <= totalDays; day++) {

      let cell = document.createElement("li");
      let cellText = document.createTextNode(day);

      if (dayInt === day && month === today.getMonth() && year === today.getFullYear()) {
        cell.classList.add("active1");
      }

      // appending date attributes to single date li element
      cell.setAttribute("data-day", day);
      cell.setAttribute("data-month", month);
      cell.setAttribute("data-year", year);

      //appending li to body of calendar
      cell.classList.add("singleDay");
      cell.appendChild(cellText);

        //  verificar que solo dias siguiente se puedan seleccionar
        let curr = new Date()
        let dateOptions = { year: 'numeric', month: '2-digit', day: '2-digit' }

        let custom_month = (month < 10) ? '0' + (month + 1) : month
        let custom_day = (day < 10) ? '0' + day : day

        let custom_fecha = `${custom_day}/${custom_month}/${year}`
        let custom_hoy = curr.toLocaleString('es-ES', dateOptions)
        // console.log(custom_fecha)
        // console.log(custom_hoy)

        cell.onclick = function (e) {
          let fecha_hoy = toTimestamp(toISOFormat(custom_hoy))
          let fecha_cell = toTimestamp(toISOFormat(custom_fecha))
          // console.log(fecha_cell)
          // console.log(fecha_hoy)

          if (fecha_hoy <= fecha_cell ) {
            // showDate(e.target);
            let diaText = e.target.getAttribute('data-day')

            // add - delete from #dia-container
             if(diaText < 10) {
                diaText = '0' + diaText.toString()
              }

            if(e.target.classList.contains('active')) {
              let diaElement = document.querySelector(`.dia-${diaText}`)
              e.target.classList.toggle('active')
              diaElement.parentElement.remove() // eliminar <div> que contiene el input dia[]
              // console.log(diaElement)
            } else {
              addInput(e.target);
              // e.target.classList.add(`.dia-${diaText}`)
              e.target.classList.toggle('active')
            }
          } else {
            cell.classList.add('text-primary')
          }

      }

      calendarBody.appendChild(cell);
    }

    // set month string value
    document.getElementById("month").innerHTML = months[month];
    // set year string value
    document.getElementById("year").innerHTML = year;
  }

  function daysInMonth(month, year) {
    // day 0 here returns the last day of the PREVIOUS month
    return new Date(year, month + 1, 0).getDate();
  }

  function blankDates(count) {
    // looping to add the correct amount of blank days to the calendar
    for (let x = 0; x < count; x++) {
      let cell = document.createElement("li");
      let cellText = document.createTextNode("");
      cell.appendChild(cellText);
      // add the empty class to remove the borders
      cell.classList.add("empty");
      calendarBody.appendChild(cell);
    }
  }

  function next() {
    year = month === 11 ? year + 1 : year;
    month = (month + 1) % 12;
    showCalendar(month, year);
  }

  function previous() {
    year = month === 0 ? year - 1 : year;
    month = month === 0 ? 11 : month - 1;
    showCalendar(month, year);
  }
