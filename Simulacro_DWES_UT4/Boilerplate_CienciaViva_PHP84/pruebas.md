# Pruebas del simulacro CienciaViva

Completa el resultado real al ejecutar la aplicación. No anotes identificadores de sesión ni valores de cookies de sesión.

| Caso | Resultado esperado | Resultado real | Herramienta |
|---|---|---|---|
| Programa sin preferencias | 10 actividades |  |  |
| Astronomía + duración corta | Meteoritos y cráteres; Fotografía lunar |  |  |
| Cookie de área manipulada | Valor inválido rechazado; área interpretada como all |  |  |
| Restablecer preferencias | Cookies expiradas y 10 actividades |  |  |
| Login válido de Ana | Mi agenda con 3 reservas |  |  |
| Login válido de Leo | Mi agenda con 2 reservas |  |  |
| Login válido de Clara | Coordinación con 5 reservas |  |  |
| Correo inexistente y contraseña incorrecta | Mismo mensaje genérico |  |  |
| Anónimo solicita agenda o coordinación | Redirección al login |  |  |
| Participante solicita coordinación | HTTP 403 |  |  |
| Logout y acceso posterior | El usuario vuelve al login |  |  |
| Timeout de sesión | Redirección con aviso de sesión finalizada |  |  |

## Incidencias y depuración

Anota el error observado, cómo lo localizaste y qué corregiste. Si no se produjo ninguno, indícalo expresamente.
