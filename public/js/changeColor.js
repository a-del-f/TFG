$(document).ready(function() {
    // Función para cambiar el color de fondo del menú desplegable según la opción seleccionada
    function changeBackgroundColor() {
        var selectedOption = $(this).find('option:selected');
        $(this).css('background-color', selectedOption.css('background-color'));
        $(this).css('color', selectedOption.css('color'));
    }

    // Ejecutar la función al cargar la página para establecer el color de fondo inicial
    $('.estado').each(function() {
        changeBackgroundColor.call(this);
    });

    // Ejecutar la función cada vez que cambie la opción seleccionada
    $('.estado').change(changeBackgroundColor);

});
