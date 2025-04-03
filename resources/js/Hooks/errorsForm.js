import Swal from "sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

export default function (errors) {
    return Object.keys(errors).reduce((acc, key) => {
        acc[key] = errors[key][0] ?? null; // Solo toma el primer error de cada campo
        return acc;
    }, {});
}

export function error422(message = "Al parecer hay campos inválidos, por favor revísalos con cuidado.") {
    Swal.fire({
        title: "Ups!",
        text: message,
        icon: "info",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
        returnFocus: false,
    });
}

export function error500(message = "Ocurrió un error inesperado, intentalo más tarde.") {
    Swal.fire({
        title: "Error",
        text: message,
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
        returnFocus: false,
    });
}

export function messageSuccess(message = "La operación se realizo con éxito.") {
    Swal.fire({
        title: "¡Operación Éxitosa!",
        text: message,
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
        returnFocus: false,
    });
}

export function messageConfirm(message = "Esta acción no se puede revertir") {
    return Swal.fire({
        title: "¿Está seguro?",
        text: message,
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#1C64F2",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
    });
}