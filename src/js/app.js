document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    registroInput();
}
function registroInput(){
    
    
    var acompanante = document.querySelector('#acompanantes');
    acompanante.addEventListener('input', function() {
        
        var acompanantes = parseInt(this.value);
        var form = document.querySelector('.registro-form');
        var formGroup = document.querySelector('.registro-form-group:last-child');
        var inputForm = document.querySelector('.acompananteInput');
        var alertaText = document.querySelector('.alerta-text');

        // Remove existing additional fields
        var additionalFields = document.querySelectorAll('.additional-field');
        additionalFields.forEach(function(field) {
            field.remove();
        });

        // Generate additional fields based on the number of acompañantes
        if(inputForm.value > 3){
            alertaText.textContent = 'El número máximo de acompañantes es 3';
            inputForm.value = '';

            if(alertaText.textContent != '') {
                setInterval(() => {
                alertaText.textContent = '';
                }, 3000);
            }
            return;
        }else{
            for (var i = 1; i <= acompanantes; i++) {
                var label = document.createElement('label');
                label.setAttribute('for', 'acompanante' + i);
                label.classList.add('registro-form-label');
                label.textContent = 'Acompañante ' + i;

                var input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('id', 'acompanante' + i);
                input.setAttribute('name', 'acompanante' + i);
                input.classList.add('registro-form-input');
                input.setAttribute('placeholder', 'Nombre del acompañante (Nombre y Apellido)');

                var div = document.createElement('div');
                div.classList.add('registro-form-group', 'additional-field');
                div.appendChild(label);
                div.appendChild(input);
                var quantityDiv = document.querySelector('#acompanantes').parentElement;

                quantityDiv.insertAdjacentElement('afterend', div);  
            }
        }
    });
}
