$(document).ready(function() {
    // Función para cambiar el color de fondo del menú desplegable según la opción seleccionada
    function changeBackgroundColor() {
        var selectedOption = $('#estado option:selected');
        $('#estado').css('background-color', selectedOption.css('background-color'));
        $('#estado').css('color', selectedOption.css('color'));
    }

    // Ejecutar la función al cargar la página para establecer el color de fondo inicial
    changeBackgroundColor();

    // Ejecutar la función cada vez que cambie la opción seleccionada
    $('#estado').change(changeBackgroundColor);

});
