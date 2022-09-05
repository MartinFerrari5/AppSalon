document.addEventListener('DOMContentLoaded',e=>{
    iniciarApp();
})
function iniciarApp(){
    dateFinder()
}
const dateFinder=()=>{
    let fecha=document.querySelector('.cita-fecha')
    fecha.addEventListener('input',e=>{
        let newDate=e.target.value
         window.location=`?fecha=${newDate}`
    })
}