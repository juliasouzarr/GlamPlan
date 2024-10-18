
// variaveis globais

let nav = 0
let clicked = null
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : []


// variavel do modal:
const newEvent = document.getElementById('newEventModal')
const deleteEventModal = document.getElementById('deleteEventModal')
const backDrop = document.getElementById('modalBackDrop')
const eventTitleInput = document.getElementById('eventTitleInput')
const clientNameInput = document.getElementById('clientNameInput')
const eventTimeInput = document.getElementById('eventTimeInput')


// --------
const calendar = document.getElementById('calendar') // div calendar:
const weekdays = ['domingo','segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado'] //array with weekdays:

//funções

function openModal(date){
  clicked = date
  const eventDay = events.find((event)=>event.date === clicked)
 

  if (eventDay){
   document.getElementById('eventText').innerText = eventDay.time + "H: " + eventDay.title + " - " + eventDay.client 
   deleteEventModal.style.display = 'block'


  } else{
    newEvent.style.display = 'block'

  }

  backDrop.style.display = 'block'
}

//função load() será chamada quando a pagina carregar:

function load() {
  const date = new Date();

  // Mudar título do mês:
  if (nav !== 0) {
    date.setMonth(new Date().getMonth() + nav);
  }

  const day = date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();

  const daysMonth = new Date(year, month + 1, 0).getDate();
  const firstDayMonth = new Date(year, month, 1);

  const dateString = firstDayMonth.toLocaleDateString('pt-br', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });

  const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

  // Mostrar mês e ano:
  document.getElementById('monthDisplay').innerText = `${date.toLocaleDateString('pt-br', { month: 'long' })}, ${year}`;

  calendar.innerHTML = '';

  // Data atual para comparação
  const today = new Date();
  today.setHours(0, 0, 0, 0);  // Zerar as horas para comparação apenas de datas

  // Criando uma div com os dias:
  for (let i = 1; i <= paddingDays + daysMonth; i++) {
    const dayS = document.createElement('div');
    dayS.classList.add('day');

    const dayNumber = i - paddingDays;
    const dayString = `${month + 1}/${dayNumber}/${year}`;

    // Condicional para criar os dias de um mês:
    if (i > paddingDays) {
      dayS.innerText = dayNumber;

      const eventDay = events.find(event => event.date === dayString);

      if (dayNumber === day && nav === 0) {
        dayS.id = 'currentDay';
      }

      // Comparar a data do dia com a data atual
      const currentDate = new Date(year, month, dayNumber);
      currentDate.setHours(0, 0, 0, 0);  // Zerar as horas para comparação

      if (currentDate >= today) {
        // Permitir clique para o dia atual e posteriores
        dayS.addEventListener('click', () => openModal(dayString));
      } else {
        // Desabilitar clique em dias passados
        dayS.classList.add('disabled');
      }

      if (eventDay) {
        const eventDiv = document.createElement('div');
        eventDiv.classList.add('event');
        eventDiv.innerText = eventDay.title;
        dayS.appendChild(eventDiv);
      }

    } else {
      dayS.classList.add('padding');
    }

    calendar.appendChild(dayS);
  }
}



function closeModal(){
  eventTitleInput.classList.remove('error')
  clientNameInput.classList.remove('error')
  eventTimeInput.classList.remove('error')
  newEvent.style.display = 'none'
  backDrop.style.display = 'none'
  deleteEventModal.style.display = 'none'

  eventTitleInput.value = ''
  clientNameInput.value = ''
  eventTimeInput.value = ''
  clicked = null
  load()

}
function saveEvent(){
  if(eventTitleInput.value){
    eventTitleInput.classList.remove('error')
    eventTimeInput.classList.remove('error')
    clientNameInput.classList.remove('error')


    events.push({
      date: clicked,
      title: eventTitleInput.value,
      time: eventTimeInput.value,
      client: clientNameInput.value
    })

    localStorage.setItem('events', JSON.stringify(events))
    closeModal()

  }else{
    eventTitleInput.classList.add('error')
    eventTimeInput.classList.add('error')
    clientNameInput.classList.add('error')
  }
}

function deleteEvent(){

  events = events.filter(event => event.date !== clicked)
  localStorage.setItem('events', JSON.stringify(events))
  closeModal()
}

// botões 

function buttons (){
  document.getElementById('backButton').addEventListener('click', ()=>{
    nav--
    load()
    
  })

  document.getElementById('nextButton').addEventListener('click',()=>{
    nav++
    load()
    
  })

  document.getElementById('saveButton').addEventListener('click',()=> saveEvent())

  document.getElementById('cancelButton').addEventListener('click',()=>closeModal())

  document.getElementById('deleteButton').addEventListener('click', ()=>deleteEvent())

  document.getElementById('closeButton').addEventListener('click', ()=>closeModal())
  
}
buttons()
load()

