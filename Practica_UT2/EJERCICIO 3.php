<?php
$NombreProducto = "Auriculares";
/*
 Error 1: Declara la variable sin escribir ';' alfinal ,
 esta mal porque es un error de sintaxis de php,
 lo he arreglado añadiendo el ';'.
 */
$precio = "80"; //conviene tenerlo declarado en int,porque es posible que se haga operaciones con la variable
$descuento = 15;
$stock = "5"; //conviene tenerlo declarado en int,porque es posible que se haga operaciones con la variable
/*
 Error 2: Declara la variable sin escribir ';' alfinal ,
 esta mal porque es un error de sintaxis de php,
 lo he arreglado añadiendo el ';'.
 */
$precioFinal = $precio - $descuento;
echo "Producto: " . $NombreProducto . "\n"; //pequeño diseño visual en consola añadiendo el ' ."\n" ' salto de linea
/*
 Error 3: Quiere concatenar usando '+' ,
esta mal porque es un error de sintaxis de php , hay que usar '.'
o escribiendo todo dentro del "",
lo he arreglado quitando el '+' y añadiendo el '.' .
 */
/*
 Error 4: Error en el nombre de variable,
esta mal porque declara al principio como '$NombreProducto' y declara en el echo '$nombreProducto',
lo he arreglado cambiando la letra 'n' a 'N'.
*/
echo "<br>";
/*
 Error 5: Hace echo con la etiqueta <br> salto de linea en HTML (visualmente en navegador no en consola) sin poner ';' alfinal  ,
 esta mal porque es un error de sintaxis de php ,
 lo he arreglado poniendo el ';'.
 */
echo "Precio final: " . $precioFinal . " €\n"; //pequeño diseño visual en consola añadiendo el '\n' salto de linea

var_dump($stock == 5);
var_dump($stock === 5);
function mostrarProducto(){
    global $NombreProducto;
/*
  Error 6: Error en el ámbito de variables,
 esta mal porque en php separa fuertemente el ámbito local y ámbito global ,
 en una función tiene su propio espacio de variables,
 lo he arreglado agregando el ' global $NombreProducto; ' , asi indicamos que queremos usar la variable global.
 */
    echo $NombreProducto;
}
mostrarProducto();
